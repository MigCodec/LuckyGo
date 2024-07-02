<?php

namespace App\Models;

use App\Models\Sorter;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lottery extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'date',
        'status',
        'winner_num_1',
        'winner_num_2',
        'winner_num_3',
        'winner_num_4',
        'winner_num_5',
        'lucky_num_1',
        'lucky_num_2',
        'lucky_num_3',
        'lucky_num_4',
        'lucky_num_5',
    ];
    protected $appends = [
        'status',
        'sumPriceNormalTicket',
        'sumPriceLuckytTickets',
        'sumTotalTickets',
        'count_total_tickets',
    ];
    protected $dates = ['date'];
    public function tickets():HasMany{
        return $this->hasMany(Ticket::class);
    }
    public function lucky_tickets():HasMany{
        return $this->hasMany(Ticket::class)->where('im_feeling_lucky',1);
    }
    public function normal_tickets():HasMany{
        return $this->hasMany(Ticket::class)->where('im_feeling_lucky',0);
    }
    public function getSumTotalTicketsAttribute(){
        return $this->tickets()->sum('price');
    }
    public function getCountTotalTicketsAttribute(){
        return $this->tickets()->count();
    }
    public function getSumPriceNormalTicketsAttribute(){
        return $this->normal_tickets()->sum('price')??0;
    }
    public function getSumPriceLuckyTicketsAttribute(){
        return $this->lucky_tickets()->sum('price')??0;
    }
    public function getCountWinTicketsAtrribute(){
        return $this->tickets()->
        where("number_1","winner_num_1")->
        where("number_2","winner_num_2")->
        where("number_3","winner_num_3")->
        where("number_4","winner_num_4")->
        where("number_5","winner_num_5")->
        count();
    }
    public function getCountWinLuckyTicketsAtrribute(){
        return $this->tickets()->
        where("number_1","lucky_num_1")->
        where("number_2","lucky_num_2")->
        where("number_3","lucky_num_3")->
        where("number_4","lucky_num_4")->
        where("number_5","lucky_num_5")->count();
    }
    public function getJackpotAttribute(){
        return $this->getSumPriceNormaTicketsAttribute()/$this->getCountWinTicketsAtrribute();
    }
    public function getLuckyJackpotAttribute(){
        return $this->getSumPriceLuckyTicketsAttribute()/$this->getCountWinLuckyTicketsAtrribute();
    }
    /*protected function sum_price_normal_tickets():Attribute{
        return new Attribute(get: fn()=>$this->normal_tickets()->sum('price')??0,);
    }
    
    protected function sum_price_lucky_tickets():Attribute{
        return new Attribute(get: fn()=>$this->lucky_tickets()->sum('price')??0,);
    }
    */
    protected function getStatusAttribute(){
        if($this->sorter_id==null){
            if(Carbon::parse($this->date)->isPast()) {
                return 1;
            }
            return 0;
        }
        return 2;
    }
    public function sorter(){
        return $this->belongsTo(Sorter::class,'sorter_id');
    }
}

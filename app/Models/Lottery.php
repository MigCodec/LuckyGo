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
        'jackspot',
        'lucky_jackspot',
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
        $count_normal = $this->tickets()->count();
        $count_lucky = $this->lucky_tickets()->count();
        return $count_normal*2000+$count_lucky*1000;
    }
    public function getCountTotalTicketsAttribute(){
        return $this->tickets()->count();
    }
    public function getSumPriceNormalTicketsAttribute(){
        $count_normal = $this->normal_tickets()->count()??0;
        $count_lucky = $this->lucky_tickets()->count()??0;
        return $count_normal*2000+$count_lucky*2000;
    }
    public function getSumPriceLuckyTicketsAttribute(){
        $count = $this->lucky_tickets()->count()??0;
        return $count*1000;
    }
    public function getCountWinTicketsAttribute(){
        return $this->tickets()->
        where("number_1",$this->winner_num_1)->
        where("number_2",$this->winner_num_2)->
        where("number_3",$this->winner_num_3)->
        where("number_4",$this->winner_num_4)->
        where("number_5",$this->winner_num_5)->
        count()??0;
    }
    public function getCountWinLuckyTicketsAttribute(){
        return $this->lucky_tickets()->
        where("number_1",$this->lucky_num_1)->
        where("number_2",$this->lucky_num_2)->
        where("number_3",$this->lucky_num_3)->
        where("number_4",$this->lucky_num_4)->
        where("number_5",$this->lucky_num_5)->count()??0;
    }
    public function getJackpotAttribute(){
        $count = $this->getCountWinTicketsAttribute();
        if($count==0){
            return 0;
        }
        return $this->getSumPriceNormalTicketsAttribute()/$count;
    }
    public function getLuckyJackpotAttribute(){
        $count = $this->getCountWinLuckyTicketsAttribute();
        if($count==0){
            return 0;
        }
        return $this->getSumPriceLuckyTicketsAttribute()/$count;
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

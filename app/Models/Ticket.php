<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
    'number_1',
    'number_2',
    'number_3',
    'number_4',
    'number_5',
    'im_feeling_lucky',
    'price',
    'code',
    'date',
    'lottery_id',
    ];
    
    /*
    * This method establishes a "belongs to" relationship indicating that
    * each ticket is associated with a single lottery.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo The relationship instance.
    */
    public function lottery(){
        return $this->belongsTo(Lottery::class);
    }

    /**
     * Checks if the current ticket is a winner.
     *
     * @return bool
     */

    public function get_win(){
        $lottery = $this->lottery;
        if($this->number_1 == $lottery->winner_num_1){
            if($this->number_2 == $lottery->winner_num_2){
                if($this->number_3 == $lottery->winner_num_3){
                    if($this->number_4 == $lottery->winner_num_4){
                        if($this->number_5 == $lottery->winner_num_5){
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    /**
     * Checks if the current ticket is a winner based on lucky numbers.
     *
     * @return bool
     */

    public function get_win_im_feeling_lucky(){
        $lottery = $this->lottery;
        if($this->number_1 == $lottery->lucky_num_1){
            if($this->number_2 == $lottery->lucky_num_2){
                if($this->number_3 == $lottery->lucky_num_3){
                    if($this->number_4 == $lottery->lucky_num_4){
                        if($this->number_5 == $lottery->lucky_num_5){
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }
    public function get_amount(){

    }
    public function get_amount_lucky(){

    }
}

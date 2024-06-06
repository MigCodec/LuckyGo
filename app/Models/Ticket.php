<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
    'numbers',
    'im_feeling_lucky',
    'price',
    'code',
    'date',
    'lottery_id',
    ];
    
    /*
    * This method establishes a "belongs to" relationship indicating that
    * each sorter is associated with a single lottery.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo The relationship instance.
    */
    public function lottery(){
        return $this->belongsTo(Lottery::class);
    }
}

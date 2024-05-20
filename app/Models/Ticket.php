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
    public function lottery(){
        return $this->belongsTo(Lottery::class);
    }
    public function sorter(){
        return $this->belongsTo(Sorter::class);
    }
}

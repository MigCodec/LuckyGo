<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sorter extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'mail',
        'password',
        'age',
        'name',
    ];
}

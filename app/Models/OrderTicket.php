<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'sight_id',
        'order_id',
        'quantity',
        'date'
    ];
}

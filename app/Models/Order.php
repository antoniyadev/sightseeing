<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    public const PAYMENT_METHODS =
    [
        'pay_card' => 'Pay with card',
        'pay_visit' => 'Pay on visit'
    ];

    protected $fillable = [
        'user_id',
        'payment_method'
    ];

    /**
     * Get the tickets for the order.
     */
    public function sights(): HasMany
    {
        return $this->hasMany(OrderTicket::class);
    }
}

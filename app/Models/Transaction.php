<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'amount',
        'payment_status',
        'response_data',
        'service_purchased',
    ];

    protected $casts = [
        'response_data' => 'array', // Agar JSON bisa langsung dipakai di PHP
    ];
}

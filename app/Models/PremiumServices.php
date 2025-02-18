<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PremiumServices extends Model
{
    use HasFactory;

    protected $table = 'premium_services';

    protected $fillable = [
        'user_id',
        'premium_scans',
        'status',
        // 'start_date',
        'end_date',
    ];
}

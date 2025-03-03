<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryScan extends Model
{
    use HasFactory;

    protected $table = 'history_scans';

    protected $fillable = [
        'user_id',
        'image_url',
        'disease_name',
        'confidence',
        'diagnosis_text',
        'other_result',
    ];

    protected $casts = [
        'diagnosis_text' => 'array', // Otomatis mengonversi JSON ke array
        'other_result' => 'array', // Otomatis mengonversi JSON ke array
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

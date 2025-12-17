<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mbti_type',
        'skills',
        'academic_background',
        'recommendations',
        'test_date'
    ];

    protected $casts = [
        'test_date' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
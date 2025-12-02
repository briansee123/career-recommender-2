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
        'recommended_careers',
        'skills',
        'interests',
        'academic_background',
        'answers'
    ];

    protected $casts = [
        'answers' => 'array'
    ];

    // Relationship: Test result belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
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
        'interests',
        'academic_background',
        'personality_answers',
        'ai_recommendations',
    ];

    protected $casts = [
        'personality_answers' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the test result
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get formatted date for display
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('F j, Y - g:i A');
    }

    /**
     * Get skills as array
     */
    public function getSkillsArrayAttribute()
    {
        return explode(',', $this->skills);
    }

    /**
     * Get interests as array
     */
    public function getInterestsArrayAttribute()
    {
        return explode(',', $this->interests);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'company_icon',
        'location',
        'salary',
        'description',
        'job_type',
        'status',
        'is_available',
        'posted_date',
        'required_skills'
    ];

    protected $casts = [
        'required_skills' => 'array',
        'posted_date' => 'date',
        'is_available' => 'boolean'
    ];

    // Relationship: Job has many applications
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
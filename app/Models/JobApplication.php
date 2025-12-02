<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_listing_id',
        'full_name',
        'email',
        'phone',
        'resume_path',
        'status'
    ];

    // Relationship: Application belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: Application belongs to a job
    public function jobListing()
    {
        return $this->belongsTo(JobListing::class);
    }
}
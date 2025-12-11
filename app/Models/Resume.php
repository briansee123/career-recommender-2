<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_title',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'country',
        'photo',
        'summary',
        'experience_company',
        'experience_title',
        'experience_duration',
        'experience_description',
        'education_institution',
        'education_degree',
        'education_year',
        'skills',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
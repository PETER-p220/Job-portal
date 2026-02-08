<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job_postings';
    
    protected $fillable = [
        'title', 'company', 'location', 'description', 'salary', 'type',
        'experience_level', 'deadline', 'apply_url', 'image', 'email', 'user_id', 'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Job extends Model
{
    protected $table = 'job_postings';
    
    protected $fillable = [
        'title', 'company', 'location', 'description', 'salary', 'type',
        'experience_level', 'deadline', 'apply_url', 'image', 'email', 'user_id', 'is_active',
    ];

    protected $casts = [
        'deadline' => 'date',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function interviews()
    {
        return $this->hasMany(Interview::class);
    }

    public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'saved_jobs')->withTimestamps();
    }

    // Scope for active jobs (not expired)
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where(function($q) {
                        $q->whereNull('deadline')
                          ->orWhere('deadline', '>=', Carbon::today());
                    });
    }

    // Scope for expired jobs
    public function scopeExpired($query)
    {
        return $query->where('deadline', '<', Carbon::today());
    }

    // Check if job is expired
    public function isExpired()
    {
        return $this->deadline && $this->deadline < Carbon::today();
    }

    // Check if job is active
    public function isActive()
    {
        return $this->is_active && !$this->isExpired();
    }
}

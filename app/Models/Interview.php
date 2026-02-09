<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Interview extends Model
{
    protected $fillable = [
        'user_id',
        'job_id',
        'job_title',
        'company',
        'company_image',
        'type',
        'date',
        'time',
        'duration',
        'meeting_link',
        'status',
        'notes',
        'application_method',
        'application_link',
        'whatsapp_number',
        'phone_number',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'user_id' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'job_title',
        'company',
        'country',
        'linkedin',
        'industry',
        'company_size',
        'experience',
        'interests',
        'meeting_topics',
        'consent_newsletter',
        'consent_thirdparty',
    ];

    protected $casts = [
        'interests' => 'array',
        'meeting_topics' => 'array',
        'consent_newsletter' => 'boolean',
        'consent_thirdparty' => 'boolean',
    ];
}

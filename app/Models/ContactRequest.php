<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'how_heard',
        'services_selected',
        'project_details',
        'timeframe_flexibility',
        'design_style_description',
        'gclid',
        'client_id',
        'referrer',
        'page_url',
        'ip_address',
        'user_agent',
    ];


    protected $casts = [
        'services_selected' => 'array',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPageConfig extends Model
{
    protected $fillable = [
        'mission',
        'vission',
        'values',
        'services_description',
        'main_description',
        'main_video_url',
        'contact_phone',
        'contact_phone_alternative',
        'contact_email',
        'address'
    ];
}

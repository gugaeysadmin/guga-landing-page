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
        'about_us',
        'special_ofert',
        'active_special_ofert',
        'contact_phone',
        'contact_phone_alternative',
        'contact_email',
        'address',
        'optional1',
        'optional2',
        'optional3',
        'catalogs_filters'
    ];
}

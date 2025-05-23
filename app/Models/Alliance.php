<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alliance extends Model
{
    protected $fillable = [
        'index',
        'name',
        'description',
        'img_url',
        'active',
        'url'
    ];
}

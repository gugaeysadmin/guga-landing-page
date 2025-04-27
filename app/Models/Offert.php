<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offert extends Model
{
    protected $fillable = [
        'name',
        'description',
        'img_url',
        'active',
        'index'
    ];
}

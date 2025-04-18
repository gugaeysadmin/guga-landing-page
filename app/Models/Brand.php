<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'description',
        'logo_file_url',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

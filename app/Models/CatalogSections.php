<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogSections extends Model
{
    protected $fillable = [
        'section_name'
    ];

    public function categories()
    {
        return $this->belongsToMany(Categories::class); 
    }
}

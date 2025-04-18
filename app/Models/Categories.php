<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
        'name'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function catalogSections()
    {
        return $this->belongsToMany(CatalogSections::class);
    }

    public function specialityAreaSection()
    {
        return $this->belongsToMany(SpecialityAreaSection::class);
    } 
}

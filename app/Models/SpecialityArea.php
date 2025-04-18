<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialityArea extends Model
{
    protected $fillable = [
        'name',
        'description',
        'icon_file_url'
    ];

    public function SpecialityAreaSections()
    {
        return $this->hasMany(SpecialityAreaSection::class);
    }
    public function  productSpecArea()
    {
        return $this->hasMany(ProductSpecArea::class);
    }
}

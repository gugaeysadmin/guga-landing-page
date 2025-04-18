<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialityAreaSection extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'speciality_area_id'
    ];

    public function specialityArea()
    {
        return $this->belongsTo(SpecialityArea::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Categories::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecAreaImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'index',
        'type',
        'optional2',
        'optional3',
        'active',
        'spec_area_id'
    ];

    public function SpecialityArea()
    {
        $this->belongsTo(SpecialityArea::class);
    }
}

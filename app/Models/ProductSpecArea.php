<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSpecArea extends Model
{
    use HasFactory;
    protected $fillable = [
        'priority',
        'product_id',
        'spec_area_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function specialityArea()
    {
        return $this->belongsTo(SpecialityArea::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'has_table',
        'product_services',
        'optional1',
        'optional2',
        'optional3',
        'brand_id',
        'table_data',
        'has_accesrorypdf',
        'pdf_page',
        'has_services',
        'services_description',
        'accesorypdf_id',
        'accesorypdf',
        'active'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }



    public function productTableConfiguration()
    {
        return $this->belongsTo(ProductTableConfiguration::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function  accesories()
    {
        return $this->hasMany(Accesory::class);
    }

    public function category()
    {
        return $this->belongsToMany(Categories::class, 'category_product', // Nombre de la tabla pivot
        'product_id',       // Clave foránea del modelo actual
        'category_id');
    }

    public function  productSpecAreas()
    {
        return $this->hasMany(ProductSpecArea::class);
    }

    public function  accesoryPdf()
    {
        return $this->belongsTo(AccesoryPdf::class);
    }
}

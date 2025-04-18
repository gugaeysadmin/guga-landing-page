<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTableConfiguration extends Model
{
    protected $fillable = [
        'name',
        'table_json'
    ];
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

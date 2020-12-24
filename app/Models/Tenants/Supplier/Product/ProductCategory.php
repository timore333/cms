<?php

namespace App\Models\Tenants\Supplier\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

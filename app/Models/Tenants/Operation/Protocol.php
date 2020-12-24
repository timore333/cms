<?php

namespace App\Models\Tenants\Operation;

use App\Models\Tenants\Supplier\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
    use HasFactory;
        protected $guarded = [];

    public function procedure()
    {
    	return $this->belongsTo(Procedure::class);
    }

    public function products()
    {
    	return $this->belongsToMany(Product::class)->withPivot('qty');
    }
}

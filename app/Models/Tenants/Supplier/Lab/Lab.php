<?php

namespace App\Models\Tenants\Supplier\Lab;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory, Phoneable;
//    use Accountable;

    protected $guarded = [];


    public function labOrders()
    {
        return $this->hasMany(LabOrder::class);
    }
}

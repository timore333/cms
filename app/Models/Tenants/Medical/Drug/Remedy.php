<?php

namespace App\Models\Tenants\Medical\Drug;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remedy extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Prescriptions()
    {
        return $this->belongsTo(Prescription::class);
    }
}

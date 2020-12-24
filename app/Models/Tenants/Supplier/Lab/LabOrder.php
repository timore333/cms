<?php

namespace App\Models\Tenants\Supplier\Lab;

use App\Models\Tenants\Admin\User;
use App\Models\Tenants\Client\Patient\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabOrder extends Model
{
    use HasFactory;
         protected $guarded = [];

     public function lab()
     {
     	return $this->belongsTo(Lab::class);
     }

     public function patient()
     {
     	return $this->belongsTo(Patient::class);
     }
     // doctor is user
     public function doctor()
     {
     	return $this->belongsTo(User::class);
     }
}

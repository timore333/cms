<?php

namespace App\Models\Tenants\Medical\Drug;

use App\Models\Tenants\Admin\User;
use App\Models\Tenants\Client\Patient\Patient;
use App\Models\Tenants\Medical\Visit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
        protected $guarded = [];
    protected $with = ['remedies'];

    public function patient()
    {
    	return $this->belongsTo(Patient::class);
    }
    public function doctor()
    {
        return $this->belongsTo(User::class);
    }
         public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

    public function remedies()
    {
    	return $this->hasMany(Remedy::class);
    }

    public function removeRemedy(Remedy $remedy)
    {
    	$remedy->delete();
    }

    public function removeAllRemedies()
    {
    	foreach ($this->remedies as $remedy) {
    		$this->removeRemedy($remedy);
    	}
    }
}

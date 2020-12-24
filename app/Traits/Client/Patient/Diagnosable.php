<?php

namespace App\Traits\Client\Patient;


use App\Models\Tenants\Medical\Allergy;
use App\Models\Tenants\Medical\Disease;
use App\Models\Tenants\Medical\Drug\Prescription;
use App\Models\Tenants\Medical\Sign;
use App\Models\Tenants\Medical\Symptom;
use App\Models\Tenants\Medical\Visit;
use App\Models\Tenants\Operation\Recall;

trait Diagnosable
{

   public function visits()
    {
        return $this->hasMany(Visit::class)->orderBy('created_at','desc');
    }


    public function recall()
    {
        return $this->hasOne(Recall::class);
    }

    public function xRays()
    {
        return $this->photos()->xrays()->get();
    }


    public function diseases()
    {
        return $this->belongsToMany(Disease::class);
    }

    public function allergies()
    {
        return $this->belongsToMany(Allergy::class);
    }

    public function signs()
    {
        return $this->morphToMany(Sign::class, 'signable');
    }

    public function symptoms()
    {
        return $this->morphToMany(Symptom::class, 'symptomable');
    }

     
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function hasDisease($id)
    {
            foreach ($this->diseases as $disease) {
                if ($disease->id == $id) {
                    return true;
                }
            }

            return false;
    }

  
    public function notHasDisease($id)
    {
            return !$this->hasDisease($id);
    }

  

    public function hasAllergy($id)
    {
        foreach ($this->allergies as $allergy) {
            if ($allergy->id == $id) {
                return true;
            }
        }
        return false;
    }

  
    public function notHasAllergy($id)
    {
            return !$this->hasAllergy($id);
    }

  


    
}
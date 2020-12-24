<?php

namespace App\Traits\Medical\Patient;

use App\Models\Medical\Allergy;
use App\Models\Medical\Disease;
use App\Models\Medical\Prescription;
use App\Models\Medical\Sign;
use App\Models\Medical\Symptom;
use App\Models\Medical\Visit;
use App\Models\Setting\Recall;


trait Diagnosable
{

   public function visits()
    {
        return $this->hasMany(Visit::class)->orderBy('created_at','dsc');
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
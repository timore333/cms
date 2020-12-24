<?php

namespace App\Models\Tenants\Medical;

use App\Models\Tenants\Client\Patient\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    use HasFactory;
    	protected $guarded = [];

    public function patients()
    {
        return $this->morphedByMany(Patient::class, 'symptomable');
    }

    public function diseases()
    {
        return $this->morphedByMany(Disease::class, 'symptomable');
    }
}

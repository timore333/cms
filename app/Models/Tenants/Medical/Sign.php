<?php

namespace App\Models\Tenants\Medical;

use App\Models\Tenants\Client\Patient\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{
    use HasFactory;
    	protected $guarded = [];

    public function patients()
    {
        return $this->morphedByMany(Patient::class, 'signable');
    }

    public function diseases()
    {
        return $this->morphedByMany(Disease::class, 'signable');
    }
}

<?php

namespace App\Models\Tenants\Client\Patient;

use App\Models\Tenants\Client\Patient\ToothSurface;
use Illuminate\Database\Eloquent\Model;

class Finding extends Model
{
    protected $fillable = ['name', 'tooth_surface_id'];

    public function surface()
    {
        return $this->belongsToMany(ToothSurface::class);
    }

}

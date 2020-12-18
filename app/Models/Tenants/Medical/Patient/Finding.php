<?php

namespace App\Models\Tenants\Medical\Patient;

use Illuminate\Database\Eloquent\Model;

class Finding extends Model
{
    protected $fillable = ['name', 'tooth_surface_id'];

    public function surface()
    {
        return $this->belongsToMany(ToothSurface::class);
    }

}

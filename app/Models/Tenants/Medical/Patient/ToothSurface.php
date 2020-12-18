<?php

namespace App\Models\Tenants\Medical\Patient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToothSurface extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name'];
    protected $with = ['findings'];


    public function tooth()
    {
        return $this->belongsTo(Tooth::class);
    }

    public function findings()
    {
        return $this->belongsToMany(Finding::class);
    }


    // adding function to get the clinical finding of this surface ex. caires filling fructured ...


}

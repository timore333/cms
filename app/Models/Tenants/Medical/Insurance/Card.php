<?php

namespace App\Models\Tenants\Medical\Insurance;

use App\Models\Tenants\Medical\Patient\Patient;
use App\Traits\General\Photoable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory ,Photoable;


	protected $guarded = [];
	// protected $with = ['photos'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function insuranceCompany()
    {
        return $this->belongsTo(Company::class);
    }

    public function addImage($image)
    {
        $image_data = $this->patient->saveImage($image, 'insurance_card');
        $image_data['type' ]= 'documents';
        $image_data['category']= 'insurance';
        $image_data['description'] = 'insurance card image';
        $this->addPhoto($image_data);
    }
}

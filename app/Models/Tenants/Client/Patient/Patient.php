<?php

namespace App\Models\Tenants\Client\Patient;

use App\Traits\Client\Patient\CreateTeeth;
use App\Traits\Client\Patient\Diagnosable;
use App\Traits\Client\Patient\Insuranceable;
use App\Traits\General\Phoneable;
use App\Traits\General\Photoable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Patient extends Model
{
    use HasFactory, Notifiable, Phoneable, CreateTeeth, Photoable, Insuranceable, Diagnosable;
//      , Accountable ;

    protected $fillable = ['name','address','email','gender','payment','discount','birth_date','barcode'];
    protected $with = [];

    public function isCash()
	{
		return $this->payment === 'cash';
	}

	public function isInsurance()
	{
		return $this->payment === 'isInsurance';
	}
}

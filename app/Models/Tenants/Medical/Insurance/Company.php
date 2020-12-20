<?php

namespace App\Models\Tenants\Medical\Insurance;

use App\Traits\General\Phoneable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{
    use HasFactory, Phoneable, Notifiable;

//	use Accountable;

    protected $fillable = ['name','address','email'] ;

	public function Cards()
	{
		return $this->hasMany(Card::calss);
	}

	function priceList(){

		return $this->hasOne(PriceList::class);
	}

	public function serviceRequests()
	{
		return $this->hasMany(ServiceRequest::class);
	}

	public function moneyRequests()
	{
		return $this->hasMany(MoneyRequest::class);
	}
}

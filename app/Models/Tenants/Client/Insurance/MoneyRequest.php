<?php

namespace App\Models\Tenants\Client\Insurance;

use App\Models\Tenants\Client\Patient\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneyRequest extends Model
{
    use HasFactory;
        public function patient()
    {
    	return $this->belongsTo(Patient::class);
    }

    public function Company()
    {
    	return $this->belongsTo(Company::class);
    }

    public function approval()
    {
    	return $this->belongsTo(Approval::class);
    }

    public function procedures()
    {
        return $this->approval->approved();
    }

   public function amount()
   {
       return $this->approval->amount();
   }
}

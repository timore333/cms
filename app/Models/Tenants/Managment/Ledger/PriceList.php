<?php

namespace App\Models\Tenants\Managment\Ledger;

use App\Models\Tenants\Client\Insurance\Company;
use App\Models\Tenants\Operation\Procedure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    use HasFactory;


	protected $fillable = ['name','description'];

	protected $with = ['procedures'];


   public function procedures()
   {
      return $this->belongsToMany(Procedure::class)->withPivot('price','code');
   }

   public function insuranceCompany()
   {
      return $this->belongsTo(Company::class);
   }


   public function addProcedure($procedure_id, $price, $code='')
   {
      $this->procedures()->attach($procedure_id, ['price'=> $price,'code' => $code]);
   }


   public function getPrice($procedure_id)
   {
      foreach ($this->procedures as $procedrue) {
         if($procedrue->pivot->procedure_id === $procedure_id){
            return $procedrue->pivot->price;
         }
      }

   }

}

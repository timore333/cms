<?php

namespace App\Models\Tenants\Setting;


use Illuminate\Database\Eloquent\Model;
use Models\Medical\Patient;

class Phone extends Model
{
   protected $fillable = ['phoneable_id', 'phoneable_type','number','type'];
   public  $types=['mobile'=>'Mobile','home'=>'Home','work'=>'Work','fax'=>'Fax'];

   public static function types()
   {
     return ['mobile'=>'Mobile','home'=>'Home','work'=>'Work','fax'=>'Fax'];
   }

   public function phoneable()
   {
  		 return $this->morphTo();
   }

   public static function getPhone($number)
   {
     return self::where('number', $number)->first();
   }

}

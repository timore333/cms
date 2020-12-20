<?php

namespace App\Models\Tenants\Medical\Insurance;

use App\Models\Tenants\Medical\Patient\Patient;
use App\Traits\General\Photoable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory, Photoable;

   protected $guarded=[];

   public function Company()
   {
   	return $this->belongsTo(Company::class);
   }

   public function patient()
   {
	   	return $this->belongsTo(Patient::class);
   }

   public function approval()
   {
   	 return $this->hasOne(Approval::class);
   }

   public function procedures()
   {
      return $this->belongsToMany(Procedure::class)->withPivot('price', 'tooth_id', 'tooth_number', 'tooth_uns_number', 'tooth_name','code');
   }

    public function addImage($image)
    {
        $name =  'service_request_No__' . $this->clean($this->request_no);
        $image_data = $this->patient->saveImage($image,$name);
        $image_data['type' ]= 'documents';
        $image_data['category']= 'insurance';
        $image_data['description'] = 'insurance service request';
        $this->addPhoto($image_data);
    }

    public function addProcedure($procedure)
    {
      $this->procedures()->attach($procedure['procedure'],[
        'tooth_id' => $procedure['tooth'],
        'price' => $procedure['price'],
        'tooth_number' => $procedure['tooth_number'],
        'tooth_uns_number' => $procedure['tooth_uns_number'],
        'tooth_name' => $procedure['tooth_name'],
        'code' => $procedure['code'],
      ]);
    }


    public function addApproval($data)
    {
        $approval = new Approval;
        $approval->number = $data['number'];
        $approval->status = $data['status'];
        $approval->patient_share = $data['patient_share'];
        $approval->max_limit = $data['limit'];
        $approval->total =$data['subTotal'];
        $approval->approved =$data['approved'];

        $this->approval()->save($approval);

        if($data['image']){
            $approval->addImage($data['image']);
        }

        return $approval;
    }


    public static function notApproved(){
      return self::doesntHave('approval')->get();
    }

    public static function Approved(){
      return self::has('approval')->get();
    }

}

<?php

namespace App\Models\Tenants\Medical;

use App\Models\Tenants\Admin\User;
use App\Models\Tenants\Client\Patient\Patient;
use App\Models\Tenants\Medical\Drug\Prescription;
use App\Models\Tenants\Operation\Procedure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $guarded = [];
	protected $with =['procedures'];

	public function patient()
	{
		return $this->belongsTo(Patient::class);
	}

	public function doctor()
	{
		return $this->belongsTo(User::class);
	}

	public function procedures()
	{
		return $this->belongsToMany(Procedure::class)->withPivot('notes','tooth_id','completed');
	}

	public function prescriptions()
	{
		return $this->hasMany(Prescription::class);
	}

	public function addProcedures($procedures)
    {
       foreach ($procedures as $procedure) {
           $notes = $procedure['notes'];
           $completed = $procedure['completed'];
           $tooth = $procedure['tooth']['id'];
           $this->procedures()->attach(
            $procedure['procedure']['id'],
             [
              'notes' => $notes,
              'tooth_id'=> $tooth,
              'completed' =>$completed
             ]
            );
       }
    }


    public function addPrescription($doctor_id, $patient_id, $drugs)
    {
        $prescription = new Prescription;
        $prescription->doctor_id = $doctor_id;
        $prescription->patient_id = $patient_id;
        $prescription->visit_id = $this->id;
        $prescription->save();

        foreach ($drugs as $drug) {

          $remidy = new Remidy;
          $remidy->drug_id = $drug["id"];
          $remidy->drug_name = $drug["name"];
          $remidy->concentration = $drug["concentration"];
          $remidy->dose = $drug["dose"];
          $remidy->duration = $drug["duration"];
          $remidy->form = $drug["form"];
          $remidy->notes = $drug["notes"];
          $prescription->remidies()->save($remidy);
        }
    }

}

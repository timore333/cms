<?php

namespace App\Http\Requests\Medical;

use App\Events\Medical\visits\VisitCompleted;
use App\Models\Ledgers\Pill;
use App\Models\Ledgers\Revenue;
use App\Models\Ledgers\Transaction;
use App\Models\Medical\Patient;
use App\Models\Medical\Prescription;
use App\Models\Medical\Procedure;
use App\Models\Medical\Remidy;
use App\Models\Medical\Visit;
use App\Models\Setting\Calendar;
use App\Models\Setting\Recall;
use App\Notifications\Insurance\NewServiceRequestCreated;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateVisitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function commit()
    {

       $visit = $this->createVisit($this->start, $this->patient, $this->doctor);


       if ($this->procedures) {
         $visit->addProcedures($this->procedures);
       }


       if ($this->prescription) {
          $visit->addPrescription($this->doctor, $this->patient, $this->prescription);
       }

       if($this->claim){
            foreach (User::receptions() as $receptionist ) {
              $receptionist->notify(new NewServiceRequestCreated($this->only('claim')));
            }
       }


       // fire visit completed event 
       
       $visit->appointment = $this->appointment;
       $visit->recall = $this->recall;
       event(new VisitCompleted($visit));

    }


    public function createVisit($start, $patient_id, $doctor_id)
    {
       $visit = new Visit;
       $visit->start = $this->parseDate($start);
       $visit->end = Carbon::now();
       $visit->patient_id = $patient_id;
       $visit->doctor_id = $doctor_id;
       $visit->status = 'completed';
       $visit->save();
       return $visit;
    }


    /**
     *  format the date to mysql format
     * @param Carbon $date date to be formatted
     * @return string [date]  return formatted date to be saved in DB
     */
    public function parseDate($date)
    {
        return Carbon::parse($date)->toDateTimeString();
    }



}

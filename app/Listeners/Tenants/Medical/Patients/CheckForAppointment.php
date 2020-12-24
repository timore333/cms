<?php

namespace App\Listeners\Tenants\Medical\Patients;

use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Setting\Calendar;
class CheckForAppointment
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return bool
     */
    public function handle($event)
    {
        $patient = $event->patient;
        $currentPatientPhones = $patient->phones->pluck('number');
        foreach($this->newPatientAppointments() as $appointment){
            if(in_array($appointment['patient']['phone'], $currentPatientPhones->all())){
                // we found patient
                // get the appointment
                $target = Calendar::find($appointment['id']);
                // update appointment patient
                $target->patient= ['isNew'=>false, 'patient'=>$patient, 'phone'=>null];
                // save appointment
                $target->save();
            }
        }

    }

    public function newPatientAppointments()
    {
        $todayAppointmentsPatients = Calendar::whereDate('start', Carbon::today())->orderBy('start')->get();
        $phones = [];
        foreach($todayAppointmentsPatients as $appointment) {
            if($appointment['patient']['isNew']) {
                array_push($phones, $appointment);
            }
        }
        return $phones;
    }

}

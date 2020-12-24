<?php

namespaceApp\Listeners\Tenants\Medical\Patients;

use App\Notifications\Patients\PatientCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailToNewPatient
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $event->patient->notify(new PatientCreated($event->patient));
    }
}

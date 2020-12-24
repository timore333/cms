<?php

namespace App\Listeners\Tenants\Medical\Patients;

use App\Models\Medical\Patient;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddInsuranceCard
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
     * @return void
     */
    public function handle($event)
    {
        if($event->patient->payment === 'insurance') {
            $event->patient->addInsuranceCard($event->patient->insurance);
        }
    }
}

<?php

namespace App\Listeners\Tenants\Medical\Patients;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSmsToNewPatient
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
        $phones = $this->phones($event->patient->phones->pluck('number'));
        $sender = app()->make('SmsMisr');
        $sender->message('مرحبا بكم في مركز ثنايا للأسنان')->mobile($phones)->lang(2)->send();
        //         $sender->balance();
    }

    public function phones($phones)
    {
        $result = [];
        foreach($phones as $phone) {
            array_push($result, '2' . $phone);
        }
        return collect($result)->implode(',');
    }
}

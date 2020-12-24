<?php

namespace App\Listeners\Tenants\Medical\Patients;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateProfileImage
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
        $patient = $event->patient;
        if ($patient->profile) {
            $data = $patient->saveImage($patient->profile, 'profile');
            $data['type'] = 'profile';
            $data['category'] = 'personal';
            $data['description'] = 'profile picture';
            $patient->addPhoto($data);

        }else{
            $patient->createAvatar();
        }


    }
}

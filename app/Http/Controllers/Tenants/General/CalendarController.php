<?php

namespace App\Http\Controllers\Tenants\General;

use App\Events\Tenants\General\Calendar\AppointmentCreated;
use App\Events\Tenants\General\Calendar\AppointmentDeleted;
use App\Http\Controllers\Controller;
use App\Models\Tenants\Admin\User;
use App\Models\Tenants\Client\Patient\Patient;
use App\Models\Tenants\General\Calendar;
use App\Models\Tenants\General\Setting;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function calendar()
    {
        return Inertia::render('Tenants/General/Calendar', [
            'events' => fn() => Calendar::get(),
            'doctors'=> fn()=>User::role('doctor')->pluck('name','id'),
            'patients'=>fn()=>Patient::pluck('name','id'),
            'locale'=>fn()=>Setting::find(3)->value,
            'slotDuration'=>fn()=>Setting::find(4)->value,
            'slotMinTime'=>fn()=>Setting::find(5)->value,
            'slotMaxTime'=>fn()=>Setting::find(6)->value,
        ])->withViewData(['title' => __('general.calendar')]);

    }


    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        return Calendar::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return
     */
    public function store(Request $request)
    {
        $event = new Calendar;
        $event->start = $this->parseDate($request->start);
        $event->end = $this->parseDate($request->end);
        $event->patient = $request->patient;
        $event->doctor = $request->doctor;
        $event->color = $request->color;
        $event->allDay = $request->allDay;
        $event->status = 'waiting';
        $event->save();
        event(new AppointmentCreated($event));
    }

    /**
     * Display the specified resource.
     *
     * @param $date
     * @return CalendarCollection
     */
    public function show($date)
    {
        return new CalendarCollection(Calendar::whereDate('start', $date)->orderBy('start')->get());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        if($request->key === 'resize') {
            $this->resize($request, $id);
            return;
        }

        if($request->key === 'status') {
            $this->updateStatus($request, $id);
            return;
        }

        $calendar = Calendar::find($id);
        $calendar->start = $this->fixDate($request->start);
        $calendar->end = $this->fixDate($request->end);
        $calendar->patient = $request->patient;
        $calendar->doctor = $request->doctor;
        $calendar->color = $request->color;
        $calendar->allDay = $request->allDay;
        $calendar->status = 'waiting';
        $calendar->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return void
     */
    public function destroy($id)
    {
        $appointment = Calendar::find($id);
        $appointment->delete();
        event(new AppointmentDeleted($appointment));
    }


    /**
     * @param $date
     * @return string
     */
    public function fixDate($date)
    {
        // remove the end of the string which is (Eastern European Standard Time) from the date.
        $correctedDate = substr($date, 0, 34);
        return $this->parseDate($correctedDate);
    }

    /**
     * @param $date
     * @return string
     */
    public function parseDate($date)
    {
        return Carbon::parse($date)->toDateTimeString();
    }

    /**
     * @param $request
     * @param $id
     */
    public function resize($request, $id)
    {
        $event = Calendar::find($id);
        $event->start = $this->parseDate($request->start);
        $event->end = $this->parseDate($request->end);
        $event->update();
    }

    /**
     * @param $request
     * @param $id
     */
    public function updateStatus($request, $id)
    {
        $event = Calendar::find($id);
        $event->status = $request->status;
        $event->update();
    }


}

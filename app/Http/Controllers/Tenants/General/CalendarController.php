<?php

namespace App\Http\Controllers\Tenants\General;

use App\Http\Controllers\Controller;
use App\Models\Tenants\General\Calendar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function calendar()
    {
        return view('setting.calendar.show');
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
        return new $event;
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
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        //
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
     * @param Calendar $calendar
     * @return void
     * @throws \Exception
     */
    public function destroy(Calendar $calendar)
    {
        $calendar->delete();
        event(new AppointmentDeleted($calendar));
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

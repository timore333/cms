<?php

namespace App\Http\Controllers\Tenants\Medical;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VisitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Visit[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return visit::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function start($id)
    {
        $appointment = Calendar::find($id);
        $patient = new PatientResource(Patient::with([
            'phones', 'photos', 'prescriptions', 'insuranceCard', 'insuranceServiceRequests', 'diseases',  'allergies',  'visits',  'teeth',
        ])->find($appointment['patient']['patient']['id']));
        $doctor = auth()->user();
        return view('medical.visits.create',compact('patient','doctor','appointment'));
    }

    public function create()
    {
        # code...
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateVisitRequest $request
     * @return void
     */
    public function store(CreateVisitRequest $request)
    {

        $request->commit();

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }
}

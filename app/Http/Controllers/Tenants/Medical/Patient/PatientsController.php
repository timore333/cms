<?php

namespace App\Http\Controllers\Tenants\Medical\Patient;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Medical\Patient\Patient;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PatientsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Tenants/Medical/Patient/Patient/Index', [
            'patients' => fn() => Patient::with('phones')->get(),
        ])->withViewData(['title' => __('general.patients')]);

        $patients = Patient::with('phones')->get();
        $user = new UserResource(auth()->user());
        return view('medical.patients.index', compact('patients', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Tenants/Medical/Patient/Patient/Create', [
            'patients' => fn() => Patient::with('phones')->get(),
        ])->withViewData(['title' => __('general.create_patient')]);

        $insuranceCompanies = InsuranceCompany::all('name', 'id');
        return view('medical.patients.create', compact('insuranceCompanies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePatientRequest $request
     * @return void
     */
    public function store(CreatePatientRequest $request)
    {

        $request->update();
    }

    /**
     * Display the specified resource.
     *
     * @param Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        $patient->load('photos', 'phones', 'prescriptions', 'insuranceCard', 'insuranceServiceRequests', 'diseases', 'allergies', 'visits', 'teeth');
        $patient = new PatientResource($patient);
        $user = new \App\Http\Resources\Users\UserResource(auth()->user());
        return view('medical.patients.show', compact('patient', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        $insuranceCompanies = InsuranceCompany::all('name', 'id');
        return view('medical.patients.edit', compact('patient', 'insuranceCompanies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePatientRequest $request
     * @param Patient $patient
     * @return void
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {

        $request->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Patient $patient
     * @return void
     * @throws \Exception
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
    }
}

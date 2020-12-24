<?php

namespace App\Http\Controllers\Tenants\Client\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Patient\CreatePatientRequest;
use App\Http\Requests\Client\Patient\UpdatePatientRequest;
use App\Models\Tenants\Client\Insurance\Company;
use App\Models\Tenants\Client\Patient\Patient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PatientsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return inertia response
     */
    public function index()
    {
        return Inertia::render('Tenants/Client/Patient/Patient/Index', [
            'patients' => fn() => Patient::with('phones')->get(),
        ])->withViewData(['title' => __('general.patients')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return inertia Response
     */
    public function create()
    {
        return Inertia::render('Tenants/Client/Patient/Patient/Create', [
            'patients' => fn() => Patient::with('phones')->get(),
            'insuranceCompanies ' => fn() => Company::get(),
        ])->withViewData(['title' => __('general.create_patient')]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePatientRequest $request
     * @return
     */
    public function store(CreatePatientRequest $request)
    {
        $request->update();
        return Redirect::route('patients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Patient $patient
     * @return Response
     */
    public function show(Patient $patient)
    {
        return Inertia::render('Tenants/Client/Patient/Patient/Show', [
            'patient' => fn() =>$patient->load('photos', 'phones', 'prescriptions', 'card', 'serviceRequests', 'diseases', 'allergies', 'visits', 'teeth'),
        ])->withViewData(['title' => $patient->name]);

        $patient->load('photos', 'phones', 'prescriptions', 'card', 'serviceRequests', 'diseases', 'allergies', 'visits', 'teeth');
        //        $patient = new PatientResource($patient);
        //        $user = new \App\Http\Resources\Users\UserResource(auth()->user());
        return view('medical.patients.show', compact('patient', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Patient $patient
     * @return Response
     */
    public function edit(Patient $patient)
    {
        $insuranceCompanies = Company::all('name', 'id');
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
     * @throws Exception
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
    }
}

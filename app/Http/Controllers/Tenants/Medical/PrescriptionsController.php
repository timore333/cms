<?php

namespace App\Http\Controllers\Tenants\Medical;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Medical\Drug\Prescription;
use App\Models\Tenants\Medical\Drug\Remedy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PrescriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Prescription[]|Collection
     */
    public function index()
    {
       return Prescription::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Prescription
     */
    public function store(Request $request)
    {

     $prescription = new Prescription;
     $prescription->doctor_id = $request->doctor;
     $prescription->patient_id = $request->patient;
     $prescription->save();

     foreach ($request->prescription as $drug) {

        $remedy = new Remedy;
        $remedy->drug_id = $drug["id"];
        $remedy->drug_name = $drug["name"];
        $remedy->concentration = $drug["concentration"];
        $remedy->dose = $drug["dose"];
        $remedy->duration = $drug["duration"];
        $remedy->form = $drug["form"];
        $remedy->notes = $drug["notes"];

        $prescription->remedies()->save($remedy);

     }

     return $prescription;


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
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

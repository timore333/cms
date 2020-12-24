<?php

namespace App\Http\Controllers\Tenants\Medical;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Medical\Symptom;
use Illuminate\Http\Request;

class SymptomsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $symptoms = Symptom::paginate(8);
        return view('medical.symptoms.index',compact('symptoms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|string',
        ]);
        Symptom::create($request->all());
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Symptom $symptom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Symptom $symptom)
    {
        $request->validate([
            'name' =>'required|string',
        ]);

        $symptom->update($request->all());
       // return redirect('symptoms')->with('message','Symptom updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Symptom $symptom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Symptom $symptom)
    {
        $symptom->delete();
    }
}

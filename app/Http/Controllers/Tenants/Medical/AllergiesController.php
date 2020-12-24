<?php

namespace App\Http\Controllers\Tenants\Medical;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Medical\Allergy;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AllergiesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $allergies = Allergy::paginate(8);
        return view('medical.allergies.index',compact('allergies'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|string',
        ]);
        Allergy::create($request->all());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Allergy $allergy
     * @return void
     */
    public function update(Request $request, Allergy $allergy)
    {
        $request->validate([
            'name' =>'required|string',
        ]);

        $allergy->update($request->all());
       // return redirect('allergies')->with('message','allergy updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Allergy $allergy
     * @return void
     * @throws Exception
     */
    public function destroy(Allergy $allergy)
    {
        $allergy->delete();
    }
}

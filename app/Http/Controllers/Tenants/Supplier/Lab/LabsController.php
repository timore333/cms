<?php

namespace App\Http\Controllers\Tenants\Supplier\Lab;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LabsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labs = Lab::paginate(8);
        return view('labs.lab.index', compact('labs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('labs.lab.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $lab =  Lab::create($request->only('name','address'));
        if ($request->has('phones')) {
           $lab->addPhones($request['phones']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Lab $lab
     * @return \Illuminate\Http\Response
     */
    public function show(Lab $lab)
    {
        return view('medical.labs.show',compact('lab'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Lab $lab
     * @return \Illuminate\Http\Response
     */
    public function edit(Lab $lab)
    {
        $priceLists = PriceList::all();
        return view('medical.labs.edit',compact('lab','priceLists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Lab $lab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lab $lab)
    {
        $lab->update($request->only('name','address'));

        return redirect('/labs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Lab $lab
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lab $lab)
    {
        $lab->delete();
    }
}

<?php

namespace App\Http\Controllers\Tenants\Medical;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $signs = Sign::paginate(8);
        return view('medical.signs.index',compact('signs'));
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
        Sign::create($request->all());
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Sign $sign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sign $sign)
    {
        $request->validate([
            'name' =>'required|string',
        ]);

        $sign->update($request->all());
       // return redirect('signs')->with('message','Sign updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Sign $sign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sign $sign)
    {
        $sign->delete();
    }
}

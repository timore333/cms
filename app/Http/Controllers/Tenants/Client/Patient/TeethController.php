<?php

namespace App\Http\Controllers\Tenants\Client\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeethController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tooth $tooth)
    {

       $finding = new Finding;
       $finding->name = $request->finding;
       $finding->save();
       $surface = $tooth->getSurface($request->surface);

       if ($request->finding === 'clear') {

           $surface->findings()->detach();
       }
       elseif ($request->finding === 'implant') {
         $surface->findings()->detach();
         $surface->findings()->attach($finding);
       }
       else
       {
          $surface->findings()->attach($finding);
       }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

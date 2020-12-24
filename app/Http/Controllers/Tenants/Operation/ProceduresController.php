<?php

namespace App\Http\Controllers\Tenants\Operation;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Operation\Procedure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProceduresController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $procedures = Procedure::paginate(8);
        return view('medical.procedures.index', compact('procedures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        Procedure::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Procedure $procedure
     * @return void
     */
    public function update(Request $request, Procedure $procedure)
    {
        $procedure->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Procedure $procedure
     * @return void
     * @throws Exception
     */
    public function destroy(Procedure $procedure)
    {
        $procedure->delete();
    }
}

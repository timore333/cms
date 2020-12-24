<?php

namespace App\Http\Controllers\Tenants\Medical;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medical\CreateDrugsRequest;
use App\Models\Tenants\Medical\Drug\Drug;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DrugsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $drugs = Drug::paginate(8);
       return view('medical/drugs/index', compact('drugs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $forms = Drug::FORMS;
        $uses = Drug::USES;
        $companies = Drug::COMPANIES;
        return view('medical.drugs.create',compact('forms','uses','companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateDrugsRequest $request
     * @return Response
     */
    public function store(CreateDrugsRequest $request)
    {
        Drug::create($request->all());
        return redirect('drugs');
    }

    /**
     * Display the specified resource.
     *
     * @param Drug $drug
     * @return Response
     */
    public function show(Drug $drug)
    {
        return view('medical.drugs.show',compact('drug'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Drug $drug
     * @return Response
     */
    public function edit(Drug $drug)
    {
        $forms = Drug::FORMS;
        $uses = Drug::USES;
        $companies = Drug::COMPANIES;
        return view('medical.drugs.edit',compact('drug','forms','uses','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Drug $drug
     * @return Response
     */
    public function update(Request $request, Drug $drug)
    {

        $drug->update($request->all());
        return redirect('drugs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Drug $drug
     * @return void
     * @throws Exception
     */
    public function destroy(Drug $drug)
    {
        $drug->delete();
    }
}

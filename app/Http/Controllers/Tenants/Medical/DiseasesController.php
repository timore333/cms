<?php

namespace App\Http\Controllers\Tenants\Medical;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medical\CreateDiseasesRequest;
use App\Models\Tenants\Medical\Disease;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DiseasesController extends Controller
{

    public function __construct()
    {
        // $this->middleware('role:super-admin')->except('show','edit','update','updatePassword');
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $diseases = Disease::paginate(8);
        return view('medical.diseases.index', compact('diseases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Disease::CATIGORIES;
        $types = Disease::TYPES;

        return view('medical.diseases.create', compact('types', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateDiseasesRequest $request
     * @return Response
     */
    public function store(CreateDiseasesRequest $request)
    {
        $request->storeDisease();

        return redirect('diseases');
    }

    /**
     * Display the specified resource.
     *
     * @param Disease $disease
     * @return Response
     */
    public function show(Disease $disease)
    {
        return view('medical.diseases.show', compact('disease'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Disease $disease
     * @return Response
     */
    public function edit(Disease $disease)
    {
        $categories = Disease::CATIGORIES;
        $types = Disease::TYPES;
        return view('medical.diseases.edit', compact('disease', 'categories', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Disease $disease
     * @return Response
     */
    public function update(Request $request, Disease $disease)
    {
        $disease->update($request->all());
        return redirect('diseases');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Disease $disease
     * @return void
     * @throws \Exception
     */
    public function destroy(Disease $disease)
    {
        $disease->delete();
    }
}

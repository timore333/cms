<?php

namespace App\Http\Controllers\Tenants\Client\Insurance;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Client\Insurance\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $companies = Company::paginate(8);
        return view('medical.insuranceCompanies.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
       return view('medical.insuranceCompanies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $company = Company::create($request->all());
        $company->createDefaultAccount();
        return redirect('insurance-companies')->with('message',"Insurance Company created");
    }

    /**
     * Display the specified resource.
     *
     * @param Company $insurance_company
     * @return Response
     */
    public function show(Company $insurance_company)
    {
        return view('medical.insuranceCompanies.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $insurance_company
     * @return Response
     */
    public function edit(Company $insurance_company)
    {
       return view('medical.insuranceCompanies.edit',compact('insurance_company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Company $insurance_company
     * @return Response
     */
    public function update(Request $request, Company $insurance_company)
    {
        $request->validate([
            'name' =>'required',
        ]);

        $insurance_company->update($request->all());
        return redirect('insurance-companies')->with('message','Company Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $insurance_company
     * @return void
     * @throws Exception
     */
    public function destroy(Company $insurance_company)
    {
        $insurance_company->delete();
    }
}

<?php

namespace App\Http\Controllers\Tenants\Management\Ledger;

use App\Http\Controllers\Controller;
use App\Http\Requests\Managment\Ledger\PriceList\CreatePriceListRequest;
use App\Http\Requests\Managment\Ledger\PriceList\UpdatePriceListRequest;
use App\Models\Tenants\Managment\Ledger\PriceList;
use App\Models\Tenants\Operation\Procedure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PriceListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $priceLists = PriceList::paginate(8);
        return view('medical.priceLists.index',compact('priceLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $services = Procedure::all();
        return view('medical.priceLists.create',compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePriceListRequest $request
     * @return void
     */
    public function store(CreatePriceListRequest $request)
    {
        $request->createPriceList();
    }

    public function show(PriceList $priceList)
    {
        // return $priceList;
        return view('medical.priceLists.show',compact('priceList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PriceList $priceList
     * @return Response
     */
    public function edit(PriceList $priceList)
    {
        $id = $priceList->id;
        $title = $priceList->name;
        return view('medical.priceLists.edit',compact('id', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePriceListRequest $request
     * @param PriceList $priceList
     * @return void
     */
    public function update(UpdatePriceListRequest $request, PriceList $priceList)
    {
        $request->updatePriceList($priceList);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PriceList $priceList
     * @return void
     * @throws Exception
     */
    public function destroy(PriceList $priceList)
    {
        if($priceList->id === 1){return;}
        $priceList->delete();
    }

}

<?php

namespace App\Http\Controllers\Tenants\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $suppliers = Supplier::paginate(8);
       return view('setting.suppliers.index',compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $supplier =  new Supplier();
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->save();
        $supplier->createDefaultAccount();
        if ($request->has('phones')) {
           $phones = $request->get('phones');
           foreach ($phones as $key => $val) {
                if ($val) {
                   $phone = new Phone();
                   $phone->type = title_case($key);
                   $phone->number = $val;
                   $supplier->phones()->save($phone);
                }
           }
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $supplier->update($request->all());
        $supplier->removeAllPhones();
        $phones = $request->get('phones');

        foreach ($phones as $key => $val) {
            if ($val) {
               $phone = new Phone();
               $phone->type = title_case($key);
               $phone->number = $val;
               $supplier->phones()->save($phone);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
    }
}

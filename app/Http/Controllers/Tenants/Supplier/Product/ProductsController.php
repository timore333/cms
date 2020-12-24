<?php

namespace App\Http\Controllers\Tenants\Supplier\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $products = Product::with(['dentalCompany','productCatigory'])->paginate(8);
       return view('setting.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $forms = Product::FORMS;
       $units = Product::UNITS;
       $bakages = Product::BAKAGE;
       $catigories = ProductCatigory::pluck('title','id');
       $companies = DentalCompany::all();

       return view('setting.products.create', compact('forms','units','bakages','catigories','companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $product = new Product;
       $product->dental_company_id = $request->company;
       $product->product_catigory_id = $request->catigory;
       $product->name = $request->name;
       $product->form = $request->form;
       $product->unit = $request->unit;
       $product->bakage = $request->bakage;
       $product->amount = $request->amount;
       $product->description = $request->description;
       $product->save();
       $product->createCard();

        return redirect('products');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load('dentalCompany','productCatigory');
        return view('setting.products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

       $forms = Product::FORMS;
       $units = Product::UNITS;
       $bakages = Product::BAKAGE;
       $catigories = ProductCatigory::pluck('title','id');
       $companies = DentalCompany::all();

       return view('setting.products.edit', compact('product','forms','units','bakages','catigories','companies'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

       $product->dental_company_id = $request->company;
       $product->product_catigory_id = $request->catigory;
       $product->name = $request->name;
       $product->form = $request->form;
       $product->unit = $request->unit;
       $product->bakage = $request->bakage;
       $product->amount = $request->amount;
       $product->description = $request->description;
       $product->update();
        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     * @param Product $product
     * @return void
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}

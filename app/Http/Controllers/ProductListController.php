<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProductList;
use App\LibItemType;
use App\LibStatus;

class ProductListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $products = ProductList::join('lib_item_type','lib_item_type.type_id','=','product_list.product_type')
                  ->join('lib_status','lib_status.status_id','=','product_list.product_status')
                  ->get();
      $item_types = LibItemType::all();
      $item_status = LibStatus::all();
      return view('layouts.product_list', ['products' => $products, 'item_types' => $item_types, 'item_statuses' => $item_status]);
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
      // return "TEST 2";
      
      ProductList::create([
        'product_name' => $request->input('product_name'),
        'product_desc' => $request->input('product_desc'),
        'product_unit' => $request->input('product_unit'),
        'product_status' => $request->input('product_status'),
        'product_type' => $request->input('product_type')
      ]);

      return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      // return "SHOW";
        // return ProductList::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      // return "EDIT";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // return $request->input('product_id');
      $product_list = ProductList::findOrFail($request->input('product_id'));
        $product_list->product_name = $request->input('product_name');
        $product_list->product_desc = $request->input('product_desc');
        $product_list->product_unit = $request->input('product_unit');
        $product_list->product_type = $request->input('product_type');
        $product_list->product_status = $request->input('product_status');
      $product_list->update();

      return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
      $product_list = ProductList::findOrFail($request->input('product_id'));
      $product_list->delete();
      return back();
    }
}

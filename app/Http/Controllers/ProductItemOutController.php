<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProductItemOut;
use Carbon\Carbon;
use App\LibRequestStatus;
use App\LibReturnStatus;

class ProductItemOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $requests = ProductItemOut:: select('product_item_out.id as request_id', 'product_list.product_name as product_name',
                  'product_item_out.request_status_id as request_status_id', 'product_item_out.request_date as request_date',
                  'users.name as name', 'product_item_out.approved_by as approved_by',
                  'product_item_out.approved_date as approved_date', 'product_item_out.product_eta as product_eta',
                  'product_item_out.product_return_date as product_return_date', 'lib_return_status.return_status_desc as return_status_desc',
                  'product_item_out.remarks as remarks', 'product_item_out.request_notes as request_notes',
                  'lib_request_status.request_status_desc as request_status_desc')
                  ->leftJoin('lib_request_status','lib_request_status.request_status_id','=','product_item_out.request_status_id')
                  ->leftJoin('lib_return_status','lib_return_status.return_status_id','=','product_item_out.return_status_id')
                  ->join('users','users.id','=','product_item_out.user_id')
                  ->join('product_list','product_list.id','=','product_item_out.product_item_id')
                  ->get();

                 
      $request_status = LibRequestStatus::all();
      $return_status = LibReturnStatus::all();
      return view('layouts.request_list', ['requests' => $requests, 'request_status' => $request_status, 'return_status' => $return_status]);
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
      ProductItemOut::create([
        'product_item_id' => $request->input('product_item_id'),
        'request_date' => Carbon::now(),
        'request_notes' => $request->input('request_notes'),
        'user_id' => $request->input('user_id'),
        'request_status_id' => 'RQ'
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
    public function update(Request $request, $id)
    {
      $request_list = ProductItemOut::findOrFail($request->input('request_id'));
        $request_list->request_status_id = $request->input('request_status_id');
        $request_list->approved_by = $request->input('user_id');
        $request_list->approved_date = Carbon::now();
        $request_list->return_status_id = $request->input('return_status_id');
        $request_list->remarks = $request->input('remarks');
      $request_list->update();
      return back();
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

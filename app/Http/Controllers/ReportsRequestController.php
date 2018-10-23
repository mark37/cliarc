<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\ProductItemOut;

class ReportsRequestController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $reports = [];
    return view('layouts.reports-request',  ['reports' => $reports]);
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
  public function show($id, Request $request)
  {
    $start_date = new Carbon($request->input('start_date'));
    $end_date = new Carbon($request->input('end_date'));

    $reports = ProductItemOut::join('users', 'product_item_out.user_id', '=', 'users.id')
              ->join('lib_request_status', 'lib_request_status.request_status_id', '=', 'product_item_out.request_status_id')
              ->join('product_list', 'product_list.id', '=', 'product_item_out.product_item_id')
              ->whereBetween('product_item_out.created_at', [$start_date, $end_date])
              ->get(['users.name as name', 'users.first_name as first_name', 'users.contact_number as contact_number',
                    'product_list.product_name as product_name', 'product_item_out.request_date as request_date',
                    'product_item_out.request_notes as request_notes', 'product_item_out.qty as qty', 'lib_request_status.request_status_desc as request_status_desc']);

    // dd($reports);
    return view('layouts.reports-request', ['reports' => $reports]);
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
      //
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

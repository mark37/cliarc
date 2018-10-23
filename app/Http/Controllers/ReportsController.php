<?php

namespace App\Http\Controllers;
use App\Message;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $reports = [];
    return view('layouts.reports',  ['reports' => $reports]);
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
    // dd($request->input('start_date'));
    $start_date = new Carbon($request->input('start_date'));
    $end_date = new Carbon($request->input('end_date'));

    $reports = Message::join('users', 'messages.user_id', '=', 'users.id')
              ->whereBetween('messages.created_at', [$start_date, $end_date])
              ->whereNotNull('messages.filename')
              ->get(['messages.filename as filename', 'messages.created_at as created_at', 'users.name as name', 
                    'users.first_name as first_name', 'messages.path as path']);

    // dd($reports);
    return view('layouts.reports', ['reports' => $reports]);
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

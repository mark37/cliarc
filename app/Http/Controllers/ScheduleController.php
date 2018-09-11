<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $schedules = Schedule::all();
      return view('layouts.schedule', ['schedules' => $schedules]);
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
      $request->validate([
        'schedule_name' => 'required|string|max:255',
        'schedule_start_date' => 'required|date',
        'schedule_end_date' => 'required|date',
        'schedule_venue' => 'required|string|max:255'
      ]);

      Schedule::create([
        'schedule_name' => $request->input('schedule_name'),
        'schedule_start_date' => Carbon::parse($request->input('schedule_start_date')),
        'schedule_end_date' => Carbon::parse($request->input('schedule_end_date')),
        'schedule_venue' => $request->input('schedule_venue')
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
      $request->validate([
        'schedule_name' => 'required|string|max:255',
        'schedule_start_date' => 'required|date',
        'schedule_end_date' => 'required|date',
        'schedule_venue' => 'required|string|max:255'
      ]);
      
      $schedule = Schedule::findOrFail($request->input('schedule_id'));
        $schedule->schedule_name = $request->input('schedule_name');
        $schedule->schedule_start_date = Carbon::parse($request->input('schedule_start_date'));
        $schedule->schedule_end_date = Carbon::parse($request->input('schedule_end_date'));
        $schedule->schedule_venue = $request->input('schedule_venue');
      $schedule->update();

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
      $product_list = Schedule::findOrFail($request->input('schedule_id'));
      $product_list->delete();
      return back();
    }
}

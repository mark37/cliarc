@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="card"  style="margin: 25px 0">
        <div class="card-header"><span>{{ __('List of Schedule') }}</span>
          @if(Auth::user())
            @if(Auth::user()->is_admin == 'Y')
            <span>
              <button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#addSchedModal">Add+</button>
            </span>
            @endif
          @endif
        </div>
          <table style="table-layout: fixed; word-wrap: break-word;" class="table table-hover ">
            <thead class="thead-light">
              <tr>
                <th>Name</th>
                <th>Details</th>
                <th>Start Date</th>
                <th>Time</th>
                <th>End Date</th>
                <th>Time</th>
                <th>Venue</th>
                @if(Auth::user())
                  @if(Auth::user()->is_admin == 'Y')
                    <th>Action</th>
                  @endif
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($schedules as $schedule)
              <tr>
                <td>{{ $schedule->schedule_name }}</td>
                <td>{{ $schedule->schedule_desc }}</td>
                <td>{{ $schedule->schedule_start_date }}</td>
                <td>{{ \Carbon\Carbon::parse($schedule->schedule_start_time)->format('h:i A') }}</td>
                <td>{{ $schedule->schedule_end_date }}</td>
                <td>{{ \Carbon\Carbon::parse($schedule->schedule_end_time)->format('h:i A') }}</td>
                <td>{{ $schedule->schedule_venue }}</td>
                @if(Auth::user())
                  @if(Auth::user()->is_admin == 'Y')
                    <td width='30%'>
                      
                      <div class="btn-group" data-toggle="button">
                        <button class="btn btn-primary"
                          data-scheduleid="{{ $schedule->schedule_id }}"
                          data-schedulename="{{ $schedule->schedule_name }}" 
                          data-scheduledesc="{{ $schedule->schedule_desc }}" 
                          data-schedulesdate="{{ $schedule->schedule_start_date }}" 
                          data-schedulestime="{{ $schedule->schedule_start_time }}" 
                          data-scheduleedate="{{ $schedule->schedule_end_date }}" 
                          data-scheduleetime="{{ $schedule->schedule_end_time }}" 
                          data-schedulevenue="{{ $schedule->schedule_venue }}" 
                          data-toggle="modal" data-target="#editSched">
                          Edit
                        </button>

                        <button class="btn btn-danger"
                          data-scheduleid="{{ $schedule->schedule_id }}"
                          data-schedulename="{{ $schedule->schedule_name }}" 
                          data-toggle="modal" data-target="#deleteSched">
                          Delete
                        </button>
                      </div>
                    </td>
                  @endif
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
          
          
          <!-- MODAL -->
          <div class="modal fade" id="addSchedModal" tabindex="-1" role="dialog" aria-labelledby="addSchedModal" aria-hidden="true">
            <form method="POST" action="{{ route('schedule') }}" aria-label="{{ __('Schedule') }}">
              @csrf
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="addSchedModal">Add Schedule</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group row">
                        <label for="schedule_name" class="col-md-4 col-form-label text-md-right">{{ __('Seminar Title') }}</label>

                        <div class="col-md-6">
                          <input id="schedule_name" type="text" class="form-control{{ $errors->has('schedule_name') ? ' is-invalid' : '' }}" name="schedule_name" required>

                          @if ($errors->has('schedule_name'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('schedule_name') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="schedule_desc" class="col-md-4 col-form-label text-md-right">{{ __('Seminar Description') }}</label>

                        <div class="col-md-6">
                          <input id="schedule_desc" type="text" class="form-control{{ $errors->has('schedule_desc') ? ' is-invalid' : '' }}" name="schedule_desc" required>

                          @if ($errors->has('schedule_desc'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('schedule_desc') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="schedule_venue" class="col-md-4 col-form-label text-md-right">{{ __('Venue') }}</label>

                        <div class="col-md-6">
                          <input id="prodschedule_venueuct_desc" type="text" class="form-control{{ $errors->has('schedule_venue') ? ' is-invalid' : '' }}" name="schedule_venue" required>

                          @if ($errors->has('schedule_venue'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('schedule_venue') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="schedule_start_date" class="col-md-4 col-form-label text-md-right">{{ __('Start Date') }}</label>

                        <div class="col-md-6">
                          <input id="schedule_start_date" type="date" class="form-control{{ $errors->has('schedule_start_date') ? ' is-invalid' : '' }}" name="schedule_start_date" required>

                          @if ($errors->has('schedule_start_date'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('schedule_start_date') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="schedule_start_time" class="col-md-4 col-form-label text-md-right">{{ __('Start Time') }}</label>

                        <div class="col-md-6">
                          <input id="schedule_start_time" type="time" class="form-control{{ $errors->has('schedule_start_time') ? ' is-invalid' : '' }}" name="schedule_start_time" required>

                          @if ($errors->has('schedule_start_time'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('schedule_start_time') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="schedule_end_date" class="col-md-4 col-form-label text-md-right">{{ __('End Date') }}</label>

                        <div class="col-md-6">
                          <input id="schedule_end_date" type="date" class="form-control{{ $errors->has('schedule_end_date') ? ' is-invalid' : '' }}" name="schedule_end_date" required>

                          @if ($errors->has('schedule_end_date'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('schedule_end_date') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="schedule_end_time" class="col-md-4 col-form-label text-md-right">{{ __('End Time') }}</label>

                        <div class="col-md-6">
                          <input id="schedule_end_time" type="time" class="form-control{{ $errors->has('schedule_end_time') ? ' is-invalid' : '' }}" name="schedule_end_time" required>

                          @if ($errors->has('schedule_end_time'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('schedule_end_time') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </div> 
              </div>
            </form>
          </div>
          <!-- END MODAL -->

          <!-- EDIT MODAL -->
            <div class="modal fade" id="editSched" tabindex="-1" role="dialog" aria-labelledby="editScheds" aria-hidden="true">
              <form id="editForm" method="POST" action="{{ url('/schedule/'. 'test') }}" aria-label="{{ __('Schedule') }}">
                @csrf
                <div class="modal-dialog" role="document">
                
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editScheds">Schedule</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <input id="semindar_id" type="hidden" name="semindar_id">
                      <div class="form-group row">
                        <label for="schedule_name" class="col-md-4 col-form-label text-md-right">{{ __('Seminar Title') }}</label>
                        <input id="schedule_id" type="hidden" name="schedule_id" required>
                        <div class="col-md-6">
                          <input id="schedule_name" type="text" class="form-control{{ $errors->has('schedule_name') ? ' is-invalid' : '' }}" name="schedule_name" required>

                          @if ($errors->has('schedule_name'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('schedule_name') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="schedule_desc" class="col-md-4 col-form-label text-md-right">{{ __('Seminar Description') }}</label>
                        <input id="schedule_id" type="hidden" name="schedule_id" required>
                        <div class="col-md-6">
                          <input id="schedule_desc" type="text" class="form-control{{ $errors->has('schedule_desc') ? ' is-invalid' : '' }}" name="schedule_desc" required>

                          @if ($errors->has('schedule_desc'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('schedule_desc') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="schedule_venue" class="col-md-4 col-form-label text-md-right">{{ __('Venue') }}</label>

                        <div class="col-md-6">
                          <input id="schedule_venue" type="text" class="form-control{{ $errors->has('schedule_venue') ? ' is-invalid' : '' }}" name="schedule_venue" required>

                          @if ($errors->has('schedule_venue'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('schedule_venue') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="schedule_start_date" class="col-md-4 col-form-label text-md-right">{{ __('Start Date (mm/dd/yyyy)') }}</label>

                        <div class="col-md-6">
                          <input id="schedule_start_date" type="text" class="form-control{{ $errors->has('schedule_start_date') ? ' is-invalid' : '' }}" name="schedule_start_date" required>

                          @if ($errors->has('schedule_start_date'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('schedule_start_date') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="schedule_start_time" class="col-md-4 col-form-label text-md-right">{{ __('Start Time') }}</label>

                        <div class="col-md-6">
                          <input id="schedule_start_time" type="time" class="form-control{{ $errors->has('schedule_start_time') ? ' is-invalid' : '' }}" name="schedule_start_time" required>

                          @if ($errors->has('schedule_start_time'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('schedule_start_time') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="schedule_end_date" class="col-md-4 col-form-label text-md-right">{{ __('End Date (mm/dd/yyyy)') }}</label>

                        <div class="col-md-6">
                          <input id="schedule_end_date" type="text" class="form-control{{ $errors->has('schedule_end_date') ? ' is-invalid' : '' }}" name="schedule_end_date" required>

                          @if ($errors->has('schedule_end_date'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('schedule_end_date') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="schedule_end_time" class="col-md-4 col-form-label text-md-right">{{ __('End Time') }}</label>

                        <div class="col-md-6">
                          <input id="schedule_end_time" type="time" class="form-control{{ $errors->has('schedule_end_time') ? ' is-invalid' : '' }}" name="schedule_end_time" required>

                          @if ($errors->has('schedule_end_time'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('schedule_end_time') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" onclick="event.preventDefault(); document.getElementById('editForm').submit();" class="btn btn-primary">Update</button>
                    </div>
                  </div>
                </div> 
              </form>
            </div>
          <!-- END EDIT MODAL -->

          <!-- DELETE MODAL -->
          <div class="modal fade" id="deleteSched" tabindex="-1" role="dialog" aria-labelledby="deleteScheds" aria-hidden="true">
            <form id="deleteForm" method="POST" action="{{ url('/schedule/'. 1) }}" aria-label="{{ __('Schedule') }}">
            {!! method_field('delete') !!}
            @csrf
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="deleteScheds">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <input id="schedule_id" type="hidden" name="schedule_id">
                    <span>Are you sure you want to delete this item?</span>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="event.preventDefault(); document.getElementById('deleteForm').submit();" class="btn btn-danger">Delete</button>
                  </div>
                </div>
              </div> 
            </form>
          </div>
          <!-- END DELETE MODAL -->

          
        </div>
      </div>
    </div>
    
  </div>
@endsection
@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="column justify-content-center">
      <div class="card"  style="margin: 25px 0" >
        <form method="GET" class="form-inline" action="{{ url('/reports-request/'.'test') }}" aria-label="{{ __('reports') }}">
          <div class="form-group column">
            <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Start Date (mm/dd/yyyy)') }}</label>

            <div class="col-md-6">
              <input id="start_date" type="text" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" name="start_date" value="{{ old('start_date') }}" required autofocus>

              @if ($errors->has('start_date'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('start_date') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group column">
            <label for="end_date" class="col-md-4 col-form-label text-md-right">{{ __('End Date (mm/dd/yyyy)') }}</label>

            <div class="col-md-6">
              <input id="end_date" type="text" class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" name="end_date" value="{{ old('end_date') }}" required autofocus>

              @if ($errors->has('end_date'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('end_date') }}</strong>
                </span>
              @endif
            </div>
          </div>
          
          <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                      {{ __('Generate') }}
                  </button>
              </div>
          </div>
        </form>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="card"  style="margin: 25px 0" >
        <div class="card-header"><span>{{ __('Files/Reports Uploaded') }}</span>
        </div>
          <table style="table-layout: fixed; word-wrap: break-word;" class="table table-hover ">
            <thead class="thead-light">
              <tr>
                <th>Requested by</th>
                <th>Contact Number</th>
                <th>Product Requested</th>
                <th>Request Date</th>
                <th>Request Notes</th>
                <th>Request Qty</th>
                <th>Request Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($reports as $report)
                <tr>
                  <td>{{ $report->name }}</td>
                  <td>{{ $report->contact_number }}</td>
                  <td>{{ $report->product_name }}</td>
                  <td>{{ $report->request_date }}</td>
                  <td>{{ $report->request_notes }}</td>
                  <td>{{ $report->qty }}</td>
                  <td>{{ $report->request_status_desc }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="card">
        <div class="card-header"><span>{{ __('Files/Reports Uploaded') }}</span>
        </div>
          <table style="table-layout: fixed; word-wrap: break-word;" class="table table-hover ">
            <thead class="thead-light">
              <tr>
                <th>File</th>
                <th>Uploaded By</th>
                <th>Date Uploaded</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($reports as $report)
              <tr>
                <td> <a href="{{ url('files/'.$report->path_name.'/'.$report->filename) }}">{{ $report->filename }}</a></td>
                <td>{{ $report->name }}</td>
                <td>{{ $report->created_at }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
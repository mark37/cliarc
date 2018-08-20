@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="card">
        <div class="card-header">{{ __('Item Masterlist') }}</div>
          <!-- <div class="card-body"> -->
            <table class="table table-hover ">
              <thead class="thead-light">
                <tr>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Unit</th>
                  <th>Item Type</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                  <tr>
                    <td>Sample</td>
                    <td>Sample</td>
                    <td>Wireless Access for Health</td>
                    <td>San Vicente</td>
                    <td>Active</td>
                    <td>
                      <button class="btn btn-danger" type="button">Delete</button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          <!-- </div> -->
        </div>
      </div>
    </div>
  </div>
@endsection
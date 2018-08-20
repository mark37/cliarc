@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="card">
        <div class="card-header">{{ __('User Accounts') }}</div>
          <!-- <div class="card-body"> -->
            <table class="table table-hover ">
              <thead class="thead-light">
                <tr>
                  <th>Name</th>
                  <th>E-mail</th>
                  <th>Orgranization</th>
                  <th>Address</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>Wireless Access for Health</td>
                    <td>San Vicente</td>
                    <td>Active</td>
                    <td>
                      <button class="btn btn-primary" type="button">Edit</button>
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
@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="card">
        <div class="card-header"><span>{{ __('Item Masterlist') }}</span>
          <span>
            <button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#addItemModal">Add+</button>
          </span>
        </div>
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
            </tbody>
          </table>
          <!-- </div> -->

          <!-- MODAL -->
          <div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addItemModal">Add Product</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                      <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                      @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('email') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save</button>
                </div>
              </div>
            </div>
          </div>
          <!-- END MODAL -->
        </div>
      </div>
    </div>
  </div>
@endsection
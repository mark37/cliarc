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
                    <button class="btn btn-primary" type="button">View</button>
                    <button class="btn btn-danger" type="button">Delete</button>
                  </td>
                </tr>
            </tbody>
          </table>
          <!-- </div> -->

          <!-- MODAL -->
          
            <!-- @yield('item-modal') -->
            <div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModal" aria-hidden="true">
              <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
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
                        <label for="item_name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>

                        <div class="col-md-6">
                          <input id="item_name" type="text" class="form-control{{ $errors->has('item_name') ? ' is-invalid' : '' }}" name="item_name" required>

                          @if ($errors->has('item_name'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('item_name') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="item_desc" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                        <div class="col-md-6">
                          <input id="item_desc" type="text" class="form-control{{ $errors->has('item_desc') ? ' is-invalid' : '' }}" name="item_desc" required>

                          @if ($errors->has('item_desc'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('item_desc') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="item_unit" class="col-md-4 col-form-label text-md-right">{{ __('Unit') }}</label>

                        <div class="col-md-6">
                          <input id="item_unit" type="text" class="form-control{{ $errors->has('item_unit') ? ' is-invalid' : '' }}" name="item_unit" required>

                          @if ($errors->has('item_unit'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('item_unit') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="item_type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                        <div class="col-md-6">
                          <input id="item_type" type="text" class="form-control{{ $errors->has('item_type') ? ' is-invalid' : '' }}" name="item_type" required>

                          @if ($errors->has('item_type'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('item_type') }}</strong>
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
            </form>
          </div>
          <!-- END MODAL -->
        </div>
      </div>
    </div>
  </div>
@endsection
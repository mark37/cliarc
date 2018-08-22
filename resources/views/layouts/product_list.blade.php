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
          <table style="table-layout: fixed; word-wrap: break-word;" class="table table-hover ">
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
              @foreach ($products as $product)
              <tr>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->product_desc }}</td>
                <td>{{ $product->product_unit }}</td>
                <td>{{ $product->type_desc }}</td>
                <td>{{ $product->status_desc }}</td>
                <!-- <td>Active</td> -->
                <td width='30%'>
                  <button class="btn btn-primary"
                    data-productid="{{ $product->id }}"
                    data-productname="{{ $product->product_name }}" 
                    data-productdesc="{{ $product->product_desc }}" 
                    data-productstatus="{{ $product->product_status }}" 
                    data-productunit="{{ $product->product_unit }}" 
                    data-producttype="{{ $product->product_type }}" 
                    data-toggle="modal" data-target="#editModal">
                    Edit
                  </button>

                  <button class="btn btn-info"
                    data-productid="{{ $product->id }}"
                    data-productname="{{ $product->product_name }}" 
                    data-toggle="modal" data-target="#requestModal">
                    Request
                  </button>

									<button class="btn btn-danger"
                    data-productid="{{ $product->id }}"
                    data-productname="{{ $product->product_name }}" 
                    data-toggle="modal" data-target="#deleteModal">
                    Delete
                  </button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <!-- </div> -->


          <!-- MODAL -->
          <div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModal" aria-hidden="true">
            <form method="POST" action="{{ route('product_list') }}" aria-label="{{ __('Product') }}">
              @csrf
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
                        <label for="product_name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>

                        <div class="col-md-6">
                          <input id="product_name" type="text" class="form-control{{ $errors->has('product_name') ? ' is-invalid' : '' }}" name="product_name" required>

                          @if ($errors->has('product_name'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('product_name') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="product_desc" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                        <div class="col-md-6">
                          <input id="product_desc" type="text" class="form-control{{ $errors->has('product_desc') ? ' is-invalid' : '' }}" name="product_desc" required>

                          @if ($errors->has('product_desc'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('product_desc') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="product_status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                        <div class="form-group col">
                          @foreach ($item_statuses as $item_status)
                            <div class="radio">
                              <label><input type="radio" name="product_status" value="{{ $item_status->status_id }}">{{ $item_status->status_desc }}</label>
                            </div>
                          @endforeach
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="product_unit" class="col-md-4 col-form-label text-md-right">{{ __('Unit') }}</label>

                        <div class="col-md-6">
                          <input id="product_unit" type="text" class="form-control{{ $errors->has('product_unit') ? ' is-invalid' : '' }}" name="product_unit" required>

                          @if ($errors->has('product_unit'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('product_unit') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="product_type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                        <div class="form-group col">
                          @foreach ($item_types as $item_type)
                            <div class="radio">
                              <label><input type="radio" name="product_type" value="{{ $item_type->type_id }}">{{ $item_type->type_desc }}</label>
                            </div>
                          @endforeach
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
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModals" aria-hidden="true">
              <form id="editForm" method="POST" action="{{ url('/product_list/'. 'test') }}" aria-label="{{ __('Product') }}">
                @csrf
                <div class="modal-dialog" role="document">
                
                  <div class="modal-content">
                 
                    <div class="modal-header">
                      <h5 class="modal-title" id="editModals">Edit Product</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <input id="product_id" type="hidden" name="product_id">
                      <div class="form-group row">
                        <label for="product_name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>

                        <div class="col-md-6">
                          <input id="product_name" type="text" class="form-control{{ $errors->has('product_name') ? ' is-invalid' : '' }}" name="product_name" required>

                          @if ($errors->has('product_name'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('product_name') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="product_desc" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                        <div class="col-md-6">
                          <input id="product_desc" type="text" class="form-control{{ $errors->has('product_desc') ? ' is-invalid' : '' }}" name="product_desc" required>

                          @if ($errors->has('product_desc'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('product_desc') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="product_status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                        <div class="form-group col">
                          @foreach ($item_statuses as $item_status)
                            <div class="radio">
                              <label><input type="radio" name="product_status" value="{{ $item_status->status_id }}">{{ $item_status->status_desc }}</label>
                            </div>
                          @endforeach
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="product_unit" class="col-md-4 col-form-label text-md-right">{{ __('Unit') }}</label>

                        <div class="col-md-6">
                          <input id="product_unit" type="text" class="form-control{{ $errors->has('product_unit') ? ' is-invalid' : '' }}" name="product_unit" required>
                          
                          @if ($errors->has('product_unit'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('product_unit') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="product_type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                        <div class="form-group col">
                          @foreach ($item_types as $item_type)
                            <div class="radio">
                              <label><input type="radio" name="product_type" value="{{ $item_type->type_id }}" {{ $item_type->type_id == 'BD' ? 'checked' : ''}}>{{ $item_type->type_desc }}</label>
                          
                              
                            </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" onclick="event.preventDefault(); document.getElementById('editForm').submit();" class="btn btn-primary">Update</button>
                    </div>
                  </div>
                </div> 
              </div>
            </form>
          </div>
          <!-- END EDIT MODAL -->

          <!-- DELETE MODAL -->
          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModals" aria-hidden="true">
            <form id="deleteForm" method="POST" action="{{ url('/product_list/'. 1) }}" aria-label="{{ __('Product') }}">
            {!! method_field('delete') !!}
            @csrf
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="deleteModals">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <input id="product_id" type="hidden" name="product_id">
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

          <!-- REQUEST MODAL -->
          <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModals" aria-hidden="true">
            <form method="POST" action="{{ route('product_item_out') }}" aria-label="{{ __('Request Product') }}">
              @csrf
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="requestModals">Request Product</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <input id="product_item_id" type="hidden" name="product_item_id">
                      <input id="user_id" type="hidden" name="user_id" value="{{ Auth::user()->id }} ">
                      <div class="form-group row">
                        <label for="product_name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>

                        <div class="col-md-6">
                          <input id="product_name" type="text" class="form-control{{ $errors->has('product_name') ? ' is-invalid' : '' }}" name="product_name" disabled>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="request_notes" class="col-md-4 col-form-label text-md-right">{{ __('Notes') }}</label>

                        <div class="col-md-6">
                          <textarea id="request_notes" rows="3" class="form-control{{ $errors->has('request_notes') ? ' is-invalid' : '' }}" name="request_notes"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Request</button>
                    </div>
                  </div>
                </div> 
              </div>
            </form>
          </div>
        <!-- END REQUEST MODAL -->
        </div>
      </div>
    </div>
  </div>
@endsection
@extends('layouts.app')

@section('content')
  <div class="container">
    @if(Auth::user()->account_type == 'CL')
      <div style="margin:25px 0">
      &nbsp:
      </div>
      <div class="row text-center" style="margin:25px 0">
        @foreach ($products as $product)
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
              <img class="card-img-top" src="storage/{{ $product->filename }}" alt="{{ $product->filename }}">
              <div class="card-body">
                <h4 class="card-title">{{ $product->product_name }}</h4>
                <p class="card-text">{{ $product->product_desc }}</p>
                <p class="card-text">Status: {{ $product->request_status_id }}</p>
              </div>
              <div class="card-footer" >
                <button class="btn btn-info"
                  data-productid="{{ $product->id }}"
                  data-productname="{{ $product->product_name }}" 
                  data-userid="{{ Auth::user()->id }}"
                  data-toggle="modal" data-target="#requestModal" {{ $product->request_status_id == 'NOT AVAILABLE' ? 'disabled' : '' }}>
                  Request
                </button>
              </div>
            </div>
          </div>
        @endforeach

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
    @endif

    @if(Auth::user()->account_type != 'CL')
    <div class="row justify-content-center">
      <div class="card"  style="margin: 25px 0">
      
        <div class="card-header"><span>{{ __('Item Masterlist') }}</span>
          @if(Auth::user()->is_admin == 'Y')
          <span>
            <button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#addItemModal">Add+</button>
          </span>
          @endif
        </div>
        

          
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
                <td>{{ $product->product_name }}<img class="card-img-top" src="storage/{{ $product->filename }}" alt="{{ $product->filename }}"></td>
                <td>{{ $product->product_desc }}</td>
                <td>{{ $product->product_unit }}</td>
                <td>{{ $product->type_desc }}</td>
                <td>{{ $product->status_desc }}</td>
                <!-- <td>Active</td> -->
                <td width='30%'>
                  @if(Auth::user()->is_admin == 'Y')
                  <div class="btn-group" data-toggle="button">
                    <button class="btn btn-primary"
                      data-productid="{{ $product->id }}"
                      data-productname="{{ $product->product_name }}" 
                      data-productdesc="{{ $product->product_desc }}" 
                      data-productstatus="{{ $product->product_status }}" 
                      data-productunit="{{ $product->product_unit }}" 
                      data-producttype="{{ $product->product_type }}" 
                      data-filename="{{ $product->filename }}" 
                      data-toggle="modal" data-target="#editModal">
                      Edit
                    </button>

                    <button class="btn btn-danger"
                      data-productid="{{ $product->id }}"
                      data-productname="{{ $product->product_name }}" 
                      data-toggle="modal" data-target="#deleteModal">
                      Delete
                    </button>
                  </div>
                @endif

                @if(Auth::user()->account_type == 'CL')
                  <button class="btn btn-info"
                    data-productid="{{ $product->id }}"
                    data-productname="{{ $product->product_name }}" 
                    data-toggle="modal" data-target="#requestModal">
                    Request
                  </button>
                @endif
									
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          
          
          <!-- MODAL -->
          <div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModal" aria-hidden="true">
            <form method="POST" enctype ="multipart/form-data" action="{{ route('product_list') }}" aria-label="{{ __('Product') }}">
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

                      <!-- IMAGE -->
                      <div class="form-group row">
                        <label for="product_image" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>

                        <div class="col-md-6">
                          <input id="product_image" type="file" class="form-control{{ $errors->has('product_image') ? ' is-invalid' : '' }}" name="product_image" required>

                          @if ($errors->has('product_image'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('product_image') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                      <!-- END IMAGE -->
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

                      <!-- IMAGE -->
                      <div class="form-group row">
                        <label for="product_image" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>

                        <div class="col-md-6">
                          <input id="product_image" type="file" class="form-control{{ $errors->has('product_image') ? ' is-invalid' : '' }}" name="product_image" required>

                          @if ($errors->has('product_image'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('product_image') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                      <!-- END IMAGE -->

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

                        <!-- <div class="form-group col">
                          <div class="radio">
                            <label><input type="radio" name="product_type" value="{{ $item_type->type_id }}" {{ $item_type->type_id == 'BD' ? 'checked' : ''}}>{{ $item_type->type_desc }}</label>
                            <label><input type="radio" name="product_type" value="{{ $item_type->type_id }}" {{ $item_type->type_id == 'MC' ? 'checked' : ''}}>{{ $item_type->type_desc }}</label>
                            <label><input type="radio" name="product_type" value="{{ $item_type->type_id }}" {{ $item_type->type_id == 'EQ' ? 'checked' : ''}}>{{ $item_type->type_desc }}</label>
                            <label><input type="radio" name="product_type" value="{{ $item_type->type_id }}" {{ $item_type->type_id == 'SD' ? 'checked' : ''}}>{{ $item_type->type_desc }}</label>
                          </div>
                        </div> -->
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

          
        </div>
      </div>
    </div>
    
    @endif
  </div>
@endsection
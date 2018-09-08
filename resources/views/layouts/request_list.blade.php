@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="card"   style="margin: 25px 0">
        <div class="card-header"><span>{{ __('Requests List') }}</span>
          <!-- <span>
            <button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#addItemModal">Add+</button>
          </span> -->
        </div>
          <!-- <div class="card-body"> -->
          <table style="table-layout: fixed; word-wrap: break-word;" class="table table-hover ">
            <thead class="thead-light">
              <tr>
                <th>Requested by</th>
                <th>Product Requested</th>
                <th>Request Date</th>
                <th>Request Notes</th>
                <th>Request Status</th>
                <th>Return ETA</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($requests as $request)
              <tr>
                <td>{{ $request->name }}</td>
                <td>{{ $request->product_name }}</td>
                <td>{{ $request->request_date }}</td>
                <td>{{ $request->request_notes }}</td>
                <td>{{ $request->request_status_desc }}</td>
                <td>{{ $request->date_returned }}</td>
                <td>
                  <button class="btn btn-primary"
                    data-requestid = "{{ $request->request_id}}"
                    data-productname="{{ $request->product_name }}"
                    data-requestdate="{{ $request->request_date }}"
                    data-requestnotes="{{ $request->request_notes }}"
                    data-requestedby="{{ $request->name }}"
                    data-toggle="modal" data-target="#processRequestModal">
                    Process Request
                  </button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <!-- </div> -->

          <!-- MODAL -->
          <div class="modal fade" id="processRequestModal" tabindex="-1" role="dialog" aria-labelledby="processRequestModals" aria-hidden="true">
            <form method="POST" action="{{ url('/product_item_out/'.'test') }}" aria-label="{{ __('Product Request') }}">
              @csrf
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="processRequestModals">Process Request</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" id="request_id" name="request_id" />
                      <input id="user_id" type="hidden" name="user_id" value="{{ Auth::user()->id }} ">
                      <div class="form-group row">
                        <label for="product_name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>
                        <div class="col-md-6">
                          <input id="product_name" type="text" class="form-control{{ $errors->has('product_name') ? ' is-invalid' : '' }}" name="product_name" disabled>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="requested_by" class="col-md-4 col-form-label text-md-right">{{ __('Requested by') }}</label>
                        <div class="col-md-6">
                          <input id="requested_by" type="text" class="form-control{{ $errors->has('requested_by') ? ' is-invalid' : '' }}" name="requested_by" disabled>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="request_notes" class="col-md-4 col-form-label text-md-right">{{ __('Request Note') }}</label>

                        <div class="col-md-6">
                          <textarea id="request_notes" rows="3" class="form-control{{ $errors->has('request_notes') ? ' is-invalid' : '' }}" name="request_notes" disabled></textarea>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="product_status" class="col-md-4 col-form-label text-md-right">{{ __('Request Status') }}</label>

                        <div class="form-group col">
                          @foreach ($request_status as $status)
                            @if($status->request_status_id != "RQ")
                              <div class="radio">
                                <label><input type="radio" name="request_status_id" value="{{ $status->request_status_id }}">{{ $status->request_status_desc }}</label>
                              </div>
                            @endif
                          @endforeach
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="remarks" class="col-md-4 col-form-label text-md-right">{{ __('Remarks') }}</label>

                        <div class="col-md-6">
                          <textarea id="remarks" rows="3" class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}" name="remarks"></textarea>
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
        </div>
      </div>
    </div>
  </div>
@endsection
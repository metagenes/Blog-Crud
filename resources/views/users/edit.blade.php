@extends('layouts.app', ['activePage' => 'Edit User', 'titlePage' => __('Detail User')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- form update user here -->
          <form method="post" action="{{ route('user.update', $user->id) }}" class="form-horizontal">
            @csrf
            @method('patch')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Detail User') }}</h4>
                <p class="card-category">{{ __('Detail User') }}</p>
              </div>
              <div class="card-body ">
                @if (session('status_password'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status_password') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('User Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="" value="{{ $user->name }}" required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('urlinquiry') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="" value="{{ $user->email }}" required />
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Phone') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('urlcallback') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('urlcallback') ? ' is-invalid' : '' }}" name="phone" id="input-phone" type="phone" placeholder="" value="{{ $user->phone_number }}" required />
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Role') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('role') ? ' has-danger' : '' }}">
                    <!-- select list VA Service -->
                        <select class="form-control" name="role" id="role">
                            <option value="">Select Role</option>
                            <option value="{{$user->role}}" selected>{{ ucfirst($user->role) }}</option>
                            @if ($user->role == 'superadmin')
                                <option value="user">User</option>
                            @endif
                        </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Company') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('role') ? ' has-danger' : '' }}">
                    <!-- select list VA Service -->
                        <select class="form-control" name="company" id="company">
                            <option value="">Select Company</option>
                              <option value="{{$dataMerchant->merchant_id}}" selected>{{$dataMerchant->name}}</option>
                            @foreach($merchantList as $merchant)
                            @if ($merchant->name != $dataMerchant->name)
                              <option value="{{ $merchant->merchant_id }}"> {{ $merchant->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
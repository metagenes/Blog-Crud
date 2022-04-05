@extends('layouts.app', ['activePage' => 'login', 'title' => __('Blog Crud')])

@section('content')
<div class="container" style="height: auto;">

  @if($errors->any())
    <div class="card-header card-header-primary alert" style='background-color: #545454;'>
      @foreach($errors->all() as $error)
        <h4 class="card-title " style="color:white">{{ $error }}</h4>
      @endforeach
    </div>
    @endif
  <!-- banner for logo -->
  <div class="container">
        <a class="navbar-brand">
          <img src="{{ asset('material') }}/img/saga.png"" alt="logo" height="100px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
            </ul>
        </div>
  </div>
          
  <div class="row align-items-center">
    <div class="col-lg-6 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="card-border card-login card-hidden mb-3">
          <div class="card-body" style="align-items:center">
            <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}" style="padding-bottom:15px">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">email</i>
                  </span>
                </div>
                <input type="email" name="email" class="form-control" placeholder="{{ __('Email...') }}" value="" required>
              </div>
              @if ($errors->has('email'))
                <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                  <strong>{{ $errors->first('email') }}</strong>
                </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3" style="padding-bottom:15px">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                </div>
                <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password...') }}" value="" required>
              </div>
              @if ($errors->has('password'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong>{{ $errors->first('password') }}</strong>
                </div>
              @endif
            </div>
            <div class="form-check mr-auto ml-3 mt-4" style="padding-bottom:15px">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember me') }}
                <span class="form-check-sign">
                  <span class="check"></span>
                </span>
              </label>
            </div>
          </div>
          <div class="card-footer-login justify-content-center">
            <button type="submit" class="btn btn-primary btn-link btn-lg">{{ __('LOGIN') }}</button>
          </div>
        </div>
      </form>
      <div class="law-text justify-content-center">
        <h4>Warning!</h4> 
        Unauthorized access is strictly forbidden and may result in the unauthorized user being prosecuted under the law.
      </div>
    </div>
    </div>
  </div>
</div>
@endsection


@push('js')
  <script>
    $(document).ready(function() {
    // show the alert
    setTimeout(function() {
        $(".alert").alert('close');
    }, 2000);
  });
  </script>
  
@endpush
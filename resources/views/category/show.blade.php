@extends('layouts.app', ['activePage' => 'Detail Category', 'titlePage' => __('Category Detail')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Detail Category') }}</h4>
                <p class="card-category">{{ __('Detail Category') }}</p>
              </div>
              <div class="card-body ">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Category Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text"  value="{{ $category->name }}" readonly/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Slug') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('slug') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" id="input-slug" type="text"  value="{{ $category->slug}}" readonly />
                    </div>
                  </div>
                </div>


              </div>
            </div>
      </div>
    </div>
  </div>
  </div>
@endsection


@push('js')
  <script>
    $(document).ready(function() {
      // check value id service type
      var service_type = $('#service_type').val();
      console.log(service_type);
    } );
  </script>
@endpush
@extends('layouts.app', ['activePage' => 'Add Category', 'titlePage' => __('Add Category')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('category.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Add Category') }}</h4>
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
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Category Name') }}" value="" required="true" aria-required="true"/>
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


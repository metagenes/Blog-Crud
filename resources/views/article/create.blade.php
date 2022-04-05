@extends('layouts.app', ['activePage' => 'Add Article', 'titlePage' => __('Add Article')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('article.store') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('post')
              <div class="card ">
                    <div class="card-header card-header-primary">
                      <h4 class="card-title">{{ __('Add Article') }}</h4>
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
                        <label class="col-sm-2 col-form-label">{{ __('Title') }}</label>
                        <div class="col-sm-7">
                          <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                            <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="input-title" type="text" placeholder="{{ __('Title') }}" value="" required="true" aria-required="true"/>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Category') }}</label>
                        <div class="col-sm-7">
                          <div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
                           <!-- select list VA Service -->
                        <select class="form-control" name="category" id="category">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                              @endforeach
                            </optgroup>
                            </div>
                        </select>  
                        </div>
                        </div>
                      </div>

                      <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Banner') }}</label>
                        <div class="col-sm-7">
                          <div class="form-group{{ $errors->has('banner') ? ' has-danger' : '' }}">
                            <!-- input file -->
                            <input type="text" class="form-control" placeholder="Pick a file">
                            <input type="file" class="inputFileHidden">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Content') }}</label>
                        <div class="col-sm-7">
                          <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                            <input class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" id="input-content" type="text" placeholder="{{ __('Content') }}" value="" required />
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
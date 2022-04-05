@extends('layouts.app', ['activePage' => 'Detail', 'titlePage' => __('Detail VA')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
      <form method="post" action="{{ route('article.update',$article->article_id) }}" class="form-horizontal">
          @csrf
          @method('patch')
        <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Detail VA') }}</h4>
                <p class="card-category">{{ __('Detail Virtual Account') }}</p>
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
                  <label class="col-sm-2 col-form-label">{{ __('Banner') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
                      <!-- display image -->
                      <img src="{{ asset('images/article/'.$article->banner) }}" alt="{{ $article->banner }}" width="100px" height="100px">
                    </div>
                  </div>
                </div>


                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Title') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ $article->title }}" value="{{ $article->title }}" readonly/>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Content') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" id="input-content" type="text" placeholder="{{ $article->content }}" value="{{ $article->content }}" readonly/>
                    </div>
                  </div>
                </div>
                <!-- category -->
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Category') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
                      <!-- select list VA Service -->
                  <select class="form-control" name="category" id="category">
                      <option value="">Select Category</option>
                            <option value="{{ $categories->id }}" selected>{{ $categories->name }}</option>
                      </optgroup>
                      </div>
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
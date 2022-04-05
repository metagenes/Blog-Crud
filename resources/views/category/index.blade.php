@extends('layouts.app', ['activePage' => 'category', 'titlePage' => __('Category')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

        @if($errors->any())
                <div class="card-header card-header-primary alert" style='background-color: #545454;'>
                @foreach($errors->all() as $error)
                    <h4 class="card-title " style="color:white">{{ $error }}</h4>
                @endforeach
                </div>
            @endif

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
        <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">category</h4>
              <p class="card-category"> category can be manage in this section</p>
            </div>
            <div class="card-body">
                <div class="row">
                <div class="col-12 text-right">
                  <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary">Create category</a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <tr><th>
                        Name
                    </th>
                    <th class="text-right">
                      Actions
                    </th>
                  </tr></thead>
                  <tbody>
                    @foreach($categories as $category)

                    <tr>
                      <td>
                        {{ $category->name }}
                      </td>
                      <td class="td-actions text-right">
                        <a rel="tooltip" class="btn btn-danger btn-link" href="{{ url('deletecategory', $category->id)}}" onclick="return confirm('Are you sure to delete this data?');">
                        <i class="material-icons">delete</i>
                      </a>

                        <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('category.edit', $category->id) }}" data-original-title="" title="">
                          <i class="material-icons">edit</i>
                          <div class="ripple-container"></div>
                        </a>
                        <a rel="tooltip" class="btn btn-info btn-link" href="{{ route('category.show', $category->id) }}" data-original-title="" title="">
                          <i class="material-icons">visibility</i>
                          <div class="ripple-container"></div>
                        </a>
                      </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.password') }}" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Change password') }}</h4>
                <p class="card-category">{{ __('Password') }}</p>
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
                  <label class="col-sm-2 col-form-label" for="input-current-password">{{ __('Current Password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" input type="password" name="old_password" id="input-current-password" placeholder="{{ __('Current Password') }}" value="" required />
                      @if ($errors->has('old_password'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('old_password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password">{{ __('New Password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" type="password" placeholder="{{ __('New Password') }}" value="" required />
                      @if ($errors->has('password'))
                        <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('Confirm New Password') }}" value="" required />
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Change password') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div> -->
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
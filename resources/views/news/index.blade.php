@extends('layouts.app', ['activePage' => 'Dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <!-- card image for latest 5 post -->
        <div class="row">
            <div class="col-md-12">
            @if($errors->any())
                <div class="card-header card-header-primary alert" style='background-color: #545454;'>
                @foreach($errors->all() as $error)
                    <h4 class="card-title " style="color:white">{{ $error }}</h4>
                @endforeach
                </div>
            @endif

                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">List News</h4>
                    </div>
                    <div class="card-body">
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection


@extends('layouts.app', ['activePage' => 'Dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <!-- card image for latest 5 post -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Latest 5 Post</h4>
                    </div>
                    <div class="card-body">
                    @foreach ($article as $item)
                    <div class="row" style="justify-content:center">
                        <div class="card" style="width: 50rem;padding-left:center">
                            <img class="card-img-top" src="{{ asset('images/article/'.$item->banner) }}" alt="{{ $item->banner }}" >
                            <div class="card-body">
                                <p class="card-text">{{ $item->title }}</p>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $item->content }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection


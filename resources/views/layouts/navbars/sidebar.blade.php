<div class="sidebar" data-color="orange" data-background-color="white" data-image="">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a class="simple-text logo-normal">
      <i><img style="width:80px" src="{{ asset('material') }}/img/saga.png"></i>
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'Dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <!-- a m r  t u  -->
      <!-- Article -->
      <li class="nav-item{{ $activePage == 'Article' || $activePage == 'Article' ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#articleList" aria-expanded="true">
          <!-- <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i> -->
          <p>{{ __('article') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="Article">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'Article' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('article.index')}}">
                <i class="material-icons">settings</i>
                <span class="sidebar-normal">{{ __('Article') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>

       <!-- category -->
       <li class="nav-item{{ $activePage == 'category' ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#categoryList" aria-expanded="true">
          <p>{{ __('Category') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="categoryList">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'category' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('category.index') }}">
                <i class="material-icons">list</i>
                <span class="sidebar-normal">{{ __('category') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>


      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <p>{{ __('Users') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <i class="material-icons">person</i>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'User Management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                    <i class="material-icons">people</i>
                    <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>

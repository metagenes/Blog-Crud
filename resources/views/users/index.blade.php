@extends('layouts.app', ['activePage' => 'User Management', 'titlePage' => __('User Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">User Management</h4>
              <p class="card-category">Users can be manage in this section</p>
            </div>
            <div class="card-body">
                              <div class="row">
                <div class="col-12 text-right">
                  <a href="{{ route('user.create')  }}" class="btn btn-sm btn-primary">Add User</a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <tr><th>
                        Name
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Role
                    </th>
                    <th class="text-right">
                      Actions
                    </th>
                  </tr></thead>
                  <tbody>
                    @foreach($users as $user)
                    <tr>
                      <td>
                        {{ $user->name }}
                      </td>
                      <td>
                        {{ $user->email }}
                      </td>
                      <td>
                        {{ $user->role }}
                      </td>
                      <td class="td-actions text-right">
                        <!-- <a rel="tooltip" class="btn btn-success btn-link" href="#" data-original-title="" title="">
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <i class="material-icons">delete</i>
                        </form>
                        </a>   -->
                        <td class="td-actions text-right">
                        <a rel="tooltip" class="btn btn-danger btn-link" href="{{url('deleteuser/'.$user->id)}}" onclick="return confirm('Are you sure to delete this data?');">
                        <i class="material-icons">delete</i>
                      </a>

                        <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('user.edit', $user->user_id) }}" data-original-title="" title="">
                          <i class="material-icons">edit</i>
                          <div class="ripple-container"></div>
                        </a>
                        <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('user.show', $user->user_id) }}" data-original-title="" title="">
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
     
    </div>
  </div>
@endsection
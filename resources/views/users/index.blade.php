@extends('layouts.app')


@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif

    <section class="section">
      <div class="section-header">
        <h1>Users</h1>
        <div class="section-header-button">
          <a href="{{ route('users.create') }}" class="btn btn-primary">Add New</a>
        </div>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Users</a></div>
          <div class="breadcrumb-item">All Users</div>
        </div>
      </div>
      <div class="section-body">
        <h2 class="section-title">Users</h2>
        <p class="section-lead">

        </p>


        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>All Users</h4>
                {{-- <div class="card-header-form">
                    <form action="/users/search" method="GET">
                      <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search" value="{{ old('search') }}">
                        <div class="input-group-btn">
                          <button class="btn btn-primary" type="submit" value="SEARCH"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                  </div> --}}
              </div>
              <div class="card-body">
                  <table class="table table-striped" id="table-1">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>NIM</th>
                      <th>TTL</th>
                      <th>Alamat</th>
                      <th>Angkatan</th>
                      <th>No Hp</th>
                      <th>Email</th>
                      <th>Level</th>
                      <th>Option</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $key => $user)
                    <tr>
                      <td>
                        {{ ++$i }}
                      </td>
                      <td>{{ $user->name }}
                    </td>
                    <td>
                      {{ $user->nim }}
                    </td>
                    <td>
                        {{ $user->ttl }}
                    </td>
                    <td>
                        {{ $user->alamat }}
                    </td>
                    <td>
                        {{ $user->angkatan }}
                    </td>
                    <td>
                        {{ $user->nohp }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->is_admin }}
                    </td>
                    <td>
                        <div class="table-links">
                            <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}">Show</a>
                            {{-- <div class="bullet"></div> --}}
                            <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}">Edit</a>
                            {{-- <div class="bullet"></div> --}}
                            <form action="{{ route('users.destroy', $user->id)}}" method="post">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>

                          </div>
                    </td>
                </tr>
                    </tbody>
                    @endforeach
                  </table>
                </div>

                <div class="float-right">
                    {{ $data->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


@endsection

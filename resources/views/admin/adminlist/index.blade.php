@extends('admin.master.app')
@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title me-5">Admin List</h3>
        Count:{{count($lists)}}
        <div class="card-tools">
         <form action="{{ route('admin#list')}}" method="get">
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" value="{{request('search')}}" name="search" class="form-control float-right" placeholder="Search">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
         </form>
        </div>
      </div>
      @if(session('DeleteMsg'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('DeleteMsg')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <!-- /.card-header -->
      @if (count($lists) !==0)
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>User Name</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>Address</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($lists as $list)
                <tr>
                    <td>{{ $list->id }}</td>
                    <td>{{ $list->name}}</td>
                    <td>{{ $list->email}}</td>
                    <td>{{ $list->phone }}</td>
                    <td>{{ $list->address}}</td>
                    <td>
                    <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                  @if ($list->id != Auth::user()->id)
                  <a href="{{ route('admin#listdelete',$list->id)}}">
                    <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                  </a>
                  @endif
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @else
        <div class="text-center align-self-center text-muted h-100 fs-5 flex justify-content-center align-items-center align-self-center">
            <h1 class="fs-3 vh-100">Anyone No Register Yet Now!</h1>
        </div>
      @endif
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection

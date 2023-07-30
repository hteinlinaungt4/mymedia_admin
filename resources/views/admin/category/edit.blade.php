@extends('admin.master.app')
@section('content')
<div class="col-4">
    @if(session('Msg'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('Msg')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <div class="card">
        <form action="{{ route('admin#categoryupdate')}}" class="p-4" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$editdata->id}}">
            <div class="form-group">
                <label for="">Category Name</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title',$editdata->title)}}">
               @error('title')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
               @enderror
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="" rows="5">{{ old('description',$editdata->description)}}</textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
               @enderror
            </div>
            <button class="btn btn-info">Update</button>
            <a href="{{ route('admin#categorycreate')}}" class="btn btn-primary">Create</a>
        </form>
    </div>
</div>
<div class="col">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
            Category Lists
        </h3>

        <div class="card-tools">
            <form action="{{ route('admin#category')}}" method="GET">
                @csrf
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="Search" value="{{ request('search')}}">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
            </form>
        </div>
      </div>
      <!-- /.card-header -->
    @if (count($categories) !=0)
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap text-center">
            <thead>
                <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                    <td>
                        <div style="height: 200px; overflow:scroll; width:500px;text-wrap: wrap;  text-align: justify;"> {{ $category->description }}</div>
                    </td>
                    <td>
                        <a href="{{ route('admin#categoryeditpage',$category->id)}}">
                            <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                        </a>
                        <a href="{{ route('admin#categorydelete',$category->id)}}">
                            <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    @else
        <div class="mt-5 justify-content-center text-center">
            <h1 class=" text-muted">Does not have any Category</h1>
        </div>
    @endif
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection

@extends('admin.master.app')
@section('content')
    <div class="col-4">
        <div class="card p-3">
            @if (session('Msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('Msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('admin#postupdate') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $editpost->id }}">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        placeholder="Enter Post Title" value="{{ old('title', $editpost->title) }}">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ old('description', $editpost->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    @if ($editpost->image == null)
                        <img src="{{ asset('storage/404.png') }}" alt="" class="img-thumbnail shadow-lg w-100">
                    @else
                        <img src="{{ asset('storage/'.$editpost->image) }}" alt="" class="img-thumbnail shadow-lg w-100">
                    @endif
                    <label for="">Image</label>
                    <input type="file" name="image" id="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Category Name</label>
                    <select name="category" id="" class="form-control @error('category') is-invalid @enderror">
                        <option value="">Choose Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if($editpost->category_id == $category->id) selected @endif>{{ $category->title }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Post List</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td class="w-25">
                                    @if ($post->image == null)
                                        <img src="{{ asset('storage/404.png') }}" alt=""
                                            class="img-thumbnail shadow-lg w-100">
                                    @else
                                        <img src="{{ asset('storage/' . $post->image) }}" alt=""
                                            class="img-thumbnail shadow-lg w-100">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin#posteditpage', $post->id) }}"><button
                                            class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <a href="{{ route('admin#postdelete', $post->id) }}"><button
                                            class="btn btn-sm bg-danger text-white"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection

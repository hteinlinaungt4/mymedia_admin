@extends('admin.master.app')
@section('content')
<div class="col">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Trend Post List</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>Title</th>
              <th>Description</th>
              <th>Image</th>
              <th>ViewCount</th>
            </tr>
          </thead>
          <tbody>
        @foreach ($trendpost as $post)
            <tr>
                <td>{{ $post->title}}</td>
                <td>
                    <div style="height: 200px; overflow:scroll; width:500px;text-wrap: wrap;  text-align: justify;"> {{ $post->description }}</div>
                </td>
                <td class="w-25">
                     @if ($post->image == null)
                        <img src="{{ asset('storage/404.png')}}" alt="" class="img-thumbnail shadow-lg w-100">
                    @else
                        <img src="{{ asset('storage/'.$post->image)}}" alt="" class="img-thumbnail shadow-lg w-100">
                    @endif
                </td>
                <td>
                    <i class="fa-solid fa-eye fs-4 p-3"></i> <span class="fs-4">{{ $post->viewcount }}</span>
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

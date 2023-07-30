@extends('admin.master.app')
@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
            <legend class="text-center">Change Password</legend>
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            </div>
            <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="activity">
                <form class="form-horizontal" method="Post" action="{{route('profile#changepassword')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Old Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="oldpassword" class="form-control @error('oldpassword') is-invalid @enderror" id="inputName" placeholder="Old Password" value="">
                        @error('oldpassword')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="newpassword" class="form-control @error('newpassword') is-invalid @enderror" id="inputEmail" placeholder="New Password" value="">
                            @error('newpassword')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Comfirm Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="comfirmpassword" class="form-control @error('comfirmpassword') is-invalid @enderror" id="inputEmail" placeholder="Comfirm Password" value="">
                            @error('comfirmpassword')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>

                    <div class="form-group row float-right mr-3">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn bg-dark text-white">Change</button>
                    </div>
                    </div>
                </form>

                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

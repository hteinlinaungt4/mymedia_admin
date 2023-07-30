@extends('admin.master.app')
@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
            <legend class="text-center">User Profile</legend>
            @if(session('UpdateSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('UpdateSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            </div>
            <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="activity">
                <form class="form-horizontal" method="Post" action="{{ route('profile#update')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                    <div class="form-group row">
                     <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Name" value="{{$userdata->name}}">
                       @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                       @enderror
                    </div>
                    </div>
                    <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="Email" value="{{ $userdata->email}}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                       @enderror
                    </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                        <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" id="inputEmail" placeholder="Phone" value="{{ $userdata->phone}}">
                        @error('phone')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                       @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" id=""  rows="5" placeholder="Address">{{ $userdata->address }}</textarea>
                            @error('address')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                           @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10">
                            <select name="gender" id="" class="form-control @error('gender') is-invalid @enderror">
                                <option @if($userdata->gender == "null") selected @endif value="">Choose Gender</option>
                                <option value="male" @if($userdata->gender == "male") selected @endif>Male</option>
                                <option value="female" @if($userdata->gender == "female") selected @endif>Female</option>
                            </select>
                            @error('gender')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                           @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <a href="{{ route('profile#changepasswordpage')}}">Change Password</a>
                    </div>
                    </div>
                    <div class="form-group row float-right mr-3">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn bg-dark text-white">Submit</button>
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

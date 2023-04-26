@extends('home')

{{-- @section('title', 'View Users') --}}

@section('content')

    <div class="container emp-profile">
        <div class=" p-5"  >

            <div class="row text-white" >
    
                <div class="card-body">
                    <div class="row mt-5 ">
                        <h2 class="text-center">Your Information</h2>
                        @if(session('msg-error'))
                            <div class="alert alert-danger mb-3">
                                {{ session('msg-error') }}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success mb-3">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="form-group   rounded-3 p-3 mt-3 row" style="background-color: #181F3B">
                        <form action="" method="POST" class="row" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="_method" value="PUT">
    
    
                                <div class="col-md-3 col-sm-12 d-flex justify-content-center">
                                    <img src="{" class="" alt="user image" height="350px" width="250px">
                                </div>
    
                                <div class="col-md-9 col-sm-12">
                                    <div class="mb-3">
                                        <label for="actor_image" class="form-label">your Image</label>
                                        <input class="form-control" type="file" id="image" name="image">
                                        @if($errors->has('image'))
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group     rounded-3 p-3 mt-3 row">
                                        <div class="col-sm-6">
                                            <label for="full_name">your full Name</label>
                                            <input type="text" class="form-control " value="" id="name" name="name">
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="full_name">your Email</label>
                                            <input type="email" class="form-control " value="" id="email" name="email" >
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group     rounded-3 p-3 mt-3 row">
                                        <div class="col-sm-6">
                                            <label for="full_name">old password</label>
                                            <input type="password" class="form-control"  id="old_password" name="old_password">
                                            <span class="text-danger">{{ $errors->first('old_password') }}</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="full_name">new password</label>
                                            <input type="password" class="form-control"  id="password" name="password">
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        </div>
                                    </div>
    
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <button type="submit"  class="btn btn-primary ms-4">Update my information</button>
                                </div>
    
    
                        </form>
    
                        <form action="" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-danger ">delete my account</button>
    
                            </div>
    
                        </form>
    
                    </div>
    
                    </div>
    
                </div>
            </div>
        </div>
    </div>
@endsection

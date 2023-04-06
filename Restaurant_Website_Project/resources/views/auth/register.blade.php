@extends('layouts.app')

@section('content')

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    {{-- <h2 class="heading-section">Sign Up</h2> --}}
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url({{ asset('assets/images/bg-1.jpg') }});">
                  </div>
                        <div class="login-wrap p-4 p-md-5">
                      <div class="d-flex">
                          <div class="w-100">
                              <h3 class="mb-4">Sign Up</h3>
                          </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                                    </p>
                                </div>
                      </div>
                            <form action="{{ route('register') }}" method="POST" class="signin-form">
                                    @csrf
                                @csrf
                          <div class="form-group mb-3">
                              <label class="label" for="name">Name</label>
                              <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                          </div>
                          <div class="form-group mb-3">
                              <label class="label" for="email">Email</label>
                              <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                          </div>
                    <div class="form-group mb-3">
                        <label class="label" for="password">Password</label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="label" for="password-confirm">Confirm Password</label>
                      <input type="password" class="form-control" name="password_confirmation" id="password-confirm" placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign Up</button>
                    </div>
                  </form>
                  <p class="text-center">Already a member? <a href="{{ route('login') }}" data-toggle="tab">Log In</a></p>
                </div>
              </div>
                </div>
            </div>
        </div>
    </section>    
       

@endsection
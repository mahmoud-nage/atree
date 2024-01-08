@php
$lang = LaravelLocalization::getCurrentLocale();
if ($lang == 'ar') {
  $dir = 'rtl';
} else {
  $dir = 'ltr';
}
@endphp
@extends('site.layouts.master')

@section('page_content')
<!-- Main content -->
<div class="content-wrapper pt-3">
  <section class="ftco-section signup-container">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="wrap d-md-flex">
            <!-- Right Side -->
            <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
              <div class="text w-100">
                <h2> @lang('site.Welcome Back') </h2>
                <div><img src="{{ asset('site_assets/'.$dir.'/images/login-logo.png') }}"/></div>
              </div>
            </div>

            <!-- Left Side -->
            <div class="login-wrap">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="Signup-tab" > <a class='text-white' href="{{ url('/register') }}">  @lang('site.Signup') </a> </button>
                </li>
                <li class="nav-item " role="presentation">
                  <button class="nav-link  " > <a  href="{{ url('/login') }}">  @lang('site.Login') </a> </button>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="Login" role="tabpanel" aria-labelledby="Login-tab">

                @if (Session::has('error'))
                <div class="alert alert-primary" role="alert">
                  {{ Session::get('error') }}
                </div>

                @endif
                <form action="{{ route('register.post') }}" method="POST" class="signup-form" enctype="multipart/form-data" >
                  @csrf
                  <div class="signup-photo">
                    <img src="{{ asset('site_assets/'.$dir.'/img/user-default.png') }}">
                    <label class="edit-signup-photo" href="#">
                      <input type="file" name='image' />
                      @lang('site.Choose Profile Picture')
                      <i class="fa fa-camera"></i>
                    </label>
                  </div>
                  <div class="row">                        
                    <div class="col-md-6">
                      <div class="form-group mb-2">
                        <label class="label" for="name">@lang('site.First Name') </label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror " placeholder="" required>
                        @error('first_name')
                        <p class='text-danger' > {{ $message }} </p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-2">
                        <label class="label" for="name">@lang('site.Last Name') </label>
                        <input type="text" name='last_name' value='{{ old('last_name') }}' class="form-control @error('last_name') is-invalid @enderror" placeholder="" required>
                        @error('last_name')
                        <p class='text-danger' > {{ $message }} </p>
                        @enderror
                      </div>
                    </div>                        
                    <div class="col-md-6">
                      <div class="form-group mb-2">
                        <label class="label" for="name">@lang('site.Email') </label>
                      <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="" required>
                        @error('email')
                        <p class='text-danger' > {{ $message }} </p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-2">
                        <label class="label" for="name">@lang('site.Phone') </label>
                        <input type="text" name='phone' value='{{ old('phone') }}' class="form-control @error('phone') is-invalid @enderror" placeholder="" required>
                        @error('phone')
                        <p class='text-danger' > {{ $message }} </p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-2">
                        <label class="label" for="name">@lang('site.Password') </label>
                        <div class="password-container">
                          <input type="password"  name='password' class="form-control @error('password') is-invalid @enderror" placeholder="" required>
                          <i class="fa fa-eye show-pass"></i>
                        </div>
                         @error('password')
                        <p class='text-danger' > {{ $message }} </p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="label" for="password"> @lang('site.Confirm Password') </label>
                        <div class="password-container">
                          <input type="password" name='password_confirmation'  class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="" required>
                          <i class="fa fa-eye show-pass"></i>
                        </div>
                         @error('password_confirmation')
                        <p class='text-danger' > {{ $message }} </p>
                        @enderror
                      </div>
                    </div>

                  </div>
                  <div class="form-group mt-5 text-right">
                    <button type="submit" class="btn btn-primary submit px-3"> @lang('site.Sign Up') </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>  
@include('site.layouts.footer')
</div>

@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('site_assets/'.$dir.'/css/login.css') }}">
@endsection
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
              <div class="text-wrap p-4 p-lg-5 text-center d-md-flex align-items-center order-md-last d-none d-md-block">
              <div class="text w-100">
                <h2> @lang('site.Welcome Back') </h2>
                <div><img src="{{ asset('site_assets/'.$dir.'/images/login-logo.png') }}"/></div>
              </div>
            </div>

            <!-- Left Side -->
            <div class="login-wrap">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link " id="Signup-tab" > <a  href="{{ url('/register') }}">  @lang('site.Signup') </a> </button>
                </li>
                <li class="nav-item " role="presentation">
                  <button class="nav-link  active" > <a class='text-white'  href="{{ url('/login') }}">  @lang('site.Login') </a> </button>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="Login" role="tabpanel" aria-labelledby="Login-tab">
                <form action="{{ route('login.post') }}" method="POST" class="login-form">
                  @csrf
                  <div class="form-group mb-4">
                    <label class="label" for="name"> @lang('site.Phone') </label>
                    <input type="text" name='phone' value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror " autocapitalize="off" placeholder="@lang('site.Phone')" >
                    @error('phone')
                    <p class='text-danger' > {{ $message }} </p>
                    @enderror
                  </div>
                  <div class="form-group mb-4">
                    <div class="d-flex justify-content-between align-items-end">
                      <label class="label" for="password"> @lang('site.Password') </label>
                      <a class="forget-password" href="{{route('password.request')}}"> @lang('site.Forgot Password ?') </a>
                    </div>
                    <div class="password-container">
                      <input type="Password" name='password' class="form-control @error('password') is-invalid @enderror " placeholder="" >
                      <i class="fa fa-eye show-pass"></i>
                    </div>
                    @error('password')
                    <p class='text-danger' > {{ $message }} </p>
                    @enderror
                  </div>

                  <div class="w-50 text-left">
                    <label class="checkbox-wrap checkbox-primary mb-0"> @lang('site.Remember Me')
                      <input type="checkbox" checked>
                      <span class="checkmark"></span>
                    </label>
                  </div>
                  <div class="form-group mt-5 text-right">
                    <button type="submit" class="btn btn-primary submit px-3"> @lang('site.Login') </button>
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
@section('scripts')
<script>
    $(document).ready(function(){
        $(".show-pass").click(function(){
            $(this).toggleClass("fa-eye-slash fa-eye");
            if($(this).prev("input").attr("type") == "text"){
                $(this).prev("input").prop("type", "password");
            }
            else{
                $(this).prev("input").prop("type", "text");
            }
        })
    })
</script>
@endsection

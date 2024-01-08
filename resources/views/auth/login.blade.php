@extends('site.layouts.master')

@section('content')
    <div class="ps-page--my-account">
      <div class="ps-breadcrumb">
        <div class="container">
          <ul class="breadcrumb">
            <li><a href="{{ url('/') }}"> @lang('site.home') </a></li>
            <li> @lang('site.Login') </li>
          </ul>
        </div>
      </div>
      <div class="ps-my-account">
        <div class="container">
          <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
          <form class="ps-form--account ps-tab-root" action="{{ route('login') }}" method="POST">
            @csrf
            <ul class="ps-tab-list">
              <li class="active"><a href="#sign-in"> @lang('site.login') </a></li>
            </ul>
            <div class="ps-tabs">
              <div class="ps-tab active" id="sign-in">
                <div class="ps-form__content">
                  <h5>@lang('site.Log In Your Account')</h5>
                  <div class="form-group">
                    <input class="form-control" type="text" name="email" value='{{ old('email') }}' placeholder="@lang('site.email')">
                  </div>
                  <div class="form-group form-forgot">
                    <input class="form-control" type="text" name="password" placeholder=" @lang('site.password') "><a href=""> @lang('site.Forgot') </a>
                  </div>
                  <div class="form-group">
                    <div class="ps-checkbox">
                      <input class="form-control" type="checkbox" id="remember-me" name="remember"/>
                      <label for="remember-me"> @lang('site.Rememeber me') </label>
                    </div>
                  </div>
                  <div class="form-group submtit">
                    <button class="ps-btn ps-btn--fullwidth"> @lang('site.Login') </button>
                  </div>
                </div>
                <div class="ps-form__footer">
                  <p> @lang('site.Connect with') :</p>
                  <ul class="ps-list--social">
                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a class="google" href="{{ route('google.login') }}"><i class="fa fa-google-plus"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection


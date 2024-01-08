@extends('site.layouts.master')


@section('content')

<div class="ps-page--my-account">
  <div class="ps-breadcrumb">
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="index.html"> @lang('site.home') </a></li>
        <li> @lang('site.register') </li>
      </ul>
    </div>
  </div>
  <div class="ps-my-account">
    <div class="container">
      <x-auth-validation-errors class="mb-4" :errors="$errors" />
      <form class="ps-form--account ps-tab-root" action="{{ route('register') }}" method="POST">
        @csrf
        <ul class="ps-tab-list">
          <li class="active"><a href="#register"> @lang('site.register') </a></li>
        </ul>
        <div class="ps-tabs">

          <div class="ps-tab active" id="register">
            <div class="ps-form__content">
              <h5> @lang('site.Register An Account') </h5>
              <div class="form-group">
                <input class="form-control @error('name') @enderror " name='name' value='{{ old('name') }}' type="text" placeholder="@lang('site.name')">
                @error('name')
                <p class='text-danger'> {{ $message }} </p>
                @enderror
              </div>
              <div class="form-group">
                <input class="form-control @error('email') @enderror " name='email' value='{{ old('email') }}' type="text" placeholder="@lang('site.email')">
                @error('email')
                <p class='text-danger'> {{ $message }} </p>
                @enderror
              </div>
              <div class="form-group">
                <input class="form-control @error('phone') @enderror " name='phone' value='{{ old('phone') }}' type="text" placeholder="@lang('site.phone')">
                @error('phone')
                <p class='text-danger'> {{ $message }} </p>
                @enderror
              </div>
              <div class="form-group">
                <input class="form-control @error('password') @enderror " name='password' type="text" placeholder="@lang('site.password')">
                @error('password')
                <p class='text-danger'> {{ $message }} </p>
                @enderror
              </div>
              <div class="form-group">
                <input class="form-control @error('') @enderror " name='password_confirmation' type="text" placeholder="@lang('site.password_confirmation')">
              </div>
              <div class="form-group submtit">
                <button class="ps-btn ps-btn--fullwidth"> @lang('site.register') </button>
              </div>
            </div>
            <div class="ps-form__footer">
              <p> @lang('site.register_with') :</p>
              <ul class="ps-list--social">
                <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a class="google" href="{{ route('google') }}"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
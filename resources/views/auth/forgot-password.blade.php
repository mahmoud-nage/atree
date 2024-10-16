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
                                <div class="d-flex">
                                    <div class="w-100">
                                        <h3 class="mb-5">@lang('site.Forget password') @endlang</h3>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="Login" role="tabpanel" aria-labelledby="Login-tab">
                                        @if (Session::has('error'))
                                            <div class="alert alert-primary" role="alert">
                                                {{ Session::get('error') }}
                                            </div>

                                        @endif
                                        <form action="{{ route('password.send') }}" method="POST" class="login-form">
                                            @csrf
                                            <div class="form-group mb-4">
                                                <label class="label" for="name"> @lang('site.Phone') </label>
                                                <input type="text" name='phone' value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror " autocapitalize="off" placeholder="@lang('site.Phone')" >
                                                @error('phone')
                                                <p class='text-danger' > {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="form-group mt-5 text-right">
                                                <button type="submit" class="btn btn-primary submit px-3"> @lang('site.send') </button>
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

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

        <!-- Main content -->
        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-10">
                        <div class="wrap d-md-flex">
                            <!-- Right Side -->
                            <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                                <div class="text w-100">
                                    <h2> @lang('site.Welcome Back') </h2>
                                    <div><img src="{{ asset('site_assets/'.$dir.'/images/login-logo.png') }}"/></div>
                                </div>
                            </div>

                            <!-- Left Side -->
                            <div class="login-wrap OTP">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div>
                                        <h3 class="mb-3">{{__('site.Verification Code')}}</h3>
                                        <p class="text-muted mb-3 "> {{__('site.Verification code sent to:', ['phone' => $user->phone])}}</p>
                                        <form action="{{ route('password.check') }}" method="POST" class="login-form">
                                            @csrf
                                            <input type="hidden" name='phone' value="{{ $user->phone }}">
                                            <!--------------------- otp --------------------->
                                            <div class="otp-input-fields">
                                                <input name="code" class="form-control"
                                                       placeholder="{{__('site.Verification Code')}}" type="text">
                                            </div>

                                            <button type="submit"
                                                    class="btn btn-primary mb-3 p-3">{{__('site.Verify')}}</button>
                                        </form>
{{--                                        <div><span class="text-body pr-3">00:29 </span> <a class="text-body"> Resend--}}
{{--                                                Confirmation Code</a></div>--}}
                                        <script>
                                            var otp_inputs = document.querySelectorAll(".otp__digit")
                                            var mykey = "0123456789".split("")
                                            otp_inputs.forEach((_) => {
                                                _.addEventListener("keyup", handle_next_input)
                                            })

                                            function handle_next_input(event) {
                                                let current = event.target
                                                let index = parseInt(current.classList[1].split("__")[2])
                                                current.value = event.key

                                                if (event.keyCode == 8 && index > 1) {
                                                    current.previousElementSibling.focus()
                                                }
                                                if (index < 6 && mykey.indexOf("" + event.key + "") != -1) {
                                                    var next = current.nextElementSibling;
                                                    if (current.nextElementSibling != null) {
                                                        next.focus()
                                                    }
                                                }
                                                var _finalKey = ""
                                                for (let {value} of otp_inputs) {
                                                    _finalKey += value
                                                }
                                                if (_finalKey.length == 6) {
                                                    document.querySelector("#_otp").classList.replace("_notok", "_ok")
                                                    document.querySelector("#_otp").innerText = _finalKey
                                                } else {
                                                    if (document.querySelector("#_otp") != null) {
                                                        document.querySelector("#_otp").classList.replace("_ok", "_notok")
                                                        document.querySelector("#_otp").innerText = _finalKey
                                                    }
                                                }
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
        @include('site.layouts.footer')
        <!-- /.ootter -->
    </div>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('site_assets/'.$dir.'/css/login.css') }}">
@endsection

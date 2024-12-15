@php
    $lang = LaravelLocalization::getCurrentLocale();
    if ($lang == 'ar') {
        $dir = 'rtl';
    } else {
        $dir = 'ltr';
    }
@endphp
    <!DOCTYPE html>
<html lang="{{ $lang }}" dir="{{ $dir }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> ARTEE </title>
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('site_assets/'.$dir.'/images/favicon.png') }}">
    @livewireStyles
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('site_assets/'.$dir.'/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('site_assets/'.$dir.'/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('site_assets/'.$dir.'/css/styles.css') }}">
    <link rel="stylesheet"
          href="{{ asset('site_assets/'.$dir.'/plugins/CustomScrollbar/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.7.0/dist/multiple-select.min.css">


    @if ($dir == 'rtl' )
        <link rel="stylesheet" href="{{ asset('site_assets/'.$dir.'/css/rtl.css') }}">
    @endif
    @yield('styles')

</head>

<body class="hold-transition sidebar-mini @if(in_array(request()->route()->getName(), ['current-custom-designs','custom-designs','login.post', 'login.form', 'register.form','register.post','verify_phone.index','verify_phone.store',
'password.request','password.send','password.check','password.newPassword'])) sidebar-collapse @endif">
@if(!in_array(request()->route()->getName(), ['login.post', 'login.form', 'register.form','register.post','verify_phone.index','verify_phone.store',
'password.request','password.send','password.check','password.newPassword']))
    @include('site.layouts.header')
@else
    @include('site.layouts.authHeader')
@endif
<div class="wrapper">


    <!-- Main Sidebar Container -->
    @if(!in_array(request()->route()->getName(), ['login.post', 'login.form', 'register.form','register.post','verify_phone.index','verify_phone.store',
'password.request','password.send','password.check','password.newPassword']))
        @include('site.layouts.sidebar')
    @endif

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper pt-3"
         style="@if(request()->route()->getName() == 'products.show') margin-right: 0 !important;margin-left: 0 !important; @endif">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @include('site.layouts.messages')
                @yield('page_content')
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('site_assets/'.$dir.'/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('site_assets/'.$dir.'/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Scripts -->
<!-- custtom scroll -->
<script src="{{ asset('site_assets/'.$dir.'/plugins/CustomScrollbar/jquery-1.1.min.js') }}"></script>
<script
    src="{{ asset('site_assets/'.$dir.'/plugins/CustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('site_assets/'.$dir.'/js/PushMenu.js') }}"></script>
<script src="{{ asset('html2canvas.min.js') }}"></script>
{{--<script src="{{ asset('fabric.js') }}"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js" integrity="sha512-CeIsOAsgJnmevfCi2C7Zsyy6bQKi43utIjdA87Q0ZY84oDqnI0uwfM9+bKiIkI75lUeI00WG/+uJzOmuHlesMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
<!-- jQuery -->

<script src="https://unpkg.com/multiple-select@1.7.0/dist/multiple-select.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $("document").ready(function () {
        adjustSidebarTop();
        $('.select2').select2();

        $(".users-list .color-list li").mouseenter(function () {
            var hoverImage = $(this).data("image");
            $(this).closest('.product-container').find(".image-container .card-front img").attr('src', hoverImage);
        });
        $(".users-list .color-list li").mouseleave(function () {
            var mainImage = $(this).closest('.product-container').find(".image-container").data("image");
            $(this).closest('.product-container').find(".card-front img").attr('src', mainImage);
        });
        {{--var bool = '{!!session()->has('success')!!}' ? '{!!session()->has('success')!!}' : 0;--}}
        {{--var boolError = '{!!session()->has('error')!!}' ? '{!!session()->has('error')!!}' : 0;--}}
        {{--if (bool === '1') {--}}
        {{--    if ('{{app()->getLocale()}}' == 'ar') {--}}
        {{--        Swal.fire({--}}
        {{--            position: 'top-left',--}}
        {{--            icon: "success",--}}
        {{--            title: '{!! session('success') !!}',--}}
        {{--            showConfirmButton: false,--}}
        {{--            timer: 3000--}}
        {{--        });--}}
        {{--    } else {--}}
        {{--        Swal.fire({--}}
        {{--            position: "top-end",--}}
        {{--            icon: "success",--}}
        {{--            title: '{!! session('success') !!}',--}}
        {{--            showConfirmButton: false,--}}
        {{--            timer: 3000--}}
        {{--        });--}}
        {{--    }--}}
        {{--}--}}
        {{--if (boolError === '1') {--}}
        {{--    if ('{{app()->getLocale()}}' == 'ar') {--}}
        {{--        Swal.fire({--}}
        {{--            position: 'top-left',--}}
        {{--            icon: "error",--}}
        {{--            title: '{!! session('error') !!}',--}}
        {{--            showConfirmButton: false,--}}
        {{--            timer: 3000--}}
        {{--        });--}}
        {{--    } else {--}}
        {{--        Swal.fire({--}}
        {{--            position: 'top-end',--}}
        {{--            icon: "error",--}}
        {{--            title: '{!! session('error') !!}',--}}
        {{--            showConfirmButton: false,--}}
        {{--            timer: 3000--}}
        {{--        });--}}
        {{--    }--}}
        {{--}--}}
    });

    function changeCardColor(color, id) {
        const card = document.getElementById(id);
        card.style.backgroundColor = color;

    }
</script>

@livewireScripts
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-livewire-alert::scripts/>
@yield('scripts')
<script>
    function adjustSidebarTop() {
        // Get the height of the navbar
        const navbarHeight = document.querySelector('.main-header').offsetHeight;
        // Get the sidebar element
        const sidebar = document.querySelector('.main-sidebar');
        // Set the top and height dynamically with !important
        sidebar.style.setProperty('top', navbarHeight + 'px', 'important');
        sidebar.style.minHeight = `calc(100vh - ${navbarHeight}px)`;
        sidebar.style.maxHeight = `calc(100vh - ${navbarHeight}px)`;
        // sidebar.style.zIndex = 1000000000000000000;
    }
    // // Run the function on page load
    // window.onload = adjustSidebarTop;
    // // Run the function whenever the window is resized
    // window.onresize = adjustSidebarTop;
</script>
</body>
</html>

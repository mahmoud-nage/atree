@php
    $lang = LaravelLocalization::getCurrentLocale() ;
@endphp
    <!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container-fluid">
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="{{ Storage::url('settings/'.$data['settings']->logo) }}" alt="Artee" class="brand-image">
        </a>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ url('/') }}" class="nav-link @if(request()->route()->getName() == 'home') active @endif">@lang('site.Home')</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('explore') }}" class="nav-link @if(request()->route()->getName() == 'explore') active @endif">@lang('site.Explore')</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('products') }}" class="nav-link @if(request()->route()->getName() == 'products') active @endif">@lang('site.Products')</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('designs') }}" class="nav-link @if(request()->route()->getName() == 'designs') active @endif"> @lang('site.Designs')</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('contact') }}" class="nav-link @if(request()->route()->getName() == 'contact') active @endif">@lang('site.Contact Us')</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Right navbar links -->
        <ul class="list-group order-1 order-md-3 navbar-nav navbar-no-expand ml-auto right-nav">
            @if ($lang == 'ar')
                <li class="nav-item">
                    <a href="{{  LaravelLocalization::getLocalizedURL('en') }}" class="nav-link">
                        <i class="fas fa-language"></i>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{  LaravelLocalization::getLocalizedURL('ar') }}" class="nav-link">
                        <i class="fas fa-language"></i>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login.form') }}">
                    <i class="far fa-user"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>
<!-- /.navbar -->

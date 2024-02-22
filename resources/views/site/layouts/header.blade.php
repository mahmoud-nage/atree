@php
    $lang = LaravelLocalization::getCurrentLocale() ;
@endphp
    <!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container-fluid">
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="{{ Storage::url('settings/'.$data['settings']->logo) }}" alt="Artee" class="brand-image">
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-0 ml-md-3" method="get" action="{{ route('search') }}">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" name='search' type="search"
                           placeholder="@lang('site.Search')" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Right navbar links -->
        <ul class="list-group order-1 order-md-3 navbar-nav navbar-no-expand ml-auto right-nav">

            <!-- Notifications Dropdown Menu -->
            @if (Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-danger navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        <a href="#" class="list-group-item list-group-item-action active">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="text-sm mb-1 text-bold">List group item heading</h5>
                                <small>3 days ago</small>
                            </div>
                            <small>And some small print.</small>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="text-sm mb-1 text-bold">List group item heading</h5>
                                <small class="text-muted">3 days ago</small>
                            </div>
                            <small class="text-muted">And some muted small print.</small>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="text-sm mb-1 text-bold">List group item heading</h5>
                                <small class="text-muted">3 days ago</small>
                            </div>
                            <small class="text-muted">And some muted small print.</small>
                        </a>

                    </div>
                </li>
            @endif

            <!-- Messages Dropdown Menu -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cart.index') }}">
                    <i class="fas fa-shopping-cart">
                        <span
                            class="badge badge-danger navbar-badge">{{auth()->check()?\App\Models\Cart::whereUserId(auth()->id())->count():0}}</span>
                    </i>
                </a>
            </li>

            @if (Auth::check())
                <li class="nav-item dropdown header-profile">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       class="nav-link dropdown-toggle fa">
                        <div class="image">
                            <img src="{{ Storage::url('users/'.Auth::user()->image) }}"
                                 class="img-circle elevation-1 img-size-40" alt="User Image">
                        </div>
                    </a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow p-0">
                        <li>
                            <a href="{{ route('profile.index') }}" class="user-panel d-flex p-2 bg-gray-light">
                                <div class="image p-0">
                                    <img class="img-circle elevation-1" alt="User Image"
                                         src="{{ Storage::url('users/'.Auth::user()->image) }}">
                                </div>
                                <div class="info">
                                    <h5 href="#" class="d-block text-sm">{{ Auth::user()->name() }}</h5>
                                </div>
                            </a>
                        </li>
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a href="{{ route('wishlist') }}" class="nav-link">
                                    <i class="far fa-heart"></i> @lang('site.Wishlist')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('orders') }}" class="nav-link">
                                    <i class="far fa-paper-plane"></i> @lang('site.My Orders')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('profile.index') }}" class="nav-link">
                                    <i class="fas fa-map-marker-alt"></i> @lang('site.My Addresses')
                                </a>
                            </li>
                            @if ($lang == 'ar')
                                <li class="nav-item">
                                    <a href="{{  LaravelLocalization::getLocalizedURL('en') }}" class="nav-link">
                                        <i class="fas fa-language"></i> Egnlish
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{  LaravelLocalization::getLocalizedURL('ar') }}" class="nav-link">
                                        <i class="fas fa-language"></i> @lang('site.Arabic')
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{ route('followers') }}" class="nav-link">
                                    <i class="far fa-user"></i> @lang('site.My Followers')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('my_designs') }}" class="nav-link">
                                    <i class="fas fa-palette"></i> @lang('site.my_designs')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('diamond') }}" class="nav-link">
                                    <i class="far fa-gem"></i> @lang('site.My Diamonds')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('profile.index') }}" class="nav-link">
                                    <i class="fas fa-cog"></i> @lang('site.Settings')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('logout') }}" class="nav-link">
                                    <i class="fas fa-sign-out-alt"></i> @lang('site.Log out')
                                </a>
                            </li>
                        </ul>

                    </ul>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login.form') }}">
                        <i class="far fa-user"></i>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>
<!-- /.navbar -->

    <aside class="main-sidebar sidebar-light-primary elevation-1 sidebar-no-expand">
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu"
          data-accordion="false">
          <!-- <li class="nav-header">EXAMPLES</li> -->
          <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link @if(request()->route()->getName() == 'home') active @endif">
              <i class="nav-icon fas fa-home"></i>
              <p> @lang('site.Home') </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('explore') }}" class="nav-link @if(request()->route()->getName() == 'explore') active @endif">
              <i class="nav-icon far fa-compass"></i>
              <p>
                @lang('site.Explore')
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('products') }}" class="nav-link @if(request()->route()->getName() == 'products') active @endif">
              <i class="nav-icon fas fa-tshirt"></i>
              <p>
                @lang('site.Products')
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('designs') }}" class="nav-link @if(request()->route()->getName() == 'designs') active @endif">
              <i class="nav-icon fas fa-palette"></i>
              <p>
                @lang('site.Designs')
              </p>
            </a>
          </li>
        </ul>
      </nav>
      @if (Auth::check())
      <div class="user-panel py-1 d-flex @if(request()->route()->getName() == 'profile.index') active @endif">
        <a href="{{ Auth::user()->url() }}" class="image">
          <img src="{{ \Storage::url('users/'.Auth::user()->image) }}" class="img-circle elevation-1" alt="{{ Auth::user()->name() }}">
        </a>
        <div class="info">
          <a href="{{ Auth::user()->url() }}" class="d-block">{{ Auth::user()->name() }}</a>
        </div>
      </div>
      @endif
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

<div class="navbar navbar-expand-lg navbar-dark navbar-static">
		<div class="d-flex flex-1 d-lg-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-paragraph-justify3"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-transmission"></i>
			</button>
		</div>

		<div class="navbar-brand text-center text-lg-left">
			<a href="{{ route('dashboard.index') }}" class="d-inline-block">
				<img src="{{ asset('dashboard_assets/global_assets/images/logo.png') }}" class="d-none d-sm-block" alt="">
				<img src="{{ asset('dashboard_assets/global_assets/images/logo.png') }}" class="d-sm-none" alt="">
			</a>
		</div>

		<div class="collapse navbar-collapse order-2 order-lg-1" id="navbar-mobile">
		

			<span class="badge badge-success my-3 my-lg-0 ml-lg-3">Online</span>

		
		</div>

		<ul class="navbar-nav flex-row order-1 order-lg-2 flex-1 flex-lg-0 justify-content-end align-items-center">
		

			<li class="nav-item nav-item-dropdown-lg dropdown dropdown-user h-100">
				<a href="#" class="navbar-nav-link navbar-nav-link-toggler dropdown-toggle d-inline-flex align-items-center h-100" data-toggle="dropdown">
					<img src="{{ Storage::url('admins/'.Auth::user()->image) }}" class="rounded-pill mr-lg-2" height="34" alt="">
					<span class="d-none d-lg-inline-block">{{ Auth::user()->name }}</span>
				</a>

				<div class="dropdown-menu dropdown-menu-right">
					<a href="{{ route('dashboard.profile') }}" class="dropdown-item"><i class="icon-user-plus"></i>  الملف الشخصى </a>
					<a href="{{ route('dashboard.password') }}" class="dropdown-item"><i class="icon-coins"></i> تعديل كلمه المرور </a>
					<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> الرسائل <span class="badge badge-primary badge-pill ml-auto">58</span></a>
					
					
					<a href="#" class="dropdown-item"><i class="icon-switch2"></i>  تسجيل الخروج </a>
				</div>
			</li>
		</ul>
	</div>
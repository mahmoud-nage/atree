<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

	<!-- Sidebar content -->
	<div class="sidebar-content">

		<!-- User menu -->
		<div class="sidebar-section sidebar-user my-1">
			<div class="sidebar-section-body">
				<div class="media">
					<a href="#" class="mr-3">
						<img src="{{ asset('dashboard_assets/global_assets/images/placeholders/placeholder.jpg') }}" class="rounded-circle" alt="">
					</a>

					<div class="media-body">
						<div class="font-weight-semibold"> {{ Auth::user()->name }} </div>
						<div class="font-size-sm line-height-sm opacity-50">
							مشرف النظام
						</div>
					</div>

					<div class="ml-3 align-self-center">
						<button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
							<i class="icon-transmission"></i>
						</button>

						<button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-main-toggle d-lg-none">
							<i class="icon-cross2"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
		<!-- /user menu -->


		<!-- Main navigation -->
		<div class="sidebar-section">
			<ul class="nav nav-sidebar" data-nav-type="accordion">

				@php
				$home = $admins = $governorates = $cities = $coupons = $pages = $products = $countries =  $slides = $orders = $settings = $users = $colors = $sizes  = $messages = '';


				switch (request()->segment(3)) {
					case null:
					$home = 'active';
					break;
					case 'admins':
					$admins = 'active';
					break;
					case 'users':
					$users = 'active';
					break;
					case 'categories':
					$categories = 'active';
					break;
					case 'colors':
					$colors = 'active';
					break;
					case 'sizes':
					$sizes = 'active';
					break;
					case 'pages':
					$pages = 'active';
					break;
					case 'products':
					$products = 'active';
					break;
					case 'slides':
					$slides = 'active';
					break;
					case 'settings':
					$settings = 'active';
					break;
					case 'countries':
					$countries = 'active';
					break;
					case 'governorates':
					$governorates = 'active';
					break;
					case 'messages':
					$messages = 'active';
					break;
					case 'cities':
					$cities = 'active';
					break;
					case 'coupons':
					$coupons = 'active';
					break;
					case 'orders':
					$orders = 'active';
					break;

					default:
					break;
				}
				@endphp

				<!-- Main -->
				<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs"> @lang('dashboard.dashboard') </div> <i class="icon-menu" title="Main"></i></li>

				<li class="nav-item">
					<a href="{{ route('dashboard.index') }}" class="nav-link {{ $home }}">
						<i class="icon-home4"></i>
						<span>
							@lang('dashboard.home')
						</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('dashboard.settings.edit') }}" class="nav-link {{ $settings }}">
						<i class="icon-gear"></i>
						<span> @lang('settings.settings') </span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('dashboard.messages.index') }}" class="nav-link {{ $messages }}">
						<i class="icon-envelop4 "></i>
						<span>@lang('messages.messages')</span>
						<span class="badge badge-primary align-self-center ml-auto"> {{ $data['unrd_mssages_count'] }} </span>
					</a>
				</li>



				<li class="nav-item nav-item-submenu ">
					<a href="#" class="nav-link {{ $admins }}"><i class="icon-users4 "></i> <span> @lang('admins.admins') </span></a>
					<ul class="nav nav-group-sub" >
						<li class="nav-item"><a href="{{ route('dashboard.admins.index') }}" class="nav-link">@lang('admins.show_all_admins')</a></li>
						<li class="nav-item"><a href="{{ route('dashboard.admins.create') }}" class="nav-link">@lang('admins.add_new_admin')</a></li>
					</ul>
				</li>


				
				<li class="nav-item">
					<a href="{{ route('dashboard.users.index') }}" class="nav-link {{ $users }}">
						<i class="icon-users2"></i>
						<span>
							المستخدمين
						</span>
					</a>
				</li>


				<li class="nav-item nav-item-submenu">
					<a href="#" class="nav-link {{ $sizes }}"><i class="icon-ampersand "></i> <span> المقاسات </span></a>
					<ul class="nav nav-group-sub" >
						<li class="nav-item"><a href="{{ route('dashboard.sizes.index') }}" class="nav-link">
							عرض كافه المقاسات
						</a></li>
						<li class="nav-item"><a href="{{ route('dashboard.sizes.create') }}" class="nav-link">
							إضافه مقاس جديد
						</a></li>
					</ul>
				</li>
				<li class="nav-item nav-item-submenu">
					<a href="#" class="nav-link {{ $colors }}"><i class="icon-ampersand "></i> <span>
						الالوان
					 </span></a>
					<ul class="nav nav-group-sub" >
						<li class="nav-item"><a href="{{ route('dashboard.colors.index') }}" class="nav-link">
						عرض كافه الالوان
					</a></li>
						<li class="nav-item"><a href="{{ route('dashboard.colors.create') }}" class="nav-link">
							إضافه لون جديد
						</a></li>
					</ul>
				</li>
				<li class="nav-item nav-item-submenu">
					<a href="#" class="nav-link {{ $products }}"><i class="icon-ampersand "></i> <span> @lang('products.products') </span></a>
					<ul class="nav nav-group-sub" >
						<li class="nav-item"><a href="{{ route('dashboard.products.index') }}" class="nav-link">@lang('products.show_all_products')</a></li>
						<li class="nav-item"><a href="{{ route('dashboard.products.create') }}" class="nav-link">@lang('products.add_new_product')</a></li>
					</ul>
				</li>

				<li class="nav-item nav-item-submenu">
					<a href="#" class="nav-link {{ $pages }}"><i class="icon-newspaper2 "></i> <span> @lang('pages.pages') </span></a>
					<ul class="nav nav-group-sub" >
						<li class="nav-item"><a href="{{ route('dashboard.pages.index') }}" class="nav-link">@lang('pages.show_all_pages')</a></li>
						<li class="nav-item"><a href="{{ route('dashboard.pages.create') }}" class="nav-link">@lang('pages.add_new_page')</a></li>
					</ul>
				</li>

				<li class="nav-item nav-item-submenu">
					<a href="#" class="nav-link {{ $slides }}"><i class="icon-images3"></i> <span> @lang('slides.slides') </span></a>
					<ul class="nav nav-group-sub" >
						<li class="nav-item"><a href="{{ route('dashboard.slides.index') }}" class="nav-link">@lang('slides.show_all_slides')</a></li>
						<li class="nav-item"><a href="{{ route('dashboard.slides.create') }}" class="nav-link">@lang('slides.add_new_slide')</a></li>
					</ul>
				</li>	

				<li class="nav-item nav-item-submenu">
					<a href="{{ route('dashboard.orders.index') }}" class="nav-link {{ $orders }}"><i class="icon-images3"></i> <span> الطلبات </span></a>
					<ul class="nav nav-group-sub" >
						<li class="nav-item"><a href="{{ route('dashboard.orders.index') }}" class="nav-link">عرض كافه الطلبات</a></li>
						
					</ul>
				</li>	


				<li class="nav-item nav-item-submenu">
					<a href="#" class="nav-link {{ $coupons }}"><i class="icon-images3"></i> <span> كوبونات الخصم </span></a>
					<ul class="nav nav-group-sub" >
						<li class="nav-item"><a href="{{ route('dashboard.coupons.index') }}" class="nav-link">عرض كافه الكوبونات</a></li>
						<li class="nav-item"><a href="{{ route('dashboard.coupons.create') }}" class="nav-link">إضاهف كوبون جديد</a></li>
					</ul>
				</li>	



				<li class="nav-item nav-item-submenu">
					<a href="#" class="nav-link {{ $countries }}"><i class="icon-images3"></i> <span> الدول </span></a>
					<ul class="nav nav-group-sub" >
						<li class="nav-item"><a href="{{ route('dashboard.countries.index') }}" class="nav-link"> عرض كافه الدول </a></li>
						<li class="nav-item"><a href="{{ route('dashboard.countries.create') }}" class="nav-link">  انشاء دوله جديده </a></li>
					</ul>
				</li>	

				<li class="nav-item nav-item-submenu">
					<a href="#" class="nav-link {{ $governorates }}"><i class="icon-images3"></i> <span> المحافظات </span></a>
					<ul class="nav nav-group-sub" >
						<li class="nav-item"><a href="{{ route('dashboard.governorates.index') }}" class="nav-link"> عرض كافه المحافظات </a></li>
						<li class="nav-item"><a href="{{ route('dashboard.governorates.create') }}" class="nav-link">  انشاء محافظه جديده </a></li>
					</ul>
				</li>	


				<li class="nav-item nav-item-submenu">
					<a href="#" class="nav-link {{ $cities }}"><i class="icon-images3"></i> <span> المدن </span></a>
					<ul class="nav nav-group-sub" >
						<li class="nav-item"><a href="{{ route('dashboard.cities.index') }}" class="nav-link"> عرض كافه المدن</a></li>
						<li class="nav-item"><a href="{{ route('dashboard.cities.create') }}" class="nav-link"> إنشاء مدينه جديده</a></li>
					</ul>
				</li>




			</ul>
		</div>
		<!-- /main navigation -->

	</div>
	<!-- /sidebar content -->

</div>
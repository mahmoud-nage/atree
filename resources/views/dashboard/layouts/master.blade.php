<!DOCTYPE html>
@php
$lang = LaravelLocalization::getCurrentLocale();
@endphp
<html lang="ar"  dir='rtl' > 
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title> @lang('dashboard.dashboard') | @yield('page_title') </title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('dashboard_assets/global_assets/css/icons/icomoon/styles.min.css'); }}" rel="stylesheet" type="text/css">

	<link href="{{ asset('dashboard_assets/assets/css/all.min.css') }}" rel="stylesheet" type="text/css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet"> 
	<style>
		a , p , h1 , h2 , h3 , h4 , h5 , div , span , table , thead , tbody , button ,  th , tr , td {
			    font-family: 'Cairo', sans-serif;
			    font-weight: bold !important;
		} 
	</style>
	
	@livewireStyles
	

	<!-- /global stylesheets -->
	<!-- Core JS files -->
	<script src="{{ asset('dashboard_assets/global_assets/js/main/jquery.min.js') }}"></script>
	<script src="{{ asset('dashboard_assets/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
	<!-- /core JS files -->

	<script src="{{ asset('dashboard_assets/global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
	<script src="{{ asset('dashboard_assets/global_assets/js/plugins/pickers/daterangepicker.js') }}"></script>
	<script src="{{ asset('dashboard_assets/assets/js/app.js') }}"></script>
	<script src="{{ asset('dashboard_assets/global_assets/js/demo_pages/dashboard.js') }}"></script>
	<script src="{{ asset('dashboard_assets/global_assets/js/demo_pages/content_cards_header.js') }}"></script>
	   {{-- <script src="{{ asset('site_assets/js/sweetalert2.js') }}"></script> --}}
	   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	@livewireScripts
	@yield('scripts')
	<!-- /theme JS files -->

</head>

<body>

	<!-- Main navbar -->
	@include('dashboard.layouts.header')
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		@include('dashboard.layouts.sidebar')
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Page header -->
				<div class="page-header page-header-light">
					<div class="page-header-content header-elements-lg-inline">
						<div class="page-title d-flex">
							<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">@lang('dashboard.dashboard') </span></h4>
							<a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
						</div>

				
					</div>

					<div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
						<div class="d-flex">
							<div class="breadcrumb">
								<a href="{{ route('dashboard.index') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> @lang('dashboard.home') </a>
								@yield('page_header')
							</div>

							<a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
						</div>

					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					@yield('page_content')
				</div>
				<!-- /content area -->


				<!-- Footer -->
				@include('dashboard.layouts.footer')
				<!-- /footer -->

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->
	 <x-livewire-alert::scripts />
	     @include('dashboard.layouts.messages')
</body>
</html>

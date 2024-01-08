<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title> لوحه التحكم  </title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('dashboard_assets/global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('dashboard_assets/assets/css/all.min.css') }}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet"> 
	<style>
		a , p , h1 , h2 , h3 , h4 , h5 , div , span , table , thead , tbody , button ,  th , tr , td {
			    font-family: 'Cairo', sans-serif;
			    font-weight: bold !important;
		} 
	</style>


	<!-- Core JS files -->
	<script src="{{ asset('dashboard_assets/global_assets/js/main/jquery.min.js') }}"></script>
	<script src="{{ asset('dashboard_assets/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{ asset('dashboard_assets/assets/js/app.js') }}"></script>
	<!-- /theme JS files -->

</head>

<body class="bg-secondary">



	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Content area -->
				<div class="content d-flex justify-content-center align-items-center">


					<!-- Login form -->
					<form class="login-form" action="{{ route('dashboard.login') }}" method="POST" >
				@include('dashboard.layouts.messages')
						
						@csrf
						<div class="card mb-0">
							<div class="card-body">
								<div class="text-center mb-3">
									<i class="icon-reading icon-2x text-secondary border-secondary border-3 rounded-pill p-3 mb-3 mt-1"></i>
									<h5 class="mb-0"> دخول لوحه التحكم </h5>
									<span class="d-block text-muted"> قم بالدخول للوحه تحكم الموقع </span>
								</div>

								<div class="form-group form-group-feedback form-group-feedback-left">
									<input type="email" name='email' class="form-control @error('email') is-invalid @enderror " placeholder="البريد الاكتورنى">
									<div class="form-control-feedback">
										<i class="icon-user text-muted"></i>
									</div>
									@error('email')
									<p class='text-danger' > {{ $message }} </p>
									@enderror
								</div>

								<div class="form-group form-group-feedback form-group-feedback-left">
									<input type="password" name='password' class="form-control @error('password') is-invalid @enderror " placeholder="كلمة المرور">
									<div class="form-control-feedback">
										<i class="icon-lock2 text-muted"></i>
									</div>
									@error('password')
									<p class='text-danger' > {{ $message }} </p>
									@enderror
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block"> تسجيل الدخول </button>
								</div>

								{{-- <div class="text-center">
									<a href="login_password_recover.html">Forgot password?</a>
								</div> --}}
							</div>
						</div>
					</form>
					<!-- /login form -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>

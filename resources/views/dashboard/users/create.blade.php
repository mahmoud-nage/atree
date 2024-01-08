@extends('dashboard.layouts.master')

@section('page_title')
إضافه مسوق جديد
@endsection

@section('page_header')
<a href="{{ route('dashboard.marketers.index') }}" class="breadcrumb-item"><i class="icon-users4  mr-2"></i>  المسوقين </a>
<span class="breadcrumb-item active"> إضافه مسوق جديد </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> إضافه مسوق جديد </h5>
				<div class="header-elements">
					<div class="d-flex justify-content-between">
						<div class="list-icons ml-3">
							<a class="list-icons-item" data-action="collapse"></a>
							<a class="list-icons-item" data-action="reload"></a>
							<a class="list-icons-item" data-action="remove"></a>
						</div>
					</div>
				</div>
			</div>
			<form action="{{ route('dashboard.marketers.store') }}" method='POST' enctype="multipart/form-data" > 
				@csrf
				<div class="card-body">


					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold"> بيانات المسوق </legend>
						<div class="form-group row">
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> الصوره الشخصيه </label>
									<input type="file" name="image" class="form-control @error('image') is-invalid @enderror " >
									@error('image')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> الاسم </label>
									<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" >
									@error('name')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> البريد الاكتورنى </label>
									<input type="email" name='email' value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" >
									@error('email')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> رقم الموبيل </label>
									<input type="text" name='phone' value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" >
									@error('phone')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label">كلمة المرور </label>
									<input type="password" name='password' class="form-control @error('password') is-invalid @enderror" >
									@error('password')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label">  تاكيد كلمه المرور </label>
									<input type="password" name='password_confirmation' class="form-control @error('password_confirmation') is-invalid @enderror" >
								</div>
							</div>
						</div>						
					</fieldset>
				</div>

				<div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
					<a href="{{ route('dashboard.admins.index') }}" class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> @lang('dashboard.add') </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
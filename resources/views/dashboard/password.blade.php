@extends('dashboard.layouts.master')

@php
$lang = LaravelLocalization::getCurrentLocale();
@endphp
@section('page_title')
تعديل كلمه المرور 
@endsection

@section('page_header')
<a href="{{ route('dashboard.profile') }}" class="breadcrumb-item"><i class="icon-newspaper2 mr-2"></i> الملف الشخصى </a>
<span class="breadcrumb-item active"> تعديل كلمه المرور </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		@include('dashboard.layouts.messages')
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title">  تعديل كلمه المرور  </h5>
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
			<form action="{{ route('dashboard.password.update' ) }}" method='POST'  > 		
				@method('PATCH')
				@csrf
				<div class="card-body">


					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold"> بيانات كلمه المرور </legend>
						<div class="form-group row">							
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> كلمه المرور الحاليه </label>
									<input type="password"  class="form-control @error('current_password') is-invalid @enderror" name="current_password"  >
									@error('current_password')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>			
							
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> كلمه المرور الجديده </label>
									<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" >
									@error('password')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> تاكيد كلمه المرور الجديده </label>
									<input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" >
									@error('password_confirmation')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							



						</div>						
					</fieldset>
				</div>

				<div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
					<a href="{{ route('dashboard.settings.edit') }}" class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> @lang('dashboard.edit') </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection



@extends('dashboard.layouts.master')

@php
$lang = LaravelLocalization::getCurrentLocale();
@endphp
@section('page_title')
تعديل بيانات الملف الشخصى 
@endsection

@section('page_header')
<a href="{{ route('dashboard.profile') }}" class="breadcrumb-item"><i class="icon-newspaper2 mr-2"></i> الملف الشخصى </a>
<span class="breadcrumb-item active"> تعديل بيانات الملف الشخصى </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		@include('dashboard.layouts.messages')
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title">  تعديل بيانات الملف الشخصى  </h5>
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
			<form action="{{ route('dashboard.profile.update' ) }}" method='POST' enctype="multipart/form-data" > 		@method('PATCH')
				@csrf
				<div class="card-body">


					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold"> بيانات الملف الشخصى </legend>
						<div class="form-group row">							
							<div class="col-md-6">
								<div  class='mb-2' >
									<label class="col-form-label"> اسم المسخدم </label>
									<input type="text"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" >
									@error('name')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>			
							
							<div class="col-md-6">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('settings.email') </label>
									<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" >
									@error('email')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							<div class="col-md-6">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('settings.phone') </label>
									<input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" >
									@error('phone')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							
							<div class="col-md-6">
								<div  class='mb-2' >
									<label class="col-form-label"> صوره الملف الشخصى </label>
									<input type="file" class="form-control @error('image') is-invalid @enderror" name="image" >
									@error('image')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>


							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label"> صوره الملف الشخصى الحاليه </label> <br>
									<img class='img-thumbnail img-responsive' src="{{ Storage::url('admins/'.$user->image) }}" alt="">
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



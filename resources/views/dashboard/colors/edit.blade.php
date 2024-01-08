@extends('dashboard.layouts.master')

@php
$lang = LaravelLocalization::getCurrentLocale();
@endphp
@section('page_title')
تعديل اللون
@endsection

@section('page_header')
<a href="{{ route('dashboard.colors.index') }}" class="breadcrumb-item"><i class="icon-equalizer  mr-2"></i> 
	الالوان
</a>
<span class="breadcrumb-item active"> تعديل اللون </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> تعديل اللون</h5>
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
			<form action="{{ route('dashboard.colors.update' , $color ) }}" method='POST' enctype="multipart/form-data" > 
				@csrf
				@method('PATCH')
				<div class="card-body">


					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">
							بيانات اللون
						</legend>
						<div class="form-group row">

							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> اللون </label>
									<input type="color" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ $color->code }}" >
									@error('code')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>					

							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('categories.name_ar') </label>
									<input type="text" class="form-control @error('name_ar') is-invalid @enderror" name="name_ar" value="{{ $color->getTranslation('name' , 'ar' ) }}" >
									@error('name_ar')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('categories.name_en') </label>
									<input type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ $color->getTranslation('name' , 'en' ) }}" >
									@error('name_en')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>



							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> فعال  </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" name="is_active" class="custom-control-input" id='is_active' {{ $color->is_active == 1 ? 'checked' : '' }} >
										<label class="custom-control-label" for="is_active"> @lang('slides.active') </label>
									</div>
								</div>
							</div>

						</div>						
					</fieldset>
				</div>

				<div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
					<a href="{{ route('dashboard.colors.index') }}" class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> تعديل </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
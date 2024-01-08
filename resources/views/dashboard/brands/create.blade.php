@extends('dashboard.layouts.master')

@php
	$lang = LaravelLocalization::getCurrentLocale();
@endphp
@section('page_title')
{{ trans('brands.add_new_brand') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.brands.index') }}" class="breadcrumb-item"><i class="icon-git-branch   mr-2"></i> @lang('brands.brands')</a>
<span class="breadcrumb-item active"> @lang('brands.add_new_brand') </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> @lang('brands.add_new_brand') </h5>
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
			<form action="{{ route('dashboard.brands.store') }}" method='POST' enctype="multipart/form-data" > 
				@csrf
				<div class="card-body">


					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">@lang('brands.brand_details')</legend>
						<div class="form-group row">
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('brands.logo') </label>
									<input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror " >
									@error('logo')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('brands.name_ar') </label>
									<input type="text" class="form-control @error('name.ar') is-invalid @enderror" name="name[ar]" value="{{ old('name.ar') }}" >
									@error('name.ar')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('brands.name_en') </label>
									<input type="text" class="form-control @error('name.en') is-invalid @enderror" name="name[en]" value="{{ old('name.en') }}" >
									@error('name.en')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
						</div>						
					</fieldset>
				</div>

				<div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
					<a href="{{ route('dashboard.brands.index') }}" class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> @lang('dashboard.add') </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
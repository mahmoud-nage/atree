@extends('dashboard.layouts.master')

@php
	$lang = LaravelLocalization::getCurrentLocale();
@endphp
@section('page_title')
{{ trans('slides.add_new_slide') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.slides.index') }}" class="breadcrumb-item"><i class="icon-images3 mr-2"></i> @lang('slides.slides')</a>
<span class="breadcrumb-item active"> @lang('slides.add_new_slide') </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> @lang('slides.add_new_slide') </h5>
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
			<form action="{{ route('dashboard.slides.store') }}" method='POST' enctype="multipart/form-data" > 
				@csrf
				<div class="card-body">


					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">@lang('slides.slide_details')</legend>
						<div class="form-group row">
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('slides.image') <span class='text-danger' > * </span> </label>
									<input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
									@error('image')
									<p class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							
							
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('slides.link') </label>
									<input type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link') }}" >
									@error('link')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> فعال  </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" name="is_active" class="custom-control-input" id='is_active' checked="" >
										<label class="custom-control-label" for="is_active"> @lang('slides.active') </label>
									</div>
								</div>
							</div>
						</div>						
					</fieldset>
				</div>

				<div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
					<a href="{{ route('dashboard.slides.index') }}" class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> @lang('dashboard.add') </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
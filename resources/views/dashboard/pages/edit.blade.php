@extends('dashboard.layouts.master')

@php
$lang = LaravelLocalization::getCurrentLocale();
@endphp
@section('page_title')
{{ trans('pages.edit_page_details') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.pages.index') }}" class="breadcrumb-item"><i class="icon-newspaper2 mr-2"></i> @lang('pages.pages')</a>
<span class="breadcrumb-item active"> @lang('pages.edit_page_details') </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		@include('dashboard.layouts.messages')
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> @lang('pages.edit_page_details') </h5>
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
			<form action="{{ route('dashboard.pages.update' , ['page' => $page->id]) }}" method='POST' enctype="multipart/form-data" > 		@method('PATCH')
				@csrf
				<div class="card-body">


					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">@lang('pages.page_details')</legend>
						<div class="form-group row">
							
							
							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('pages.title_ar') </label>
									<input type="text" class="form-control @error('title.ar') is-invalid @enderror" name="title[ar]" value="{{ $page->getTranslation('title' , 'ar') }}" >
									@error('title.ar')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('pages.content_ar') </label>
									<textarea name="content[ar]" id="input" class="form-control @error('content.ar') is-invalid @enderror" rows="3" required="required">{{ $page->getTranslation('content' , 'ar') }}</textarea>
									@error('content.ar')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>


							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('pages.title_en') </label>
									<input type="text" class="form-control @error('title.en') is-invalid @enderror" name="title[en]" value="{{ $page->getTranslation('title' , 'en') }}" >
									@error('title.en')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('pages.content_en') </label>
									<textarea name="content[en]" id="input" class="form-control @error('content.en') is-invalid @enderror" rows="3" required="required">{{ $page->getTranslation('content' , 'en') }}</textarea>
									@error('content.en')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('brands.activation') </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" name="active" class="custom-control-input" id='sc_ls_c' {{ $page->active == 1 ? 'checked' : '' }} >
										<label class="custom-control-label" for="sc_ls_c"> @lang('brands.active') </label>
									</div>
								</div>
							</div>

							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label"> slug </label>
									<input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ $page->slug }}" >
									@error('slug')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
						</div>						
					</fieldset>
				</div>

				<div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
					<a href="{{ route('dashboard.pages.index') }}" class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> @lang('dashboard.edit') </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('scripts')

<script src="https://cdn.tiny.cloud/1/ic4s7prz04qh4jzykmzgizzo1lize2ckglkcjr9ci9sgkbuc/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
	$(function() {
		tinymce.init({
			selector: 'textarea',
			plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
			toolbar_mode: 'floating',
		});
	});
</script>

@endsection
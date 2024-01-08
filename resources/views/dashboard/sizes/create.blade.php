@extends('dashboard.layouts.master')

@php
$lang = LaravelLocalization::getCurrentLocale();
@endphp
@section('page_title')
إضافه مقاس جديد
@endsection

@section('page_header')
<a href="{{ route('dashboard.sizes.index') }}" class="breadcrumb-item"><i class="icon-equalizer  mr-2"></i> 
المقاسات
</a>
<span class="breadcrumb-item active"> إضافه مقاس جديد </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> إضافه مقاس جديد</h5>
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
			<form action="{{ route('dashboard.sizes.store') }}" method='POST' enctype="multipart/form-data" > 
				@csrf
				<div class="card-body">


					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">
						بيانات المقاس
					</legend>
						<div class="form-group row">
							

							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('categories.name_ar') </label>
									<input type="text" class="form-control @error('name_ar') is-invalid @enderror" name="name_ar" value="{{ old('name_ar') }}" >
									@error('name_ar')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('categories.name_en') </label>
									<input type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ old('name_en') }}" >
									@error('name_en')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>



							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> فعال  </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" name="is_active" class="custom-control-input" id='is_active'  >
										<label class="custom-control-label" for="is_active"> @lang('slides.active') </label>
									</div>
								</div>
							</div>

						</div>						
					</fieldset>
				</div>

				<div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
					<a href="{{ route('dashboard.sizes.index') }}" class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> @lang('dashboard.add') </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('brands.edit_brand_details') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.brands.index') }}" class="breadcrumb-item"><i class="icon-git-branch  mr-2"></i> @lang('brands.brands')</a>
<span class="breadcrumb-item active"> @lang('brands.edit_brand_details') </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> @lang('brands.edit_brand_details') </h5>
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
			<form action="{{ route('dashboard.brands.update' , ['brand' => $brand->id ] ) }}" method='POST' enctype="multipart/form-data" > 
				@csrf
				@method('PATCH')
				<div class="card-body">


					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">@lang('brands.brand_details')</legend>
						<div class="form-group row">
							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('brands.image') </label>
									<input type="file" name="image" class="form-control @error('image') is-invalid @enderror " >
									@error('image')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('brands.name_ar') </label>
									<input type="text" class="form-control @error('name.ar') is-invalid @enderror" name="name[ar]" value="{{ $brand->getTranslation('name' , 'ar') }}" >
									@error('name.ar')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('brands.name_en') </label>
									<input type="text" name='name[en]' value="{{ $brand->getTranslation('name' , 'en') }}" class="form-control @error('name.en') is-invalid @enderror" >
									@error('name.en')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('brands.activation') </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" name="active" class="custom-control-input" id='sc_ls_c' {{ $brand->active == 1 ? 'checked' : '' }} >
										<label class="custom-control-label" for="sc_ls_c"> @lang('brands.active') </label>
									</div>
								</div>
							</div>


							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('brands.current_image') </label>
									<img class='img-thumbnail img-responsive' src="{{ Storage::url('brands/'.$brand->logo) }}" alt="">
								</div>
							</div>

						</div>						
					</fieldset>
				</div>

				<div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
					<a href="{{ route('dashboard.brands.index') }}" class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> @lang('dashboard.edit') </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
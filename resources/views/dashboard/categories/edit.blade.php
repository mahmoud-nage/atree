@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('categories.edit_category_details') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.categories.index') }}" class="breadcrumb-item"><i class="icon-equalizer   mr-2"></i> @lang('categories.categories')</a>
<span class="breadcrumb-item active"> @lang('categories.edit_category_details') </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> @lang('categories.edit_category_details') </h5>
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
			<form action="{{ route('dashboard.categories.update' , ['category' => $category->id ] ) }}" method='POST' enctype="multipart/form-data" > 
				@csrf
				@method('PATCH')
				<div class="card-body">


					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">@lang('categories.category_details')</legend>
						<div class="form-group row">
							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('categories.image') </label>
									<input type="file" name="image" class="form-control @error('image') is-invalid @enderror " >
									@error('image')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('categories.name_ar') </label>
									<select name="category_id" id="inputCate" class="form-control" >
										<option value=""></option>
										@foreach ($categories as $onecategory)
										<option value="{{ $onecategory->id }}" {{ $category->category_id == $onecategory->id ? 'selected="selected"' : '' }}> {{ $onecategory->name }} </option>
										@endforeach
									</select>
									@error('name.ar')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('categories.name_ar') </label>
									<input type="text" class="form-control @error('name.ar') is-invalid @enderror" name="name[ar]" value="{{ $category->getTranslation('name' , 'ar') }}" >
									@error('name.ar')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('categories.name_en') </label>
									<input type="text" name='name[en]' value="{{ $category->getTranslation('name' , 'en') }}" class="form-control @error('name.en') is-invalid @enderror" >
									@error('name.en')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

														<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> عرض داخل الصفحه الرئيسيه </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" name="show_in_home_page" class="custom-control-input" id='show_in_home_page'  {{ $category->show_in_home_page == 1 ? 'checked' : '' }} >
										<label class="custom-control-label" for="show_in_home_page"> @lang('slides.active') </label>
									</div>
								</div>
							</div>


							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> عرض اسفل الslider </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" name="show_after_slider" class="custom-control-input" id='show_after_slider'  {{ $category->show_after_slider == 1 ? 'checked' : '' }} >
										<label class="custom-control-label" for="show_after_slider"> @lang('slides.active') </label>
									</div>
								</div>
							</div>


							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> عرض  داخل الheader </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" name="show_in_header" class="custom-control-input" id='show_in_header'  {{ $category->show_in_header == 1 ? 'checked' : '' }} >
										<label class="custom-control-label" for="show_in_header"> @lang('slides.active') </label>
									</div>
								</div>
							</div>


							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> تفعيل القسم </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" name="active" class="custom-control-input" id='active'  {{ $category->active == 1 ? 'checked' : '' }} >
										<label class="custom-control-label" for="active"> @lang('slides.active') </label>
									</div>
								</div>
							</div>



							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('categories.current_image') </label>
									<img class='img-thumbnail img-responsive' src="{{ Storage::url('categories/'.$category->image) }}" alt="">
								</div>
							</div>

						</div>						
					</fieldset>
				</div>

				<div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
					<a href="{{ route('dashboard.categories.index') }}" class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> @lang('dashboard.edit') </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
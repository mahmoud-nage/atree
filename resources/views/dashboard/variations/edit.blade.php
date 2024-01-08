@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('products.edit_product_details') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.products.index') }}" class="breadcrumb-item"><i class="icon-ampersand  mr-2"></i> @lang('products.products')</a>
<span class="breadcrumb-item active"> @lang('products.edit_product_details') </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		@include('dashboard.layouts.messages')
		
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> @lang('products.edit_product_details') </h5>
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
			<form action="{{ route('dashboard.products.update' , ['product' => $product->id ]) }}" method='POST' enctype="multipart/form-data" > 
				@csrf
				@method('PATCH')
				<div class="card-body">
					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">@lang('products.product_details')</legend>
						<div class="form-group row">
							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('products.image') </label>
									<input type="file" name="image" class="form-control @error('image') is-invalid @enderror " >
									@error('image')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('products.images') </label>
									<input type="file" name="images[]" multiple='multiple' class="form-control @error('images') is-invalid @enderror " >
									@error('images')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('products.name_ar') </label>
									<input type="text" class="form-control @error('name.ar') is-invalid @enderror" name="name[ar]" value="{{ $product->getTranslation('name' , 'ar') }}" >
									@error('name.ar')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('products.name_en') </label>
									<input type="text" class="form-control @error('name.en') is-invalid @enderror" name="name[en]" value="{{ $product->getTranslation('name' , 'en') }}" >
									@error('name.en')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							
							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('products.category') </label>
									<select name="category_id" id="inputCate" class="form-control" required="required">
										<option value=""></option>
										@foreach ($categories as $category)
										<option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected="selected"' : '' }} >{{ $category->name }}</option>
										@endforeach
									</select>
									@error('category_id')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('products.brand') </label>
									<select name="brand_id" id="inputCate" class="form-control" >
										<option value=""></option>
										@foreach ($brands as $brand)
										<option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected="selected"' : '' }} >{{ $brand->name }}</option>
										@endforeach
									</select>
									@error('brand_id')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							



							

							<div class="col-md-2">
								<div  class='mb-2' >
									<label class="col-form-label"> البارد كود </label>
									<input type="text" name="barcode" value="{{ $product->barcode }}" class="form-control @error('barcode') is-invalid @enderror " >
									@error('barcode')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							<div class="col-md-2">
								<div  class='mb-2' >
									<label class="col-form-label"> عدد النقاط </label>
									<input type="text" name="points" value="{{ $product->points }}" class="form-control @error('points') is-invalid @enderror " >
									@error('points')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-2">
								<div  class='mb-2' >
									<label class="col-form-label"> الحد الادنى للبيع بالجمله </label>
									<input type="text" name="minimam_gomla_number" value="{{ $product->minimam_gomla_number }}" class="form-control @error('minimam_gomla_number') is-invalid @enderror " >
									@error('minimam_gomla_number')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>




							<div class="col-md-6">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('products.mini_description_ar') </label>
									<textarea name="mini_description[ar]"  class="form-control" rows="3" > {{  $product->getTranslation('mini_description' , 'ar') }} </textarea>
									@error('mini_description.ar')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('products.mini_description_en') </label>
									<textarea name="mini_description[en]"  class="form-control" rows="3" > {{  $product->getTranslation('mini_description' , 'en') }} </textarea>
									@error('mini_description.en')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							<div class="col-md-6">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('products.description_ar') </label>
									<textarea name="description[ar]"  class="form-control" rows="3" > {!! $product->getTranslation('description' , 'ar') !!} </textarea>
									@error('description.ar')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('products.description_en') </label>
									<textarea name="description[en]"  class="form-control" rows="3" > {!! $product->getTranslation('description' , 'en') !!} </textarea>
									@error('description.en')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> سعر المنتج </label>
									<input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" >
									@error('price')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> السعر بعد الخصم </label>
									<input type="text" class="form-control @error('price_after_discount') is-invalid @enderror" name="price_after_discount" value="{{ $product->price_after_discount }}" >
									@error('price_after_discount')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> نسبه الخصم </label>
									<input type="text" class="form-control @error('discount_percentage') is-invalid @enderror" name="discount_percentage" value="{{ $product->discount_percentage }}" >
									@error('discount_percentage')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> مبلغ المسوق </label>
									<input type="text" class="form-control @error('marketer_price') is-invalid @enderror" name="marketer_price" value="{{ $product->marketer_price }}" >
									@error('marketer_price')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('products.active') </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" name="active" class="custom-control-input" id="sc_ls_c" checked>
										<label class="custom-control-label" for="sc_ls_c"> @lang('products.yes') </label>
									</div>
									@error('active')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>


							<div class="col-md-6">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('products.current_image') </label>
									<img class="img-responsive img-thumbnail" src="{{ Storage::url('products/'.$product->image) }}" alt="">
								</div>
							</div>			
						</div>						
					</fieldset>
				</div>

				<div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
					<a href="{{ route('dashboard.products.index') }}" class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> @lang('dashboard.edit') </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('scripts')

@endsection
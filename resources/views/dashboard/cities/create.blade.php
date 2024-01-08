@extends('dashboard.layouts.master')

@section('page_title')
إضافه مدينه جديده
@endsection

@section('page_header')
<a href="{{ route('dashboard.cities.index') }}" class="breadcrumb-item"><i class="icon-home7 mr-2"></i> المدن </a>
<span class="breadcrumb-item active"> إضافه مدينه جديده </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> إضافه مدينه جديده </h5>
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
			<form action="{{ route('dashboard.cities.store') }}" method='POST' enctype="multipart/form-data" > 
				@csrf
				<div class="card-body">

					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold"> بيانات المدينه </legend>
						<div class="form-group row">

							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> المحافظه </label>
									<select name="governorate_id" id="" class="custom-select-sm form-control " >
										@foreach ($governorates as $governorate)
										<option value="{{ $governorate->id }}"> {{ $governorate->name }} </option>
									@endforeach
									</select>
								</div>
							</div>


							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> الاسم بالعربيه </label>
									<input type="text" class="form-control @error('name_ar') is-invalid @enderror" name="name_ar" value="{{ old('name_ar') }}" >
									@error('name_ar')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> الاسم بالانجليزيه </label>
									<input type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ old('name_en') }}" >
									@error('name_en')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>


							<div class="col-md-3">
								<div  class='mb-2' >
									<label class="col-form-label"> سعر الشحن </label>
									<input type="number" class="form-control @error('shipping_cost') is-invalid @enderror" name="shipping_cost" value="{{ old('shipping_cost') }}" >
									@error('shipping_cost')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
						

							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label"> تفعيل </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" class="custom-control-input" name="active" id="sc_ls_c5" checked>
										<label class="custom-control-label" for="sc_ls_c5"> نعم </label>
									</div>
								</div>
							</div>


							



						</div>						
					</fieldset>
				</div>

				<div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
					<a href="{{ route('dashboard.cities.index') }}" class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> @lang('dashboard.add') </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
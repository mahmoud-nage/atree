@extends('dashboard.layouts.master')

@php
	$lang = LaravelLocalization::getCurrentLocale();
@endphp
@section('page_title')
{{ trans('warehouses.add_new_warehouse') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.warehouses.index') }}" class="breadcrumb-item"><i class="icon-git-branch   mr-2"></i> @lang('warehouses.warehouses')</a>
<span class="breadcrumb-item active"> @lang('warehouses.add_new_warehouse') </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> @lang('warehouses.add_new_warehouse') </h5>
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
			<form action="{{ route('dashboard.warehouses.store') }}" method='POST' enctype="multipart/form-data" > 
				@csrf
				<div class="card-body">


					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold"> 
							@lang('warehouses.warehouse_details') 
						</legend>
						<div class="form-group row">
							
							<div class="col-md-6">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('warehouses.name') </label>
									<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" >
									@error('name')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							<div class="col-md-6">
								<div  class='mb-2' >
									<label class="col-form-label"> مسؤل المستودع </label>
									<select name="manger_id" class='form-control' id="">
										@foreach ($users as $user)
											<option value="{{ $user->id }}"> {{ $user->name }} </option>
										@endforeach
									</select>
									@error('manger_id')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>


							
							@foreach ($governorates as $governorate)
								<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label">{{ $governorate->name }} </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" value="{{ $governorate->id }}" name="governorates[]" class="custom-control-input" 
										id="sc_ls_c{{ $governorate->id }}" >
										<label class="custom-control-label" for="sc_ls_c{{ $governorate->id }}"> فعال </label>
									</div>
									@error('governorates')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							@endforeach


						</div>						
					</fieldset>
				</div>

				<div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
					<a href="{{ route('dashboard.warehouses.index') }}" class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> @lang('dashboard.add') </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('branches.add_new_branch') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.branches.index') }}" class="breadcrumb-item"><i class="icon-home7 mr-2"></i> @lang('branches.branches')</a>
<span class="breadcrumb-item active"> @lang('branches.add_new_branch') </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> @lang('branches.add_new_branch') </h5>
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
			<form action="{{ route('dashboard.branches.store') }}" method='POST' enctype="multipart/form-data" > 
				@csrf
				<div class="card-body">


					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">@lang('branches.branch_details')</legend>
						<div class="form-group row">

							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.name') </label>
									<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" >
									@error('name')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.address') </label>
									<input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" >
									@error('address')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-2">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.show_address') </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" class="custom-control-input" name='show_address' id="sc_ls_c" checked>
										<label class="custom-control-label" for="sc_ls_c"> @lang('branches.yes') </label>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.phone1') </label>
									<input type="text" class="form-control @error('phone1') is-invalid @enderror" name="phone1" value="{{ old('phone1') }}" >
									@error('phone1')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-2">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.show_phone1') </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" class="custom-control-input" name="show_phone1" id="sc_ls_c1" checked>
										<label class="custom-control-label" for="sc_ls_c1"> @lang('branches.yes') </label>
									</div>
								</div>
							</div>



							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.phone2') </label>
									<input type="text" class="form-control @error('phone2') is-invalid @enderror" name="phone2" value="{{ old('phone2') }}" >
									@error('phone2')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-2">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.show_phone2') </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" class="custom-control-input" name="show_phone2" id="sc_ls_c2" checked>
										<label class="custom-control-label" for="sc_ls_c2"> @lang('branches.yes') </label>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.mobile') </label>
									<input type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" >
									@error('mobile')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-2">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.show_mobile') </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" class="custom-control-input" name="show_mobile" id="sc_ls_c3" checked>
										<label class="custom-control-label" for="sc_ls_c3"> @lang('branches.yes') </label>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.fax') </label>
									<input type="text" class="form-control @error('fax') is-invalid @enderror" name="fax" value="{{ old('fax') }}" >
									@error('fax')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-2">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.show_fax') </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" class="custom-control-input" name="show_fax" id="sc_ls_c4" checked>
										<label class="custom-control-label" for="sc_ls_c4"> @lang('branches.yes') </label>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.commercial_registration') </label>
									<input type="text" class="form-control @error('commercial_registration') is-invalid @enderror" name="commercial_registration" value="{{ old('commercial_registration') }}" >
									@error('commercial_registration')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-2">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.show_commercial_registration') </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" class="custom-control-input" name="show_commercial_registration" id="sc_ls_c5" checked>
										<label class="custom-control-label" for="sc_ls_c5"> @lang('branches.yes') </label>
									</div>
								</div>
							</div>


							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.warehouses') </label>
									@foreach ($warehouses as $warehouse)
										<div class="form-check">
									<input type="checkbox" name="warehouses[]" value='{{ $warehouse->id }}' class="form-check-input" id="dc_ls_c{{ $warehouse->id }}" checked>
									<label class="form-check-label" for="dc_ls_c{{ $warehouse->id }}">{{ $warehouse->name }}</label>
									</div>
									@endforeach
								</div>
							</div>



						</div>						
					</fieldset>
				</div>

				<div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
					<a href="{{ route('dashboard.branches.index') }}" class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> @lang('dashboard.add') </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
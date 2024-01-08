@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('branches.edit_branch_details') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.branches.index') }}" class="breadcrumb-item"><i class="icon-home7 mr-2"></i> @lang('branches.branches')</a>
<span class="breadcrumb-item active"> @lang('branches.edit_branch_details') </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> @lang('branches.edit_branch_details') </h5>
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
			<form action="{{ route('dashboard.branches.update' , ['branch' => $branch->id ]) }}" method='POST' enctype="multipart/form-data" > 
				@csrf
				@method('PATCH')
				<div class="card-body">
					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">@lang('branches.branch_details')</legend>
						<div class="form-group row">

							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.name') </label>
									<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $branch->name }}" >
									@error('name')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.address') </label>
									<input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $branch->address }}" >
									@error('address')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-2">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.show_address') </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" class="custom-control-input" name='show_address' id="sc_ls_c" {{ $branch->show_address == 1 ? 'checked' : '' }}>
										<label class="custom-control-label" for="sc_ls_c"> @lang('branches.yes') </label>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.phone1') </label>
									<input type="text" class="form-control @error('phone1') is-invalid @enderror" name="phone1" value="{{ $branch->phone1 }}" >
									@error('phone1')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-2">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.show_phone1') </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" class="custom-control-input" name="show_phone1" id="sc_ls_c1" {{ $branch->show_phone1 == 1 ? 'checked' : '' }}>
										<label class="custom-control-label" for="sc_ls_c1"> @lang('branches.yes') </label>
									</div>
								</div>
							</div>



							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.phone2') </label>
									<input type="text" class="form-control @error('phone2') is-invalid @enderror" name="phone2" value="{{ $branch->phone2 }}" >
									@error('phone2')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-2">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.show_phone2') </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" class="custom-control-input" name="show_phone2" id="sc_ls_c2" {{ $branch->show_phone2 == 1 ? 'checked' : '' }}>
										<label class="custom-control-label" for="sc_ls_c2"> @lang('branches.yes') </label>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.mobile') </label>
									<input type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ $branch->mobile }}" >
									@error('mobile')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-2">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.show_mobile') </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" class="custom-control-input" name="show_mobile" id="sc_ls_c3" {{ $branch->show_mobile == 1 ? 'checked' : '' }}>
										<label class="custom-control-label" for="sc_ls_c3"> @lang('branches.yes') </label>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.fax') </label>
									<input type="text" class="form-control @error('fax') is-invalid @enderror" name="fax" value="{{ $branch->fax }}" >
									@error('fax')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-2">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.show_fax') </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" class="custom-control-input" name="show_fax" id="sc_ls_c4" {{ $branch->show_fax == 1 ? 'checked' : '' }}>
										<label class="custom-control-label" for="sc_ls_c4"> @lang('branches.yes') </label>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.commercial_registration') </label>
									<input type="text" class="form-control @error('commercial_registration') is-invalid @enderror" name="commercial_registration" value="{{ $branch->commercial_registration }}" >
									@error('commercial_registration')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-2">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.show_commercial_registration') </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" class="custom-control-input" name="show_commercial_registration" id="sc_ls_c5" {{ $branch->show_commercial_registration == 1 ? 'checked' : '' }}>
										<label class="custom-control-label" for="sc_ls_c5"> @lang('branches.yes') </label>
									</div>
								</div>
							</div>


							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('branches.warehouses') </label>
									@foreach ($warehouses as $warehouse)
									<div class="form-check">
										<input type="checkbox" name="warehouses[]" value='{{ $warehouse->id }}' class="form-check-input" id="dc_ls_c{{ $warehouse->id }}" {{ in_array($warehouse->id , $branch_warehouses) ? 'checked' : "" }}>
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
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> @lang('dashboard.edit') </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
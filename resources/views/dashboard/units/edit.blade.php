@extends('dashboard.layouts.master')

@php
$lang = LaravelLocalization::getCurrentLocale();
@endphp
@section('page_title')
{{ trans('units.edit_unit_details') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.units.index') }}" class="breadcrumb-item"><i class="icon-equalizer  mr-2"></i> @lang('units.units')</a>
<span class="breadcrumb-item active"> @lang('units.edit_unit_details') </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> @lang('units.edit_unit_details') </h5>
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
			<form action="{{ route('dashboard.units.update' , ['unit' => $unit->id ] ) }}" method='POST' enctype="multipart/form-data" > 
				@csrf
				@method('PATCH')
				<div class="card-body">
					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold"> @lang('units.unit_details') </legend>
						<div class="form-group row">
							
							<div class="col-md-6">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('units.name_ar') </label>
									<input type="text" class="form-control @error('name.ar') is-invalid @enderror" name="name[ar]" value="{{ $unit->getTranslation('name' , 'ar') }}" >
									@error('name.ar')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('units.name_en') </label>
									<input type="text" class="form-control @error('name.en') is-invalid @enderror" name="name[en]" value="{{ $unit->getTranslation('name' , 'en') }}" >
									@error('name.en')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
						</div>		

						<div class="form-group row">
							
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th> @lang('units.unit_name')  </th>
										<th> @lang('units.unit_conversion_factor')  </th>
									</tr>
								</thead>
								<tbody>
									@php
									$conversion = $unit->conversions()->first();

									// dd($conversion);
									@endphp
									<tr>
										<td>
											<div  class='mb-2' >
												<select name="unit_id" id="inputUnit_id" class="form-control" >
													<option value=""></option>
													@foreach ($units as $unit)
													<option value="{{ $unit->id }}" {{ $conversion->unit_id == $unit->id ? 'selected="selected"' : '' }} > {{ $unit->name }} </option>
													@endforeach
												</select>
												@error('name.ar')
												<p  class='text-danger' >  {{ $message }} </p>
												@enderror
											</div>
										</td>
										<td>
											<div  class='mb-2' >
												<input type="number" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ $conversion->factor }}" >
												@error('number')
												<p  class='text-danger' >  {{ $message }} </p>
												@enderror
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>					



					</fieldset>
				</div>

				<div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
					<a href="{{ route('dashboard.units.index') }}" class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> @lang('dashboard.edit') </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
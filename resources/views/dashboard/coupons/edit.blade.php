@extends('dashboard.layouts.master')

@section('page_title')
تعديل كوبون خصم 
@endsection

@section('page_header')
<a href="{{ route('dashboard.coupons.index') }}" class="breadcrumb-item"><i class="icon-home7 mr-2"></i> كوبونات الخصم</a>
<span class="breadcrumb-item active"> تعديل كوبون خصم  </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> تعديل كوبون خصم </h5>
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
			<form action="{{ route('dashboard.coupons.update' , $coupon) }}" method='POST' enctype="multipart/form-data" > 
				@csrf
				@method('PATCH')
				<div class="card-body">


					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold"> بيانات الكوبون </legend>
						<div class="form-group row">

							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> الكود * </label>
									<input type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ $coupon->code }}" >
									@error('code')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> قيمه الخصم * </label>
									<input type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ $coupon->discount }}" >
									@error('discount')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> تاريخ البدايه </label>
									<input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ $coupon->start_date->format('Y-m-d') }}" >
									@error('start_date')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> تاريخ الانتهاء  </label>
									<input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ $coupon->end_date->format('Y-m-d') }}" >
									@error('end_date')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> عدد مرات الاستخدام الكلى </label>
									<input type="number" class="form-control @error('allow_times') is-invalid @enderror" name="allow_times" value="{{ $coupon->allow_times }}" >
									@error('allow_times')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>



							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label"> السماح للمستخدم باستخدام الكود اكثر من مره  </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" class="custom-control-input" name='allowed_more_than_once_per_user' id="sc_ls_c" {{ $coupon->allowed_more_than_once_per_user ? 'checked' : '' }} >
										<label class="custom-control-label" for="sc_ls_c"> نعم </label>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label"> فعال </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" class="custom-control-input" name='active' id="sc_ls_c1" {{ $coupon->active ? 'checked' : '' }} >
										<label class="custom-control-label" for="sc_ls_c1"> نعم </label>
									</div>
								</div>
							</div>




						</div>						
					</fieldset>
				</div>

				<div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
					<a href="{{ route('dashboard.coupons.index') }}" class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> @lang('dashboard.edit') </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
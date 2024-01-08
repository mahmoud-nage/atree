@extends('dashboard.layouts.master')

@section('page_title')
إضافه تحدى جديد
@endsection

@section('page_header')
<a href="{{ route('dashboard.challenges.index') }}" class="breadcrumb-item"><i class="icon-home7 mr-2"></i> التحديات </a>
<span class="breadcrumb-item active"> إضافه تحدى جديد </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> إضافه تحدى </h5>
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
			<form action="{{ route('dashboard.challenges.store') }}" method='POST' enctype="multipart/form-data" > 
				@csrf
				<div class="card-body">


					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold"> بيانات التحدى </legend>
						<div class="form-group row">

							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> عنوان التحدى * </label>
									<input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" >
									@error('title')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> عدد الطلبات المراد تحقيقيها * </label>
									<input type="text" class="form-control @error('orders') is-invalid @enderror" name="orders" value="{{ old('orders') }}" >
									@error('orders')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> الربح بالجنيه لكل طلب * </label>
									<input type="text" class="form-control @error('money') is-invalid @enderror" name="money" value="{{ old('money') }}" >
									@error('money')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> اللون * </label>
									<input type="color" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ old('color') }}" >
									@error('color')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> تاريخ البدايه </label>
									<input type="date" class="form-control @error('starts_at') is-invalid @enderror" name="starts_at" value="{{ old('starts_at') }}" >
									@error('starts_at')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> تاريخ الانتهاء  </label>
									<input type="date" class="form-control @error('ends_at') is-invalid @enderror" name="ends_at" value="{{ old('ends_at') }}" >
									@error('ends_at')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>


							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label"> هل يمكن للمستخدم سحب الارباح فى حاله انتهاء تاري التحدى ؟ </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" class="custom-control-input" name='should_user_finishes_to_receive_money' id="sc_ls_c" checked>
										<label class="custom-control-label" for="sc_ls_c"> نعم </label>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label"> حاله التحدى </label>
									<div class="custom-control custom-switch mb-2">
										<input type="checkbox" class="custom-control-input" name='is_active' id="sc_ls_c1" checked>
										<label class="custom-control-label" for="sc_ls_c1"> فعال </label>
									</div>
								</div>
							</div>




						</div>						
					</fieldset>
				</div>

				<div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
					<a href="{{ route('dashboard.challenges.index') }}" class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> @lang('dashboard.add') </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
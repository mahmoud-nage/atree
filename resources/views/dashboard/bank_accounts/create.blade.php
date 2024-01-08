@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('bank_accounts.add_new_bank_account') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.bank_accounts.index') }}" class="breadcrumb-item"><i class="icon-cash3 mr-2"></i> @lang('bank_accounts.bank_accounts')</a>
<span class="breadcrumb-item active"> @lang('bank_accounts.add_new_bank_account') </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> @lang('bank_accounts.add_new_bank_account') </h5>
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
			<form action="{{ route('dashboard.bank_accounts.store') }}" method='POST' enctype="multipart/form-data" > 
				@csrf
				<div class="card-body">


					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">@lang('bank_accounts.bank_account_details')</legend>
						<div class="form-group row">

							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('bank_accounts.name') </label>
									<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" >
									@error('name')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('bank_accounts.account_number') </label>
									<input type="text" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{ old('account_number') }}" >
									@error('account_number')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('bank_accounts.iban') </label>
									<input type="text" class="form-control @error('iban') is-invalid @enderror" name="iban" value="{{ old('iban') }}" >
									@error('iban')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('bank_accounts.mada_fees') </label>
									<input type="text" class="form-control @error('mada_fees') is-invalid @enderror" name="mada_fees" value="{{ old('mada_fees') }}" >
									@error('mada_fees')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('bank_accounts.visa_fees') </label>
									<input type="text" class="form-control @error('visa_fees') is-invalid @enderror" name="visa_fees" value="{{ old('visa_fees') }}" >
									@error('visa_fees')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							
						</div>						
					</fieldset>
				</div>

				<div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
					<a href="{{ route('dashboard.bank_accounts.index') }}" class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> @lang('dashboard.add') </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('bank_accounts.edit_bank_account_details') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.bank_accounts.index') }}" class="breadcrumb-item"><i class="icon-cash3  mr-2"></i> @lang('bank_accounts.bank_accounts')</a>
<span class="breadcrumb-item active"> @lang('bank_accounts.edit_bank_account_details') </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> @lang('bank_accounts.edit_bank_account_details') </h5>
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
			<form action="{{ route('dashboard.bank_accounts.update' , ['bank_account' => $bank_account->id ] ) }}" method='POST' enctype="multipart/form-data" > 
				@csrf
				@method('PATCH')
				<div class="card-body">


					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">@lang('bank_accounts.bank_account_details')</legend>
						<div class="form-group row">
							
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('bank_accounts.name') </label>
									<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $bank_account->name }}" >
									@error('name')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('bank_accounts.account_number') </label>
									<input type="text" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{ $bank_account->account_number }}" >
									@error('account_number')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('bank_accounts.iban') </label>
									<input type="text" class="form-control @error('iban') is-invalid @enderror" name="iban" value="{{ $bank_account->iban }}" >
									@error('iban')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('bank_accounts.mada_fees') </label>
									<input type="text" class="form-control @error('mada_fees') is-invalid @enderror" name="mada_fees" value="{{ $bank_account->mada_fees }}" >
									@error('mada_fees')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('bank_accounts.visa_fees') </label>
									<input type="text" class="form-control @error('visa_fees') is-invalid @enderror" name="visa_fees" value="{{ $bank_account->visa_fees }}" >
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
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> @lang('dashboard.edit') </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
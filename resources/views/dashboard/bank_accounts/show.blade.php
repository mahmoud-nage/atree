@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('bank_accounts.show_bank_account_details') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.bank_accounts.index') }}" class="breadcrumb-item"><i class="icon-cash3 mr-2"></i> @lang('bank_accounts.bank_accounts')</a>
<span class="breadcrumb-item active"> @lang('bank_accounts.show_bank_account_details') </span>

@endsection
@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title"> @lang('bank_accounts.show_bank_account_details') </h5>
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

				<div class="card-body">
					<table class="table table-bordered table-hover">
						<tbody>
							<tr>
								<th> @lang('bank_accounts.created') </th>
								<td> {{ $bank_account->created_at->diffForHumans() }} </td>
							</tr>

							<tr>
								<th> @lang('bank_accounts.name') </th>
								<td> {{ $bank_account->name }} </td>
							</tr>
							<tr>
								<th> @lang('bank_accounts.account_number') </th>
								<td> {{ $bank_account->account_number }} </td>
							</tr>
							<tr>
								<th> @lang('bank_accounts.iban') </th>
								<td> {{ $bank_account->iban }} </td>
							</tr>
							<tr>
								<th> @lang('bank_accounts.mada_fees') </th>
								<td> {{ $bank_account->mada_fees }} </td>
							</tr>
							<tr>
								<th> @lang('bank_accounts.visa_fees') </th>
								<td> {{ $bank_account->visa_fees }} </td>
							</tr>
							<tr>
								<th> @lang('bank_accounts.added_by') </th>
								<td> <a href="{{ route('dashboard.admins.show' , ['admin' => $bank_account->user_id]) }}"> {{ optional($bank_account->user)->name }} </a> </td>
							</tr>
						</tbody>
					</table>

				</div>



			</div>
		</div>
	</div>
</div>
@endsection


@section('scripts')
@endsection



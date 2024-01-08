@extends('dashboard.layouts.master')

@section('page_title')
بيانات طلب السحب
@endsection

@section('page_header')
<a href="{{ route('dashboard.withdrawals.index') }}" class="breadcrumb-item"><i class="icon-equalizer   mr-2"></i> 
	طلبات السحب
</a>
<span class="breadcrumb-item active"> بيانات طلب السحب  </span>

@endsection
@section('page_content')

<div class="row">
	<div class="col-md-12 float-left mb-2">
		@if ($withdrawal->status != 4 && $withdrawal->status != 3 )
		<a href="{{ route('dashboard.withdrawals.approve' , $withdrawal ) }}" class='btn btn-success' > الموافقه على الطلب </a>
		<a href="{{ route('dashboard.withdrawals.deny' , $withdrawal ) }}" class='btn btn-danger' >  رفض الطلب </a>
		@endif
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> بيانات طلب السحب </h5>
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
				<table class="table table-bwithdrawaled table-hover">
					<tbody>
						<tr>
							<th> @lang('categories.created_at') </th>
							<td> {{ $withdrawal->created_at->diffForHumans() }} -- {{ $withdrawal->created_at }} </td>
						</tr>

						<tr>
							<th> رقم الطلب </th>
							<td> {{ $withdrawal->number }} </td>
						</tr>
						<tr>
							<th> المسوق  </th>
							<td> <a target="_blank" href="{{ route('dashboard.marketers.show' , $withdrawal->user_id ) }}"> {{ $withdrawal->user?->name }} </a> </td>
						</tr>

						<tr>
							<th> طريقه لسخب  </th>
							<td> 
								@switch($withdrawal->payment_method)
								@case(1)
								<span class='badge badge-primary' > محفظه الكترونيه </span>
								@break
								@case(2)
								<span class='badge badge-success' > حساب بنكى </span>
								@break
								@endswitch
							</td>
						</tr>
						<tr>
							<th> حاله الطلب   </th>
							<td> 
								@switch($withdrawal->status)
								@case(1)
								<span class='badge badge-secondary' > قيد المراجعه </span>
								@break
								@case(2)
								<span class='badge badge-warning' > قيد التنفيذ </span>
								@break
								@case(3)
								<span class='badge badge-success' > تم الموافقه </span>
								@break
								@case(4)
								<span class='badge badge-danger' > تم الرفض </span>
								@break
								@endswitch
							</td>
						</tr>
						
						<tr>
							<th> المبلغ </th>
							<td> {{ $withdrawal->amount }} <span class='text-muted' > جنيه </span> </td>
						</tr>

						@if ($withdrawal->payment_method == App\Models\Withdrawals::WALLET )
						<tr>
							<th> رقم المحفظه الالكترونيه </th>
							<td> {{ $withdrawal->phone }} </td>
						</tr>
						@endif
						@if ($withdrawal->payment_method == App\Models\Withdrawals::BANK_ACCOUNT )
						<tr>
							<th> البنك </th>
							<td> {{ $withdrawal->bank_account?->bank_name }} </td>
						</tr>
						<tr>
							<th> اسسم صاحب الحساب البنكى </th>
							<td> {{ $withdrawal->bank_account?->name }} </td>
						</tr>
						<tr>
							<th> رقم الحساب </th>
							<td> {{ $withdrawal->bank_account?->account_number }} </td>
						</tr>
						<tr>
							<th> رقم Iban </th>
							<td> {{ $withdrawal->bank_account?->iban }} </td>
						</tr>
						@endif

						<tr>
							<th> ملحوظات  </th>
							<td> {{ $withdrawal->system_notes }} </td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection


@section('scripts')
@endsection



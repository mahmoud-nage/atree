@extends('dashboard.layouts.master')

@section('page_title')
تفاصيل المصروفات
@endsection

@section('page_header')
<a href="{{ route('dashboard.expenses.index') }}" class="breadcrumb-item"><i class="icon-cash3 mr-2"></i> المصروفات</a>
<span class="breadcrumb-item active">تفاصيل المصروفات</span>

@endsection
@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title">تفاصيل المصروفات </h5>
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
								<td> {{ $expense->created_at->diffForHumans() }} </td>
							</tr>

							<tr>
								<th> العنوان </th>
								<td> {{ $expense->name }} </td>
							</tr>

							<tr>
								<th> التصنييف </th>
								<td> {{ $expense->category?->name }} </td>
							</tr>

							<tr>
								<th> التفاصيل </th>
								<td> {{ $expense->details }} </td>
							</tr>

							<tr>
								<th> المبلغ </th>
								<td> {{ $expense->money }} </td>
							</tr>
							
							<tr>
								<th> @lang('bank_accounts.added_by') </th>
								<td> <a href="{{ route('dashboard.admins.show' , ['admin' => $expense->user_id]) }}"> {{ $expense->user?->name }} </a> </td>
							</tr>
							<tr>
								<th> الصوره </th>
								<td> <img src="{{ Storage::url('expenses/'.$expense->image) }}" alt=""> </td>
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



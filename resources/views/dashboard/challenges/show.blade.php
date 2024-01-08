@extends('dashboard.layouts.master')

@section('page_title')
بيانات اتحدى
@endsection

@section('page_header')
<a href="{{ route('dashboard.challenges.index') }}" class="breadcrumb-item"><i class="icon-home7 mr-2"></i>  التحديات </a>
<span class="breadcrumb-item active"> بيانات اتحدى </span>

@endsection
@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title"> بيانات اتحدى </h5>
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
								<th> @lang('branches.created') </th>
								<td> {{ $challenge->created_at->diffForHumans() }} </td>
							</tr>

							<tr>
								<th> تم الاضاهف بواسطه </th>
								<td> {{ $challenge->user?->name }} </td>
							</tr>

							<tr>
								<th> عنون التحدى </th>
								<td> {{ $challenge->title }} </td>
							</tr>

							<tr>
								<th> اللون </th>
								<td> <span style="background-color: {{ $challenge->color }} " > {{ $challenge->color }} </span> </td>
							</tr>
							<tr>
								<th> عدد الطلبات المراد تحقيقها </th>
								<td> {{ $challenge->orders }} <span class='text-muted'> طلب </span> </td>
							</tr>
							<tr>
								<th> قيمه المكافله لكل طلب </th>
								<td> {{ $challenge->money }} <span class='text-muted'> جنيه </span> </td>
							</tr>
							<tr>
								<th> تاريخ البدىء </th>
								<td> {{ $challenge->starts_at }} </td>
							</tr>
							<tr>
								<th> تاريخ الانتهاء </th>
								<td> {{ $challenge->ends_at }} </td>
							</tr>
							<tr>
								<th>  هل يمكن للمستخدم سحب الارباح فى حاله انتهاء تاري التحدى ؟ </th>
								<td> 
									@switch($challenge->should_user_finishes_to_receive_money)
									@case(0)
									<span class='badge badge-danger' > لا </span>
									@break
									@case(1)
									<span class='badge badge-success' > نعم </span>
									@break
									@endswitch
								</td>
							</tr>
							<tr>
								<th> فعال  </th>
								<td> 
									@switch($challenge->is_active)
									@case(0)
									<span class='badge badge-danger' > غير فعال </span>
									@break
									@case(1)
									<span class='badge badge-success' > فعال </span>
									@break
									@endswitch
								</td>
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



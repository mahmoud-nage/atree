@extends('dashboard.layouts.master')

@section('page_title')
بيانات الكوبون
@endsection

@section('page_header')
<a href="{{ route('dashboard.coupons.index') }}" class="breadcrumb-item"><i class="icon-home7 mr-2"></i> كوبونات الخصم</a>
<span class="breadcrumb-item active"> بيانات الكوبون </span>

@endsection
@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title"> بيانات الكوبون </h5>
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
								<td> {{ $coupon->created_at->diffForHumans() }} </td>
							</tr>

							<tr>
								<th> كود الخصم </th>
								<td> {{ $coupon->code }} </td>
							</tr>
							<tr>
								<th> مبلغ الخصم </th>
								<td> {{ $coupon->discount }} جنيه </td>
							</tr>
							<tr>
								<th> تاريخ البدىء </th>
								<td> {{ $coupon->start_date }} </td>
							</tr>
							<tr>
								<th> تاريخ الانتهاء </th>
								<td> {{ $coupon->end_date }} </td>
							</tr>
							<tr>
								<th> عدد مرات الاستخدام المسموح بها</th>
								<td> {{ $coupon->allow_times }} </td>
							</tr>
							<tr>
								<th> السماح للمستخدم باستخدم الكوبون اكثر من مره </th>
								<td> 
									@switch($coupon->allowed_more_than_once_per_user)
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
									@switch($coupon->active)
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



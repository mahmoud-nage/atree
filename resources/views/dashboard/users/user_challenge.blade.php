@extends('dashboard.layouts.master')

@section('page_title')
عرض بيانات المسوق
@endsection

@section('page_header')
<a href="{{ route('dashboard.marketers.index') }}" class="breadcrumb-item"><i class="icon-users4  mr-2"></i> المسوقين </a>
<span class="breadcrumb-item active"> عرض بيانات المسوق </span>

@endsection
@section('page_content')
<div class="d-lg-flex align-items-lg-start">

	<!-- Left sidebar component -->
	<div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left wmin-300 border-0 shadow-none sidebar-expand-lg">

		<!-- Sidebar content -->
		<div class="sidebar-content">
			<div class="card">
				<div class="card-body text-center">
					<div class="card-img-actions d-inline-block mb-3">
						<img class="img-fluid img-thumbnail" src="{{ Storage::url('users/'.$marketer->image) }}" width="170" height="170" alt="">

					</div>

					<h6 class="font-weight-semibold mb-0"> {{ $marketer->name }} </h6>
					<span class="d-block opacity-75"> مسوق </span>
				</div>

				@include('dashboard.marketers.sidebar')
			</div>
		</div>
	</div>

	<div class="tab-content flex-1">
		<div class="tab-pane fade active show" id="profile">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title"> بيانات التحدى </h5>
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
								<th> تم بدىء التحدى بتاريخ </th>
								<td> {{ $user_challenge->created_at }} <span class='text-muted' > {{ $user_challenge->created_at->diffForHumans() }} </span> </td>
							</tr>
							<tr>
								<th> التحدى </th>
								<td>  <a href="{{ route('dashboard.challenges.show' , $user_challenge->challenge_id ) }}"> {{ $user_challenge->challenge?->title }} </a> </td>
							</tr>
							<tr>
								<th> حاله التحدى </th>
								<td>
									@switch($user_challenge->status)
									@case(1)
									<span class='badge badge-primary' > جارى  </span>
									@break
									@case(2)
									<span class='badge badge-success' > تحدى مكتمل </span>
									@break
									@case(3)
									<span class='badge badge-danger' > لم يكتمل </span>
									@break
									@endswitch
								</td>
							</tr>
							<tr>
								<th> نسبه التقدم </th>
								<td> 
									<div class="pace-demo w-auto h-auto p-3">
										<div class="theme_bar"><div class="pace_progress" data-progress-text="{{ $user_challenge->percentage }}%" data-progress="{{ $user_challenge->percentage }}" style="width: {{ $user_challenge->percentage }}%;"></div></div>
									</div>
									{{ $user_challenge->percentage }} %
								</td>
							</tr>
							<tr>
								<th> الارباح من التحد حتى الان </th>
								<td> {{ $user_challenge->challenge?->money * $user_challenge->orders_numbers }}  <span class='text-muted' > جنيه </span>  </td>
							</tr>

							<tr>
								<th> عدد الطلبات المحققه حتى الان </th>
								<td> {{  $user_challenge->orders_numbers }}  <span class='text-muted' > طلب </span>  </td>
							</tr>


							<tr>
								<th> هل تم سحب الارباح ام لا </th>
								<td> {!! $user_challenge->is_profits_withdrawals == 1 ? '<span class="badge badge-success" > نعم </span>' : '<span class="badge badge-secondary" > لا </span>' !!} </td>
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



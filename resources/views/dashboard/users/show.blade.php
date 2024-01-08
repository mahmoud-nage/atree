@extends('dashboard.layouts.master')

@section('page_title')
عرض بيانات المسوق
@endsection

@section('page_header')
<a href="{{ route('dashboard.users.index') }}" class="breadcrumb-item"><i class="icon-users4  mr-2"></i> المسوقين </a>
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
						<img class="img-fluid img-thumbnail" src="{{ Storage::url('users/'.$user->image) }}" width="170" height="170" alt="">

					</div>

					<h6 class="font-weight-semibold mb-0"> {{ $user->name }} </h6>
					<span class="d-block opacity-75"> مستخدم </span>
				</div>

				@include('dashboard.users.sidebar')
			</div>
		</div>
	</div>

	<div class="tab-content flex-1">
		<div class="tab-pane fade active show" id="profile">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title"> بيانات  المستخدم </h5>
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
								<th> @lang('admins.created') </th>
								<td> {{ $user->created_at->diffForHumans() }} </td>
							</tr>
							<tr>
								<th> @lang('admins.status') </th>
								<td>
									@switch($user->active)
									@case(1)
									<span  class='badge badge-success'> @lang('admins.active') </span>
									@break
									@case(0)
									<span  class='badge badge-danger'> @lang('admins.inactive') </span>
									@break
									@endswitch
								</td>
							</tr>
							<tr>
								<th> @lang('admins.name') </th>
								<td> {{ $user->name }} </td>
							</tr>
							<tr>
								<th> رقم الجوال </th>
								<td> {{ $user->phone }} </td>
							</tr>
							<tr>
								<th> @lang('admins.email') </th>
								<td> {{ $user->email }} </td>
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



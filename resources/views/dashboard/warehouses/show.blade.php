@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('warehouses.show_warehouse_details') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.warehouses.index') }}" class="breadcrumb-item"><i class="icon-git-branch  mr-2"></i> @lang('warehouses.warehouses')</a>
<span class="breadcrumb-item active"> @lang('warehouses.show_warehouse_details') </span>

@endsection
@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title"> @lang('warehouses.show_warehouse_details') </h5>
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
								<th> @lang('warehouses.created_at') </th>
								<td> {{ $warehouse->created_at->diffForHumans() }} </td>
							</tr>
							<tr>
								<th> تم الاضافه بواطه </th>
								<td> {{ $warehouse->user?->name }} </td>
							</tr>

							<tr>
								<th> @lang('warehouses.name_ar') </th>
								<td> {{ $warehouse->name }} </td>
							</tr>

							<tr>
								<th> @lang('warehouses.added_by') </th>
								<td> <a href="{{ route('dashboard.admins.show' , ['admin' => $warehouse->user_id]) }}"> {{ optional($warehouse->user)->name }} </a> </td>
							</tr>

							<tr>
								<th> مدير المستودع </th>
								<td> <a href="{{ route('dashboard.admins.show' , ['admin' => $warehouse->manger_id]) }}"> {{ $warehouse->manger?->name }} </a> </td>
							</tr>

							<tr>
								<th> المحافظات التى يغيذها المستودع </th>
								<td> 
									<ul>
										@foreach ($warehouse->governorates as $warehouse_governorate)
											<li> {{ $warehouse_governorate->governorate?->name }} </li>
										@endforeach
									</ul>
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



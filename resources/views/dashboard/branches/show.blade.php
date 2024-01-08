@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('branches.show_branch_details') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.branches.index') }}" class="breadcrumb-item"><i class="icon-home7 mr-2"></i> @lang('branches.branches')</a>
<span class="breadcrumb-item active"> @lang('branches.show_branch_details') </span>

@endsection
@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title"> @lang('branches.show_branch_details') </h5>
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
								<td> {{ $branch->created_at->diffForHumans() }} </td>
							</tr>

							<tr>
								<th> @lang('branches.name') </th>
								<td> {{ $branch->name }} </td>
							</tr>
							<tr>
								<th> @lang('branches.address') </th>
								<td> {{ $branch->address }} </td>
							</tr>
							<tr>
								<th> @lang('branches.phone1') </th>
								<td> {{ $branch->phone1 }} </td>
							</tr>
							<tr>
								<th> @lang('branches.phone2') </th>
								<td> {{ $branch->phone2 }} </td>
							</tr>
							<tr>
								<th> @lang('branches.mobile') </th>
								<td> {{ $branch->mobile }} </td>
							</tr>
							<tr>
								<th> @lang('branches.fax') </th>
								<td> {{ $branch->fax }} </td>
							</tr>
							<tr>
								<th> @lang('branches.commercial_registration') </th>
								<td> {{ $branch->commercial_registration }} </td>
							</tr>
							<tr>
								<th> @lang('branches.show_address') </th>
								<td> {{ $branch->show_address == 1 ? trans('branches.yes') : trans('branches.no') }} </td>
							</tr>
							<tr>
								<th> @lang('branches.show_phone1') </th>
								<td> {{ $branch->show_phone1 == 1 ? trans('branches.yes') : trans('branches.no') }} </td>
							</tr>
							<tr>
								<th> @lang('branches.show_phone2') </th>
								<td> {{ $branch->show_phone2 == 1 ? trans('branches.yes') : trans('branches.no') }} </td>
							</tr>
							<tr>
								<th> @lang('branches.show_mobile') </th>
								<td> {{ $branch->show_mobile == 1 ? trans('branches.yes') : trans('branches.no') }} </td>
							</tr>
							<tr>
								<th> @lang('branches.show_fax') </th>
								<td> {{ $branch->show_fax == 1 ? trans('branches.yes') : trans('branches.no') }} </td>
							</tr>
							<tr>
								<th> @lang('branches.show_commercial_registration') </th>
								<td> {{ $branch->show_commercial_registration == 1 ? trans('branches.yes') : trans('branches.no') }} </td>
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



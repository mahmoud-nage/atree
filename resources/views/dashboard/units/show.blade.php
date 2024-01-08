@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('units.show_unit_details') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.units.index') }}" class="breadcrumb-item"><i class="icon-equalizer   mr-2"></i> @lang('units.units')</a>
<span class="breadcrumb-item active"> @lang('units.show_unit_details') </span>

@endsection
@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title"> @lang('units.show_unit_details') </h5>
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
								<th> @lang('units.created_at') </th>
								<td> {{ $unit->created_at->diffForHumans() }} </td>
							</tr>
							<tr>
								<th> @lang('units.name_ar') </th>
								<td> {{ $unit->getTranslation('name' , 'ar') }} </td>
							</tr>
							<tr>
								<th> @lang('units.name_en') </th>
								<td> {{ $unit->getTranslation('name' , 'en') }} </td>
							</tr>
							<tr>
								<th> @lang('units.added_by') </th>
								<td> <a href="{{ route('dashboard.admins.show' , ['admin' => $unit->user_id]) }}"> {{ optional($unit->user)->name }} </a> </td>
							</tr>
							@php
								$conversion =  $unit->conversions()->first();
							@endphp
							<tr>
								<th> @lang('units.unit_name') </th>
								<th> {{ optional($conversion->unit)->name }} </th>
							</tr>
							<tr>
								<th> @lang('units.factor') </th>
								<th> {{ $conversion->factor }} </th>
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



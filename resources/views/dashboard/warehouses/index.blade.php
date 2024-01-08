@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('warehouses.show_all_brands') }}
@endsection

@section('page_header')
<span class="breadcrumb-item active"> @lang('warehouses.show_all_brands') </span>

@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">		
		<a href="{{ route('dashboard.warehouses.create') }}" class="btn btn-primary float-right "><i class="icon-plus3 mr-2 "></i> @lang('warehouses.add_new_warehouse')  </a>
	</div>
	<hr>
	<br>
	<div class="col-md-12">
		@include('dashboard.layouts.messages')
		@livewire('dashboard.warehouses.list-all-warehouses')
	</div>
</div>
@endsection


@section('scripts')
<script src="{{ Storage::url('dashboard_assets/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>

<script src="{{ Storage::url('dashboard_assets/global_assets/js/demo_pages/table_elements.js') }}"></script>

@endsection



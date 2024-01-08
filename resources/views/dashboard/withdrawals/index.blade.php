@extends('dashboard.layouts.master')

@section('page_title')
طلبات سحب الارباح
@endsection

@section('page_header')
<span class="breadcrumb-item active"> طلبات سحب الارباح</span>

@endsection

@section('page_content')

<div class="row">

	<hr>
	<br>
	<div class="col-md-12">
		@include('dashboard.layouts.messages')
		
		@livewire('dashboard.withdrawals.list-all-withdrawals')
	</div>
</div>
@endsection


@section('scripts')
<script src="{{ Storage::url('dashboard_assets/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>

<script src="{{ Storage::url('dashboard_assets/global_assets/js/demo_pages/table_elements.js') }}"></script>

@endsection



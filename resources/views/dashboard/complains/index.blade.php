@extends('dashboard.layouts.master')

@section('page_title')
الشكاوى و الاتقراحات
@endsection

@section('page_header')
<span class="breadcrumb-item active"> الشكاوى و الاتقراحات </span>

@endsection

@section('page_content')

<div class="row">

	<hr>
	<br>
	<div class="col-md-12">
		@include('dashboard.layouts.messages')
		
		@livewire('dashboard.complains.list-all-complains')
	</div>
</div>
@endsection


@section('scripts')
<script src="{{ Storage::url('dashboard_assets/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>

<script src="{{ Storage::url('dashboard_assets/global_assets/js/demo_pages/table_elements.js') }}"></script>

@endsection



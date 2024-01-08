@extends('dashboard.layouts.master')

@section('page_title')
عرض كافه المستخدمين
@endsection

@section('page_header')
<span class="breadcrumb-item active"> عرض كافه المستخدمين </span>

@endsection

@section('page_content')

<div class="row">

	<div class="col-md-12">
		@include('dashboard.layouts.messages')
		@livewire('dashboard.users.list-all-users')
	</div>
</div>
@endsection


@section('scripts')
<script src="{{ asset('dashboard_assets/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="{{ asset('dashboard_assets/global_assets/js/demo_pages/table_elements.js') }}"></script>
@endsection



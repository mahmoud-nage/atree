@extends('dashboard.layouts.master')

@section('page_title')
المصروفات
@endsection

@section('page_header')
<span class="breadcrumb-item active"> المصروفات </span>

@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<a href="{{ route('dashboard.expenses.create') }}" class="btn btn-primary float-right "><i class="icon-plus3  mr-2 "></i> إضافه مصروفات جديده  </a>
	</div>
	<hr>
	<br>
	<div class="col-md-12">
		@include('dashboard.layouts.messages')
		@livewire('dashboard.expenses.list-all-expenses')
	</div>
</div>
@endsection


@section('scripts')
<script src="{{ Storage::url('dashboard_assets/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>

<script src="{{ Storage::url('dashboard_assets/global_assets/js/demo_pages/table_elements.js') }}"></script>

@endsection



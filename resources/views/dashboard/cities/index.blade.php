@extends('dashboard.layouts.master')

@section('page_title')
عرض كافه المدن
@endsection

@section('page_header')
<span class="breadcrumb-item active"> عرض كافه المدن </span>

@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<a href="{{ route('dashboard.cities.create') }}" class="btn btn-primary float-right "><i class="icon-plus3  mr-2 "></i> إضافه مدينه جديده  </a>
	</div>
	<hr>
	<br>
	<div class="col-md-12">
		@include('dashboard.layouts.messages')
		@livewire('dashboard.cities.list-all-cities')
	</div>
</div>
@endsection


@section('scripts')
<script src="{{ Storage::url('dashboard_assets/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>

<script src="{{ Storage::url('dashboard_assets/global_assets/js/demo_pages/table_elements.js') }}"></script>

@endsection



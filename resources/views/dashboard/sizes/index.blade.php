@extends('dashboard.layouts.master')

@section('page_title')
عرض كافه المقاسات
@endsection

@section('page_header')
<span class="breadcrumb-item active"> عرض كافه المقاسات </span>

@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<a href="{{ route('dashboard.sizes.create') }}" class="btn btn-primary float-right "><i class="icon-plus3 mr-2 "></i> إضافه مقاس جديد </a>
	</div>
	<hr>
	<br>
	<div class="col-md-12">
		@include('dashboard.layouts.messages')
		
		@livewire('dashboard.sizes.list-all-sizes')
	</div>
</div>
@endsection


@section('scripts')
<script src="{{ asset('dashboard_assets/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>

<script src="{{ asset('dashboard_assets/global_assets/js/demo_pages/table_elements.js') }}"></script>

@endsection



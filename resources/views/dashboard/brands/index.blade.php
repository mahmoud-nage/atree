@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('brands.show_all_brands') }}
@endsection

@section('page_header')
<span class="breadcrumb-item active"> @lang('brands.show_all_brands') </span>

@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">		
		<a href="{{ route('dashboard.brands.create') }}" class="btn btn-primary float-right "><i class="icon-plus3 mr-2 "></i> @lang('brands.add_new_brand')  </a>
	</div>
	<hr>
	<br>
	<div class="col-md-12">
		@include('dashboard.layouts.messages')
		@livewire('dashboard.brands.list-all-brands')
	</div>
</div>
@endsection


@section('scripts')
<script src="{{ Storage::url('dashboard_assets/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>

<script src="{{ Storage::url('dashboard_assets/global_assets/js/demo_pages/table_elements.js') }}"></script>

@endsection



@extends('dashboard.layouts.master')

@section('page_title')
@lang('site.shipping_companies')
@endsection

@section('page_header')
<span class="breadcrumb-item active"> @lang('site.show_all_shipping_companies') </span>

@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<a href="{{ route('dashboard.shipping_companies.create') }}" class="btn btn-primary float-right "><i class="icon-plus3 mr-2 "></i> @lang('site.add_new_shipping_company') </a>
	</div>
	<hr>
	<br>
	<div class="col-md-12">
		@include('dashboard.layouts.messages')
        @livewire('dashboard.shipping-companies.list-all-shipping-companies')
	</div>
</div>
@endsection


@section('scripts')
<script src="{{ asset('dashboard_assets/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>

<script src="{{ asset('dashboard_assets/global_assets/js/demo_pages/table_elements.js') }}"></script>

@endsection



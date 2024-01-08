@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('pages.show_all_pages') }}
@endsection

@section('page_header')
<span class="breadcrumb-item active"> @lang('pages.show_all_pages') </span>

@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">		
		<a href="{{ route('dashboard.pages.create') }}" class="btn btn-primary float-right "><i class="icon-plus3 mr-2 "></i> @lang('pages.add_new_page')  </a>
	</div>
	<hr>
	<br>
	<br>
	<div class="col-md-12">
		@include('dashboard.layouts.messages')
		@livewire('dashboard.pages.list-all-pages')
	</div>
</div>
@endsection


@section('scripts')
<script src="{{ Storage::url('dashboard_assets/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>

<script src="{{ Storage::url('dashboard_assets/global_assets/js/demo_pages/table_elements.js') }}"></script>

@endsection



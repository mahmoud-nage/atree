@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('messages.show_all_messages') }}
@endsection

@section('page_header')
<span class="breadcrumb-item active"> @lang('messages.show_all_messages') </span>

@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		@include('dashboard.layouts.messages')
		@livewire('dashboard.messages.list-all-message')
	</div>
</div>
@endsection


@section('scripts')
<script src="{{ Storage::url('dashboard_assets/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>

<script src="{{ Storage::url('dashboard_assets/global_assets/js/demo_pages/table_elements.js') }}"></script>

@endsection



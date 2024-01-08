@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('slides.show_all_slides') }}
@endsection

@section('page_header')
<span class="breadcrumb-item active"> @lang('slides.show_all_slides') </span>

@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">		
		<a href="{{ route('dashboard.slides.create') }}" class="btn btn-primary float-right "><i class="icon-plus3 mr-2 "></i> @lang('slides.add_new_slide')  </a>
	</div>
	<hr>
	<br>
	<div class="col-md-12">
		@include('dashboard.layouts.messages')
		@livewire('dashboard.slides.list-all-slide')
	</div>
</div>
@endsection


@section('scripts')
<script src="{{ Storage::url('dashboard_assets/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>

<script src="{{ Storage::url('dashboard_assets/global_assets/js/demo_pages/table_elements.js') }}"></script>

@endsection



@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('pages.show_page_details') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.pages.index') }}" class="breadcrumb-item"><i class="icon-newspaper2 mr-2"></i> @lang('pages.pages')</a>
<span class="breadcrumb-item active"> @lang('pages.show_page_details') </span>

@endsection
@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title"> @lang('pages.show_page_details') </h5>
					<div class="header-elements">
						<div class="d-flex justify-content-between">
							<div class="list-icons ml-3">
								<a class="list-icons-item" data-action="collapse"></a>
								<a class="list-icons-item" data-action="reload"></a>
								<a class="list-icons-item" data-action="remove"></a>
							</div>
						</div>
					</div>
				</div>

				<div class="card-body">
					<table class="table table-bordered table-hover">
						<tbody>
							<tr>
								<th> @lang('pages.created_at') </th>
								<td> {{ $page->created_at->diffForHumans() }} </td>
							</tr>
							<tr>
								<th> @lang('pages.added_by') </th>
								<td> {{ optional($page->user)->name }} </td>
							</tr>
							<tr>
								<th> slug </th>
								<td> {{ $page->slug }} </td>
							</tr>

							<tr>
								<th> @lang('pages.status') </th>
								<td>
									@switch($page->active)
									@case(1)
									<span  class='badge badge-success'> @lang('pages.active') </span>
									@break
									@case(0)
									<span  class='badge badge-danger'> @lang('pages.inactive') </span>
									@break
									@endswitch
								</td>
							</tr>
							<tr>
								<th> @lang('pages.title_ar') </th>
								<td> {{ $page->getTranslation('title' , 'ar') }} </td>
							</tr>
							<tr>
								<th> @lang('pages.title_en') </th>
								<td> {{ $page->getTranslation('title' , 'en') }} </td>
							</tr>
							<tr>
								<th> @lang('pages.content_ar') </th>
								<td> {!! $page->getTranslation('content' , 'ar') !!} </td>
							</tr>
							<tr>
								<th> @lang('pages.content_en') </th>
								<td> {!! $page->getTranslation('content' , 'en') !!} </td>

							</tbody>
						</table>

					</div>



				</div>
			</div>
		</div>
	</div>
	@endsection


	@section('scripts')
	@endsection



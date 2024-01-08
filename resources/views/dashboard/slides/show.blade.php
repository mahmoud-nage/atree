@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('slides.show_slide_details') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.slides.index') }}" class="breadcrumb-item"><i class="icon-images3  mr-2"></i> @lang('slides.slides')</a>
<span class="breadcrumb-item active"> @lang('slides.show_slide_details') </span>

@endsection
@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title"> @lang('slides.show_slide_details') </h5>
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
								<th> @lang('slides.created_at') </th>
								<td> {{ $slide->created_at->diffForHumans() }} </td>
							</tr>
							<tr>
								<th> @lang('slides.status') </th>
								<td>
									@switch($slide->is_active)
									@case(1)
									<span  class='badge badge-success'> @lang('slides.active') </span>
									@break
									@case(0)
									<span  class='badge badge-danger'> @lang('slides.inactive') </span>
									@break
									@endswitch
								</td>
							</tr>

							<tr>
								<th> @lang('slides.link') </th>
								<td> <a href="{{ $slide->link }}"> {{ $slide->link }} </a> </td>
							</tr>
							<tr>
								<th> @lang('slides.added_by') </th>
								<td> <a href="{{ route('dashboard.slides.show' , ['slide' => $slide->user_id]) }}"> {{ optional($slide->user)->name }} </a> </td>
							</tr>
							<tr>
								<th> @lang('slides.logo') </th>
								<td> <img class='img-thumbnail img-responsive' src="{{ Storage::url('slides/'.$slide->image) }}" alt=""> </td>
							</tr>
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



@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('categories.show_category_details') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.categories.index') }}" class="breadcrumb-item"><i class="icon-equalizer   mr-2"></i> @lang('categories.categories')</a>
<span class="breadcrumb-item active"> @lang('categories.show_category_details') </span>

@endsection
@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title"> @lang('categories.show_category_details') </h5>
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
								<th> @lang('categories.created_at') </th>
								<td> {{ $category->created_at->diffForHumans() }} </td>
							</tr>
							<tr>
								<th> @lang('categories.status') </th>
								<td>
									@switch($category->active)
									@case(1)
									<span  class='badge badge-success'> @lang('categories.active') </span>
									@break
									@case(0)
									<span  class='badge badge-danger'> @lang('categories.inactive') </span>
									@break
									@endswitch
								</td>
							</tr>
							<tr>
								<th> عرض داخل الشفحه الرئيسيه </th>
								<td>
									@if ($category->show_in_home_page)
										<span class='badge badge-success' > نعم </span>
									@else
									<span class='badge badge-secondary' > لا </span>
									@endif
								</td>
							</tr>

							<tr>
								<th> عرض داخل الheader </th>
								<td>
									@if ($category->show_in_header)
										<span class='badge badge-success' > نعم </span>
									@else
									<span class='badge badge-secondary' > لا </span>
									@endif
								</td>
							</tr>


							<tr>
								<th> عرض اسفل ال slider </th>
								<td>
									@if ($category->show_after_slider)
										<span class='badge badge-success' > نعم </span>
									@else
									<span class='badge badge-secondary' > لا </span>
									@endif
								</td>
							</tr>
							<tr>
								<th> @lang('categories.name_ar') </th>
								<td> {{ $category->getTranslation('name' , 'ar') }} </td>
							</tr>
							<tr>
								<th> @lang('categories.name_en') </th>
								<td> {{ $category->getTranslation('name' , 'en') }} </td>
							</tr>
							<tr>
								<th> @lang('categories.added_by') </th>
								<td> <a href="{{ route('dashboard.categories.show' , ['category' => $category->user_id]) }}"> {{ optional($category->user)->name }} </a> </td>
							</tr>
							<tr>
								<th> @lang('categories.image') </th>
								<td> <img src="{{ Storage::url('categories/'.$category->image) }}" alt=""> </td>
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



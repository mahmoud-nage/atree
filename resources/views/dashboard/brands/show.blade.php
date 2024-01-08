@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('brands.show_brand_details') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.brands.index') }}" class="breadcrumb-item"><i class="icon-git-branch  mr-2"></i> @lang('brands.brands')</a>
<span class="breadcrumb-item active"> @lang('brands.show_brand_details') </span>

@endsection
@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title"> @lang('brands.show_brand_details') </h5>
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
								<th> @lang('brands.created_at') </th>
								<td> {{ $brand->created_at->diffForHumans() }} </td>
							</tr>
							<tr>
								<th> @lang('brands.status') </th>
								<td>
									@switch($brand->active)
                            @case(1)
                            <span  class='badge badge-success'> @lang('brands.active') </span>
                            @break
                            @case(0)
                            <span  class='badge badge-danger'> @lang('brands.inactive') </span>
                            @break
                            @endswitch
								</td>
							</tr>
							<tr>
								<th> @lang('brands.name_ar') </th>
								<td> {{ $brand->getTranslation('name' , 'ar') }} </td>
							</tr>
							<tr>
								<th> @lang('brands.name_en') </th>
								<td> {{ $brand->getTranslation('name' , 'en') }} </td>
							</tr>
							<tr>
								<th> @lang('brands.added_by') </th>
								<td> <a href="{{ route('dashboard.brands.show' , ['brand' => $brand->user_id]) }}"> {{ optional($brand->user)->name }} </a> </td>
							</tr>
							<tr>
								<th> @lang('brands.logo') </th>
								<td> <img src="{{ Storage::url('brands/'.$brand->logo) }}" alt=""> </td>
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



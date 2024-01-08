@extends('dashboard.layouts.master')

@section('page_title')
عرض التفاصيل 
@endsection

@section('page_header')
<a href="{{ route('dashboard.complains.index') }}" class="breadcrumb-item"><i class="icon-equalizer   mr-2"></i> 
	الشكاوى و الاقتراحات
</a>
<span class="breadcrumb-item active"> عرض التفاصيل  </span>

@endsection
@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title"> عرض التفاصيل </h5>
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
								<td> {{ $complain->created_at->diffForHumans() }} -- {{ $complain->created_at }} </td>
							</tr>

							<tr>
								<th> النوع </th>
								<td> {{ $complain->type }} </td>
							</tr>
							<tr>
								<th>التصنيف  </th>
								<td> {{ $complain->category }} </td>
							</tr>
							<tr>
								<th>المحتوى  </th>
								<td> {{ $complain->content }} </td>
							</tr>
							@if ($complain->user_id)
							<tr>
								<th>  المستخدم  </th>
								<td> {{ $complain->user->name }} </td>
							</tr>
							@else
							<tr>
								<th>  البريد ااكتورنى  </th>
								<td> {{ $complain->email }} </td>
							</tr>
							<tr>
								<th>  رقم الموبيل  </th>
								<td> {{ $complain->phone }} </td>
							</tr>
							@endif
							
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



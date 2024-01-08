@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('messages.show_message_details') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.messages.index') }}" class="breadcrumb-item"><i class="icon-newspaper2 mr-2"></i> @lang('messages.messages')</a>
<span class="breadcrumb-item active"> @lang('messages.show_message_details') </span>

@endsection
@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title"> @lang('messages.show_message_details') </h5>
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
								<th> @lang('messages.created_at') </th>
								<td> {{ $message->created_at->diffForHumans() }} </td>
							</tr>
							<tr>
								<th> @lang('messages.name') </th>
								<td> {{ $message->name }} </td>
							</tr>
							<tr>
								<th> @lang('messages.email') </th>
								<td> {{ $message->email }} </td>
							</tr>
							<tr>
								<th> @lang('messages.phone') </th>
								<td> {{ $message->phone }} </td>
							</tr>
							<tr>
								<th> @lang('messages.message') </th>
								<td> {{ $message->message }} </td>
							</tr>
							<tr>
								<th> @lang('messages.status') </th>
								<td>
									@switch($message->seen)
									@case(1)
									<span  class='badge badge-success'> @lang('messages.yes') </span>
									@break
									@case(0)
									<span  class='badge badge-primary'> @lang('messages.no') </span>
									@break
									@endswitch
								</td>
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



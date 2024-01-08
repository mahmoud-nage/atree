@extends('dashboard.layouts.master')

@section('page_title')
عرض بيانات المسوق
@endsection

@section('page_header')
<a href="{{ route('dashboard.marketers.index') }}" class="breadcrumb-item"><i class="icon-users4  mr-2"></i> المسوقين </a>
<span class="breadcrumb-item active"> عرض بيانات المسوق </span>

@endsection
@section('page_content')
<div class="d-lg-flex align-items-lg-start">

	<!-- Left sidebar component -->
	<div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left wmin-300 border-0 shadow-none sidebar-expand-lg">

		<!-- Sidebar content -->
		<div class="sidebar-content">
			<div class="card">
				<div class="card-body text-center">
					<div class="card-img-actions d-inline-block mb-3">
						<img class="img-fluid img-thumbnail" src="{{ Storage::url('users/'.$marketer->image) }}" width="170" height="170" alt="">

					</div>

					<h6 class="font-weight-semibold mb-0"> {{ $marketer->name }} </h6>
					<span class="d-block opacity-75"> مسوق </span>
				</div>

				@include('dashboard.marketers.sidebar')
				
			</div>
		</div>
	</div>

	<div class="tab-content flex-1">
		<div class="tab-pane fade active show" id="profile">
			@livewire('dashboard.users.list-all-user-withdrawals' , ['user' => $marketer ] )
		</div>
	</div>


</div>
@endsection


@section('scripts')
@endsection



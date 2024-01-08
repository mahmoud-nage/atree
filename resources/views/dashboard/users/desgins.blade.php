@extends('dashboard.layouts.master')

@section('page_title')
عرض تصاميم المستخدم
@endsection

@section('page_header')
<a href="{{ route('dashboard.users.index') }}" class="breadcrumb-item"><i class="icon-users4  mr-2"></i> المسوقين </a>
<span class="breadcrumb-item active"> عرض تصاميم المستخدم </span>

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
						<img class="img-fluid img-thumbnail" src="{{ Storage::url('users/'.$user->image) }}" width="170" height="170" alt="">

					</div>

					<h6 class="font-weight-semibold mb-0"> {{ $user->name }} </h6>
					<span class="d-block opacity-75"> مسوق </span>
				</div>

				@include('dashboard.users.sidebar')
				
			</div>
		</div>
	</div>

	<div class="tab-content flex-1">
		<div class="tab-pane fade active show" id="profile">
			@livewire('dashboard.users.list-all-user-desgins' , ['user' => $user ] )
		</div>
	</div>


</div>
@endsection


@section('scripts')

@section('scripts')
<script src="{{ asset('dashboard_assets/global_assets/js/plugins/media/glightbox.min.js') }}"></script>
<script src="{{ asset('dashboard_assets/global_assets/js/demo_pages/gallery.js') }}"></script>
@endsection


@endsection



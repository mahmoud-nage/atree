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

			<div class="row">
				<div class="col-sm-6">
					<div class="card card-body">
						<div class="media">
							<div class="media-body">
								<h3 class="font-weight-semibold mb-0"> {{ $marketer->orders_count }}  <span class='text-muted' > طلب </span> </h3>
								<span class="text-uppercase font-size-sm text-muted">عدد الطلبات الكلى</span>
							</div>

							<div class="ml-3 align-self-center">
								<i class="icon-bag icon-3x text-primary"></i>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="card card-body">
						<div class="media">
							<div class="media-body">
								<h3 class="font-weight-semibold mb-0">{{ $marketer->returns_count }} <span class='text-muted' > مرتجع </span></h3>
								<span class="text-uppercase font-size-sm text-muted"> عدد المرتجعات الكلى </span>
							</div>

							<div class="ml-3 align-self-center">
								<i class="icon-bag icon-3x text-warning"></i>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="card card-body">
						<div class="media">
							<div class="media-body">
								<h3 class="font-weight-semibold mb-0">  {{ $marketer->challenges_count }} <span class='text-muted' > تحدى </span>  </h3>
								<span class="text-uppercase font-size-sm text-muted">عدد التحديات المشارك بيها</span>
							</div>
							<div class="ml-3 align-self-center">
								<i class="icon-trophy2  icon-3x text-primary"></i>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="card card-body">
						<div class="media">
							<div class="media-body">
								<h3 class="font-weight-semibold mb-0">
									{{ $marketer->finished_challenges_count }}<span class='text-muted' > تحدى </span>
								</h3>
								<span class="text-uppercase font-size-sm text-muted"> عدد التحديات التى قام بانهائها </span>
							</div>
							<div class="ml-3 align-self-center">
								<i class="icon-trophy2  icon-3x text-success"></i>
							</div>
						</div>
					</div>
				</div>


				<div class="col-sm-6">
					<div class="card card-body">
						<div class="media">
							<div class="media-body">
								<h3 class="font-weight-semibold mb-0">
									{{ $marketer->unfinished_challenges_count }}  <span class='text-muted' > تحدى </span>
								</h3>
								<span class="text-uppercase font-size-sm text-muted">  عدد التحديات غير المنتهيه </span>
							</div>
							<div class="ml-3 align-self-center">
								<i class="icon-trophy2  icon-3x text-warning"></i>
							</div>
						</div>
					</div>
				</div>


				<div class="col-sm-6">
					<div class="card card-body">
						<div class="media">
							<div class="media-body">
								<h3 class="font-weight-semibold mb-0">
									{{ $marketer->points_count }} <span class='text-muted' > نقطه </span>
								</h3>
								<span class="text-uppercase font-size-sm text-muted">  عدد النقاط الكلى المكتسبه </span>
							</div>
							<div class="ml-3 align-self-center">
								<i class="icon-primitive-dot  icon-3x text-primary"></i>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="card card-body">
						<div class="media">
							<div class="media-body">
								<h3 class="font-weight-semibold mb-0">
									{{ $marketer->transferred_points }}  <span class='text-muted' > نقطه </span>
								</h3>
								<span class="text-uppercase font-size-sm text-muted"> عدد النقاط المحوله </span>
							</div>
							<div class="ml-3 align-self-center">
								<i class="icon-primitive-dot   icon-3x text-success"></i>
							</div>
						</div>
					</div>
				</div>


				<div class="col-sm-6">
					<div class="card card-body">
						<div class="media">
							<div class="media-body">
								<h3 class="font-weight-semibold mb-0">
									{{ $marketer->total_purchases }} <span class='text-muted' > جنيه </span> 
								</h3>
								<span class="text-uppercase font-size-sm text-muted"> اجمالى مبلغ المشتريات من الموقع </span>
							</div>
							<div class="ml-3 align-self-center">
								<i class="icon-coin-dollar  icon-3x text-primary"></i>
							</div>
						</div>
					</div>
				</div>



				<div class="col-sm-6">
					<div class="card card-body">
						<div class="media">
							<div class="media-body">
								<h3 class="font-weight-semibold mb-0">
									{{ $marketer->total_incomes }} <span class='text-muted' > جنيه </span>
								</h3>
								<span class="text-uppercase font-size-sm text-muted"> اجمالى مبلغ العموله المكتسبه </span>
							</div>
							<div class="ml-3 align-self-center">
								<i class="icon-coin-dollar  icon-3x text-success"></i>
							</div>
						</div>
					</div>
				</div>



			</div>
		</div>

	</div>

</div>
</div>
@endsection


@section('scripts')
@endsection



@extends('site.layouts.master')
@section('page_content')
<section class="content">
	<div class="container-fluid">
		<div class="row">

			<div class="col-md-5">
				<div class="card card-primary card-outline">
					<div class="card-body box-profile widget-user-2">
						<div class="widget-user-header">
							<div class="widget-user-image">
								<img class="img-circle elevation-1" src="{{ Storage::url('users/'.$user->image) }}" alt="{{ $user->first_name }}">
							</div>
							<h3 class="widget-user-username"> {{ $user->first_name }} {{ $user->last_name }} </h3>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<div class="card">
					<div class="card-header p-2">
						<ul class="nav flex-column nav-pills border-bottom">
							<li class="nav-item"><a class="nav-link active" href="#Profile" data-toggle="tab"> @lang('site.My Account') </a></li>
							<li class="nav-item"><a class="nav-link" href="#Address" data-toggle="tab"> @lang('site.My Address') </a></li>
							<li class="nav-item"><a class="nav-link" href="#Password" data-toggle="tab"> @lang('site.Change Password') </a></li>
						</ul>
						<a href="#" class="btn text-danger btn-block font-weight-light text-left"><b> @lang('site.Delete Account') </b></a>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="tab-content">
					<div class="active tab-pane" id="Profile">
						@livewire('site.edit-profile' , ['user' => $user ] )
					</div>
					<div class="tab-pane" id="Address">
						@livewire('site.user-addresses' , ['user' => $user] )
					</div>
					<div class="tab-pane" id="Password">
						@livewire('site.edit-password' , ['user' => $user] )
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection



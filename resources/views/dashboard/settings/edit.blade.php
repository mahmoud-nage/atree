@extends('dashboard.layouts.master')

@php
$lang = LaravelLocalization::getCurrentLocale();
@endphp
@section('page_title')
{{ trans('settings.edit_setting_details') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.settings.edit') }}" class="breadcrumb-item"><i class="icon-newspaper2 mr-2"></i> @lang('settings.settings')</a>
<span class="breadcrumb-item active"> @lang('settings.edit_setting_details') </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		@include('dashboard.layouts.messages')
		<div class="card">
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> @lang('settings.edit_setting_details') </h5>
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
			<form action="{{ route('dashboard.settings.update' ) }}" method='POST' enctype="multipart/form-data" > 		@method('PATCH')
				@csrf
				<div class="card-body">


					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">
							البينات
						</legend>
						<div class="form-group row">

							<div class="col-md-6">
								<div  class='mb-2' >
									<label class="col-form-label">شعار الموقع </label>
									<input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo"  >
									@error('logo')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>	
							<div class="col-md-6">
								<div  class='mb-2' >
									<label class="col-form-label"> صور المستخدم الافتراضيه </label>
									<input type="file" class="form-control @error('user_default_image') is-invalid @enderror" name="user_default_image"  >
									@error('user_default_image')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>	

							
							<div class="col-md-6">
								<div  class='mb-2' >
									<label class="col-form-label"> من نحن بالعربيه </label>
									<input type="text" class="form-control @error('about_us_ar') is-invalid @enderror" name="about_us_ar" value="{{ $info->getTranslation('about_us' , 'ar') }}" >
									@error('about_us_ar')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>			
							<div class="col-md-6">
								<div  class='mb-2' >
									<label class="col-form-label"> من نحن بالانجليزيه </label>
									<input type="text" class="form-control @error('about_us_en') is-invalid @enderror" name="about_us_en" value="{{ $info->getTranslation('about_us' , 'en') }}" >
									@error('about_us_en')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('settings.email') </label>
									<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $info->email }}" >
									@error('email')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('settings.phone') </label>
									<input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $info->phone }}" >
									@error('phone')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('settings.facebook') </label>
									<input type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ $info->facebook }}" >
									@error('facebook')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> @lang('settings.instgrame') </label>
									<input type="text" class="form-control @error('instgrame') is-invalid @enderror" name="instgrame" value="{{ $info->instgrame }}" >
									@error('instgrame')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> حساب تويتر </label>
									<input type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter" value="{{ $info->twitter }}" >
									@error('twitter')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label"> رابط تطبيق Android </label>
									<input type="text" class="form-control @error('android_link') is-invalid @enderror" name="android_link" value="{{ $info->android_link }}" >
									@error('android_link')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>
							<div class="col-md-4">
								<div  class='mb-2' >
									<label class="col-form-label">  رابط تطبيق IOS  </label>
									<input type="text" class="form-control @error('ios_link') is-invalid @enderror" name="ios_link" value="{{ $info->ios_link }}" >
									@error('ios_link')
									<p  class='text-danger' >  {{ $message }} </p>
									@enderror
								</div>
							</div>

							<div class="col-md-12">
								<div  class='mb-2' >
									 <label> عنوان الفرع على الخريطه </label>
                                    <div id="map" style="width: 100%; height: 400px;"></div>
                                    <input type="hidden" name="latitude" value="{{ $info->lat }}" id="latitude">
                                    <input type="hidden" name="longitude" value="{{ $info->long }}" id="longitude">
								</div>
							</div>

							

							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label">شعار الموقع الحالى </label>
									<img class='img-thumbnail img-responsive' src="{{ Storage::url('settings/'.$info->logo) }}" alt="">
								</div>
							</div>	

							<div class="col-md-12">
								<div  class='mb-2' >
									<label class="col-form-label"> صوره الملف الشخصى للمستخدم  الافتراضيه الحاليه </label>
									<img class='img-thumbnail img-responsive' src="{{ Storage::url('users/user-default.png') }}" alt="">
								</div>
							</div>	

						</div>						
					</fieldset>
				</div>

				<div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
					<a href="{{ route('dashboard.settings.edit') }}" class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
					<button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto"> @lang('dashboard.edit') </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection





@section('scripts')
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyBuQymvDTcNgdRWQN0RhT2YxsJeyh8Bys4&amp;libraries=places">
    </script>

    <script>
        $(document).ready(function() {

            var latlng = new google.maps.LatLng({{ $info->lat }}, {{ $info->long }});
            var map = new google.maps.Map(document.getElementById('map'), {
                center: latlng,
                zoom: 11,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: 'Set lat/lon values for this property',
                draggable: true
            });
            google.maps.event.addListener(marker, 'dragend', function(event) {
                document.getElementById("latitude").value = this.getPosition().lat();
                document.getElementById("longitude").value = this.getPosition().lng();
            });


            $(document).on('click', '.clone', function() {

                var clone = $(this).closest('.col-lg-3').clone();
                clone.find('.clone').removeClass('btn-success clone').addClass('btn-danger remove').val(
                    'Remove');

                var value = $(this).closest('.col-lg-3').find('input[name="whatsup[]"]').val();


                clone.find('input[name="whatsup[]"]').val('');

                $(this).closest('.row').append(clone);
            });


            $(document).on('click', '.remove', function() {
                $(this).closest('.col-lg-3').remove();
            });


        });
    </script>
@endsection
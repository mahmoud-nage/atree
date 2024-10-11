@extends('dashboard.layouts.master')

@section('page_title')
بيانات المحافظه
@endsection

@section('page_header')
<a href="{{ route('dashboard.governorates.index') }}" class="breadcrumb-item"><i class="icon-home7 mr-2"></i> المحافظات </a>
<span class="breadcrumb-item active"> بيانات المحافظه </span>

@endsection
@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title"> تفاصيل المحافظه </h5>
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
								<th> تاريخ الاضافه </th>
								<td> {{ $governorate->created_at->diffForHumans() }} </td>
							</tr>
							<tr>
								<th> الاسم بالعربيه </th>
								<td> {{ $governorate->getTranslation('name' , 'ar') }} </td>
							</tr>
							<tr>
								<th> الاسم بالانجليزيه </th>
								<td> {{ $governorate->getTranslation('name' , 'en') }} </td>
							</tr>
							<tr>
								<th> الدوله </th>
								<td> {{ $governorate->country?->name }} </td>
							</tr>

							<tr>
								<th> سعر الشحن </th>
								<td> {{ $governorate->shipping_cost }} {{__('site.SAR')}} </td>
							</tr>

							<tr>
								<th> الحاله </th>
								<td>
									@switch($governorate->active)
                                @case(0)
                                <span class='badge badge-danger' > غير فعال </span>
                                @break
                                @case(1)
                                <span class='badge badge-success' > فعال </span>
                                @break
                            @endswitch
								</td>
							</tr>

                            <tr>
                                <th> @lang('categories.added_by') </th>
                                <td> <a href="{{ route('dashboard.admins.show' ,  $governorate->user_id ) }}"> {{ optional($governorate->user)->name }} </a> </td>
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



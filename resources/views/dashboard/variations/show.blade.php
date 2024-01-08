@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('products.show_product_details') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.products.index') }}" class="breadcrumb-item"><i class="icon-ampersand  mr-2"></i> @lang('products.products')</a>
<span class="breadcrumb-item active"> @lang('products.show_product_details') </span>

@endsection
@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title"> @lang('products.show_product_details') </h5>
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
								<th> @lang('products.created') </th>
								<td> {{ $product->created_at->toDateTimeString() }} <span class='text-muted' >{{ $product->created_at->diffForHumans() }} </span> </td>
							</tr>
							<tr>
								<th> @lang('products.added_by') </th>
								<td> <a href="{{ route('dashboard.admins.show' , ['admin' => $product->user_id]) }}"> {{ optional($product->user)->name }} </a> </td>
							</tr>
							<tr>
								<th> @lang('products.status') </th>
								<td>
									@switch($product->active)
									@case(1)
									<span  class='badge badge-success'> @lang('products.active') </span>
									@break
									@case(0)
									<span  class='badge badge-danger'> @lang('products.inactive') </span>
									@break
									@endswitch
								</td>
							</tr>
							

							<tr>
								<th> @lang('products.name_ar') </th>
								<td> {{ $product->getTranslation('name' , 'ar') }} </td>
							</tr>
							<tr>
								<th> @lang('products.name_en') </th>
								<td> {{ $product->getTranslation('name' , 'en') }} </td>
							</tr>
							<tr>
								<th> @lang('products.category') </th>
								<td> {{ optional($product->category)->name }} </td>
							</tr>
							<tr>
								<th> @lang('products.brand') </th>
								<td> {{ optional($product->brand)->name }} </td>
							</tr>
							
							
							<tr>
								<th> @lang('products.mini_description_ar') </th>
								<td> {!! $product->getTranslation('mini_description' , 'ar') !!} </td>
							</tr>
							<tr>
								<th> @lang('products.mini_description_en') </th>
								<td> {!! $product->getTranslation('mini_description' , 'en') !!} </td>
							</tr>
							<tr>
								<th> @lang('products.description_ar') </th>
								<td> {!! $product->getTranslation('description' , 'ar') !!} </td>
							</tr>
							<tr>
								<th> @lang('products.description_en') </th>
								<td> {!! $product->getTranslation('description' , 'en') !!} </td>
							</tr>


							<tr>
								<th> سعر المنتج </th>
								<td> {{ $product->price }} </td>
							</tr>

							<tr>
								<th>السعر بعد الخصم </th>
								<td> {{  $product->price_after_discount }} </td>
							</tr>
							<tr>
								<th> نسبه الخصم </th>
								<td> {{ $product->discount_percentage }} </td>
							</tr>

							<tr>
								<th> عدد النقاط </th>
								<td> {{  $product->points }} </td>
							</tr>
							<tr>
								<th> الحد الادنى لللبيع بالجمله </th>
								<td> {{ $product->minimam_gomla_number }} </td>
							</tr>

							<tr>
								<th> الحد الادنى لللبيع بالجمله </th>
								<td> {{ $product->minimam_gomla_number }} </td>
							</tr>
							<tr>
								<th> الباركود </th>
								<td> {{ $product->barcode }} </td>
							</tr>
							<tr>
								<th> عدد مرات البيع </th>
								<td> {{ $product->sales_count }} </td>
							</tr>
							<tr>
								<th> مبلغ المسوق </th>
								<td> {{ $product->marketer_price }} </td>
							</tr>
							<tr>
								<th> تقيم المنتج </th>
								<td> {{ $product->rate }} </td>
							</tr>							
							<tr>
								<th> الكميات </th>
								<td>
									<ul>
										@foreach ($product->warehouses as $product_warehouse)
										<li> {{ $product_warehouse->warehouse?->name }} => {{ $product_warehouse->quantity }} قطعه</li>
										@endforeach
									</ul>
								</td>
							</tr>
							<tr>
								<th> @lang('products.image') </th>
								 <td> <a href="{{ Storage::url('products/'.$product->image) }}"> <img class='rounded img-preview' data-popup="lightbox" data-gallery="gallery1" src="{{ Storage::url('products/'.$product->image) }}" alt=""> </a> </td>
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
<script src="{{ Storage::url('dashboard_assets/global_assets/js/plugins/media/glightbox.min.js') }}"></script>
    <script src="{{ Storage::url('dashboard_assets/global_assets/js/demo_pages/gallery.js') }}"></script>

@endsection



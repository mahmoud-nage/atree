@extends('dashboard.layouts.master')

@section('page_title')
بيانات الطلب
@endsection

@section('page_header')
<a href="{{ route('dashboard.orders.index') }}" class="breadcrumb-item"><i class="icon-equalizer   mr-2"></i>
	الطلبات
</a>
<span class="breadcrumb-item active"> بيانات الطلب  </span>

@endsection
@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title"> {{__('site.order_info')}} </h5>
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
								<td> {{ $order->created_at->diffForHumans() }} -- {{ $order->created_at }} </td>
							</tr>
							<tr>
								<th>  {{__('site.status')}}  </th>
								<td> {{ $order->status?->name }} </td>
							</tr>
							<tr>
								<th> {{__('site.edit_status')}}   </th>
								<td>
									<form  action="{{ route('dashboard.orders.update' , $order ) }}" method='POST' >
										@csrf
										@method('PATCH')
										<select onchange="this.form.submit()" class='form-control' name="status_id" id="">
											@foreach ($statues as $statue)
											<option value="{{ $statue->id }}" {{ $statue->id == $order->shipping_statues_id ? 'selected="selected"' : '' }} > {{ $statue->name }} </option>
											@endforeach
										</select>
									</form>
								</td>
							</tr>
							<tr>
								<th> {{__('site.order_no')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('site.Username')}}  </th>
								<td> {{ $order->user?->name }} </td>
							</tr>
							<tr>
								<th> {{__('site.subtotal')}}   </th>
								<td> {{ $order->subtotal }}  {{__('site.SAR')}} </td>
							</tr>
							<tr>
								<th> {{__('site.total_after_discount')}}  </th>
								<td> {{ $order->total }}  جنيه </td>
							</tr>
							<tr>
								<th> {{__('site.delivery')}}  </th>
								<td> {{ $order->shipping_cost }}  جنيه </td>
							</tr>

							<tr>
								<th> {{__('site.governorate')}}  </th>
								<td> {{ $order->governorate?->name }} </td>
							</tr>

							<tr>
								<th> {{__('site.city')}}  </th>
								<td> {{ $order->city?->name }} </td>
							</tr>
							<tr>
								<th> {{__('site.address')}}  </th>
								<td> {{ $order->address }} </td>
							</tr>
							<tr>
								<th> {{__('site.phone')}}   </th>
								<td> {{ $order->order_phone }} </td>
							</tr>
							<tr>
								<th>  {{__('site.client_name')}}   </th>
								<td> {{ $order->client_name }} </td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title"> {{__('site.design_info')}} </h5>
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
								<th> {{__('site.type')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('site.text')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('products.site_front_width')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('products.site_front_height')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('products.site_front_left')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('products.site_front_top')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('products.site_back_width')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('products.site_back_height')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('products.site_back_left')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('products.site_back_top')}} </th>
								<td> {{ $order->number }} </td>
							</tr>

							<tr>
								<th> {{__('site.item_inner_top')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('site.item_inner_left')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('site.item_outer_top')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('site.item_outer_left')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('site.item_text_width')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('site.item_text_height')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('site.item_text_color')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('site.site_text_font_family')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('site.site_text_size')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('site.site_text_weight')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('site.site_text_type')}} </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> {{__('site.site_text_rotate')}} </th>
								<td> {{ $order->number }} </td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title">{{__('site.order_products')}} </h5>
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
						<thead>
							<tr>
								<th> # </th>
								<th> {{__('site.product')}}</th>
								<th> {{__('site.design_images')}} </th>
								<th> {{__('site.note')}} </th>
								<th> {{__('site.total_cost')}} </th>
								<th>  {{__('site.quantity')}} </th>
								<th> {{__('site.orders')}} </th>
							</tr>
						</thead>
						<tbody>
							@php
							$i = 1 ;
							@endphp
							@foreach ($order->items as $item)
							<tr>
								<td> {{ $i++ }} </td>
								<td> <a href="{{ route('dashboard.products.show' , $item->variation->product ) }}"> {{ $item->variation->product?->name }} </a> </td>
                                <td>
                                    <a target="_blank" href="{{ Storage::url('designs/'.$item->design_front_image) }}"><img class='rounded img-preview' data-popup="lightbox" data-gallery="gallery1" src="{{ Storage::url('designs/'.$item->design_front_image) }}" alt=""></a>
                                    <a target="_blank" href="{{ Storage::url('designs/'.$item->design_back_image) }}"><img class='rounded img-preview' data-popup="lightbox" data-gallery="gallery1" src="{{ Storage::url('designs/'.$item->design_back_image) }}" alt=""></a>
                                </td>
								<td>
									{{ $item->variation?->color?->name }} -- {{ $item->variation?->size?->name }}
								</td>
								<td> {{ $item->price }} <span class='text-muted' >{{__('site.SAR')}} </span> </td>
								<td> {{ $item->quantity }}   <span class='text-muted' >{{__('site.piece')}} </span>  </td>
								<td>  </td>
							</tr>
							@endforeach
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



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
					<h5 class="card-title"> بيانات الطلب </h5>
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
								<th> حاله الطلب   </th>
								<td> {{ $order->status?->name }} </td>
							</tr>
							<tr>
								<th> تعديل حاله الطلب   </th>
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
								<th> رقم الطلب </th>
								<td> {{ $order->number }} </td>
							</tr>
							<tr>
								<th> المستخدم  </th>
								<td> {{ $order->user?->name }} </td>
							</tr>
							<tr>
								<th> المبلغ hالفرعى   </th>
								<td> {{ $order->subtotal }}  جنيه </td>
							</tr>
							<tr>
								<th> المبلغ بعد الخصم  </th>
								<td> {{ $order->total }}  جنيه </td>
							</tr>
							<tr>
								<th> قيم الشحن  </th>
								<td> {{ $order->shipping_cost }}  جنيه </td>
							</tr>

							<tr>
								<th> المحافظه  </th>
								<td> {{ $order->governorate?->name }} </td>
							</tr>
							
							<tr>
								<th> المدنيه  </th>
								<td> {{ $order->city?->name }} </td>
							</tr>
							<tr>
								<th> العنوان  </th>
								<td> {{ $order->address }} </td>
							</tr>
							<tr>
								<th> رقم الجوال   </th>
								<td> {{ $order->order_phone }} </td>
							</tr>	
							<tr>
								<th>  اسم العميل   </th>
								<td> {{ $order->order_phone }} </td>
							</tr>		
							<tr>
								<th>  قيمه ربح المسوق   </th>
								<td> {{ $order->marketer_price() }} <span class="text-muted"> جنيه </span> </td>
							</tr>										
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-primary text-white header-elements-sm-inline" >
					<h5 class="card-title"> منتجات داخل اطلب </h5>
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
								<th> اسم المنتج </th>
								<th> تفاصيل </th>
								<th> سعر البيع </th>
								<th> الكميه </th>
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
									{{ $item->variation?->title }}
									@if ($item->variation->parent_id)
								 --	{{ $item->variation?->parent?->title }}
									@endif
								</td>
								<td> {{ $item->price }} <span class='text-muted' >جنيه </span> </td>
								<td> {{ $item->quantity }}   <span class='text-muted' >قطعه </span>  </td>
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



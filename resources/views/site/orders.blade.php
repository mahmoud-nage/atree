@php
    $lang = LaravelLocalization::getCurrentLocale();
    if ($lang == 'ar') {
      $dir = 'rtl';
    } else {
      $dir = 'ltr';
    }
@endphp

@extends('site.layouts.master')

@section('page_content')

    <div class="row">
        <div class="col-md-8">
            <!-- Order list Container -->
            <div class="category-container my-orders">
                @forelse($records as $record)
                    <!-- Order list item -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <div>
                                <p class="card-title">{{__('site.Order Date')}}</p>
                                <p class="font-weight-normal">{{date('d F Y', strtotime($record->created_at))}}</p>
                            </div>

                            <div>
                                <p class="card-title">{{__('site.total')}}</p>
                                <p class="font-weight-normal">{{$record->total}} <span> @lang('site.SAR') </span></p>
                            </div>

                            <div class="ml-auto">
                                <p class="font-weight-normal">{{__('site.Order #')}} {{$record->number}}</p>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="d-flex flex-fill row">
                                @foreach($record->items->take(4) as $item)
                                    <div class="category-left col-10 row">
                                        <div class="category-title col-12">
                                            <h4 class="card-title">{{$item->variation->product->name ?? ''}}</h4>
                                        </div>

                                        <div class="square-img col-2">
                                            @if($item->design_front_image)
                                                    <img
                                                        style="background-color: {{$item->design?->main_color_code}}"
                                                        src="{{Storage::url('products/'.$item->design?->image)}}">
                                                    <img class="img-fluid pad" alt="design"
                                                         src="{{Storage::url('designs/'.$item->design?->design_image_front)}}"
                                                         style="width: {{$item->design?->product->site_front_width}}%; height: {{$item->design?->product->site_front_height}}%; top: {{$item->design?->product->site_front_top}}%; left: {{$item->design?->product->site_front_left}}%;position: absolute;">
                                                <img
                                                    src="{{ Storage::url('designs/'.$item->design_front_image)}}">
                                            @else
                                                <img
                                                    style="background-color: {{$item->design?->main_color_code}}"
                                                    src="{{Storage::url('products/'.$item->design?->back_image)}}">
                                                <img class="img-fluid pad" alt="design"
                                                     src="{{Storage::url('designs/'.$item->design?->design_image_back)}}"
                                                     style="width: {{$item->design?->product->site_back_width}}%; height: {{$item->design?->product->site_back_height}}%;
                                                      top: {{$item->design?->product->site_back_top}}%; left: {{$item->design?->product->site_back_left}}%;position: absolute;">

                                            @endif
                                        </div>
                                        <div class="order-info col-8">
                                            <p class="card-text">
                                                {!! $item->variation->product->description?substr($item->variation->product->description,0, 200) : ''!!}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="buttons-container col-2">
                                    <a href="#" data-toggle="modal" data-target="#invoice-popup{{$record->id}}"
                                       class=" btn btn-primary">{{__('site.invoice')}}</a>
                                    <a href="{{route('track_order', $record->id)}}"
                                       class=" btn btn-primary">{{__('site.track_order')}}</a>
                                    @if($record->payment_method_id == 2)
                                        <a href="{{route('checkout.pay', $record->number)}}"
                                           class=" btn btn-primary">{{__('site.pay')}}</a>
                                    @endif
                                    {{--                                    <a href="#" class=" btn btn-primary">Buy Again</a>--}}
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="invoice-popup{{$record->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">

                                <div class="modal-body">

                                    <div class="invoice p-3 mb-3">

                                        <div class="row">
                                            <div class="invoice-top">
                                                <div>
                                                    <img src="{{ Storage::url('settings/'.$data['settings']->logo) }}"/>
                                                </div>

{{--                                                <div>--}}
{{--                                                    <img src="images/QR-code.png"/>--}}
{{--                                                </div>--}}
                                            </div>

                                            <!-- </div> -->

                                        </div>

                                        <div class="row invoice-info">
                                            <div class="invoice-col">
{{--                                                <b class="mr-2">Invoice Number:</b> #007612<br>--}}
                                                <b class="mr-2">{{__('site.Order #')}}:</b> {{$record->number}}<br>
{{--                                                <b class="mr-2">Payment Due:</b> 2/22/2014<br>--}}
                                                <b class="mr-2">{{__('site.user_requested')}}:</b> {{auth()->user()->name}}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 table-responsive">
                                                <table class="table mb-0">
                                                    <thead>
                                                    <tr class="bg-light font-weight-bold">
                                                        <th>#</th>
                                                        <th>{{__('site.product')}}</th>
                                                        <th>{{__('site.quantity')}}</th>
                                                        <th>{{__('site.sizes')}}</th>
                                                        <th>{{__('site.colors')}}</th>
                                                        <th>{{__('site.piece')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($record->items as $item)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$item->variation?->product?->name}}</td>
                                                            <td>{{$item->quantity}}</td>
                                                            <td>{{$item->variation?->size?->name}}</td>
                                                            <td>{{$item->variation?->color?->name}}</td>
                                                            <td>{{$item->price}} <span> @lang('site.SAR') </span></td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="bg-light font-weight-bold">
                                                        <th>{{__('site.sub_total')}}</th>
                                                        <td></td>
                                                        <th class="totalPrice">{{$record->subtotal}}
                                                            <span> @lang('site.SAR') </span></th>
                                                    </tr>
                                                    <tr class="bg-light font-weight-bold">
                                                        <th>{{__('site.discount')}}</th>
                                                        <td></td>
                                                        <th class="totalPrice">{{$record->discount}}
                                                            <span> @lang('site.SAR') </span></th>
                                                    </tr>
                                                    <tr class="bg-light font-weight-bold">
                                                        <th>{{__('site.shipping_price')}}</th>
                                                        <td></td>
                                                        <th class="totalPrice">{{$record->shipping_cost}}
                                                            <span> @lang('site.SAR') </span></th>
                                                    </tr>
                                                    <tr class="bg-light font-weight-bold">
                                                        <th>{{__('site.vat')}}</th>
                                                        <td></td>
                                                        <th class="totalPrice">{{$record->vat}}
                                                            <span> @lang('site.SAR') </span></th>
                                                    </tr>
                                                    <tr class="bg-light font-weight-bold">
                                                        <th>{{__('site.total')}}</th>
                                                        <td></td>
                                                        <th class="totalPrice">{{$record->total}}
                                                            <span> @lang('site.SAR') </span></th>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class="modal-footer">
{{--                                    <button type="button" class="btn btn-primary">Save As PDF</button>--}}
                                    <button type="button" class="btn btn-primary">{{__('site.Print')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-primary" role="alert">
                        @lang('site.No orders yet for you to display')
                    </div>
                @endforelse
            </div>
            <!-- /.card-body -->
        </div>
        <!-- Right side -->
        @include('site.layouts.sidebar_left2')
    </div>
@endsection



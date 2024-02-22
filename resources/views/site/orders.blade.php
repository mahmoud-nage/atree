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
                                <p class="card-title">Order Placed</p>
                                <p class="font-weight-normal">{{date('d F Y', strtotime($record->created_at))}}</p>
                            </div>

                            <div>
                                <p class="card-title">Total</p>
                                <p class="font-weight-normal">{{$record->total}} <span> @lang('site.SAR') </span></p>
                            </div>


                            <div class="ml-auto">
                                <p class="font-weight-normal">Order #{{$record->number}}</p>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="d-flex flex-fill">
                                @foreach($record->items->take(4) as $item)
                                    <div class="category-left">
                                        <div class="category-title">
                                            <h4 class="card-title">{{$item->variation->product->name ?? ''}}</h4>
                                        </div>

                                        <div class="square-img d-table-cell">
                                            @if($item->design_front_image)
                                                <img
                                                    src="{{ Storage::url('designs/'.$item->design_front_image)}}">
                                            @else
                                                <img
                                                    src="{{ Storage::url('products/'.$item?->variation?->product->front_image)}}">
                                            @endif
                                        </div>
                                        <div class="order-info">
                                            <p class="card-text">
                                                {!! $item->variation->product->description ?? ''!!}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="buttons-container">
                                    <a href="#" data-toggle="modal" data-target="#invoice-popup"
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
    <!-- Invoice Modal -->
    <div class="modal fade" id="invoice-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

                                <div>
                                    <img src="images/QR-code.png"/>
                                </div>
                            </div>

                            <!-- </div> -->

                        </div>

                        <div class="row invoice-info">
                            <div class="invoice-col">
                                <b class="mr-2">Invoice Number:</b> #007612<br>
                                <b class="mr-2">Order ID:</b> {{$record->number}}<br>
                                <b class="mr-2">Payment Due:</b> 2/22/2014<br>
                                <b class="mr-2">Account:</b> {{auth()->user()->username}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                    <tr class="bg-light font-weight-bold">
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Size</th>
                                        <th>Colors</th>
                                        <th>Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($record->items as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->variation?->product->name}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{$item->variation?->size->name}}</td>
                                            <td>{{$item->variation?->color->name}}</td>
                                            <td>{{$item->price}} <span> @lang('site.SAR') </span></td>
                                        </tr>
                                    @endforeach
                                    <tr class="bg-light font-weight-bold">
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Total Price</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="totalPrice">{{$record->total}} <span> @lang('site.SAR') </span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save As PDF</button>
                    <button type="button" class="btn btn-primary">Print</button>
                </div>
            </div>
        </div>
    </div>
@endsection



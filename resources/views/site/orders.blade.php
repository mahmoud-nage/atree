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

                                <div class="category-left">
                                    <div class="category-title">
                                        <h4 class="card-title">{{$record->items->first()->variation->product->name ?? ''}}</h4>
                                    </div>

                                    <div class="square-img d-table-cell">
                                        <img src="{{$record->items->first()->variation->product->front_image ?? ''}}">
                                    </div>

                                    <div class="order-info">
                                        <p class="card-text">
                                            {!! $record->items->first()->variation->product->description ?? ''!!}
                                        </p>
                                    </div>

                                </div>

                                <div class="buttons-container">
                                    <a href="#" data-toggle="modal" data-target="#invoice-popup"
                                       class=" btn btn-primary">Invoice</a>
                                    <a href="{{route('track_order', $record->id)}}" class=" btn btn-primary">Track Order</a>
                                    <a href="#" class=" btn btn-primary">Buy Again</a>
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
                                    <img src="images/large-logo.png" />
                                </div>

                                <div>
                                    <img src="images/QR-code.png" />
                                </div>
                            </div>

                            <!-- </div> -->

                        </div>

                        <div class="row invoice-info">

                            <div class="col-sm-4 invoice-col">
                                <b class="mr-2">Invoice Number:</b>  #007612<br>
                                <b class="mr-2">Order ID:</b> 4F3S8J<br>
                                <b class="mr-2">Payment Due:</b> 2/22/2014<br>
                                <b class="mr-2">Account:</b> 968-34567
                            </div>

                            <div class="col-sm-4 invoice-col">
                            </div>

                            <div class="col-sm-4 invoice-col">
                                <b class="mr-2">Invoice</b> #007612<br>
                                <b class="mr-2">Order ID:</b> 4F3S8J<br>
                                <b class="mr-2">Payment Due:</b> 2/22/2014<br>
                                <b class="mr-2">Account:</b> 968-34567
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                    <tr class="bg-light font-weight-bold">
                                        <th>Product Name</th>
                                        <th>Quantaity</th>
                                        <th>Size</th>
                                        <th>Colors</th>
                                        <th>Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Call of Duty</td>
                                        <td>455-981-221</td>
                                        <td>Red</td>
                                        <td>$64.50</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <p>Need for Speed IV</p>
                                            <p>Need for Speed IV</p>
                                        </td>
                                        <td>247-925-726</td>
                                        <td>Wes Anderson umami biodiesel</td>
                                        <td>$50.00</td>
                                    </tr>

                                    <tr class="bg-light font-weight-bold">
                                        <th> </th>
                                        <th> </th>
                                        <th> </th>
                                        <th>Colors</th>
                                        <th>Price</th>
                                    </tr>

                                    <tr>
                                        <td>1</td>
                                        <td>Monsters DVD</td>
                                        <td>735-845-642</td>
                                        <td>Terry Richardson</td>
                                        <td>$10.70</td>
                                    </tr>


                                    <tr class="bg-light font-weight-bold">
                                        <th> </th>
                                        <th> </th>
                                        <th> </th>
                                        <th></th>
                                        <th>Total Price</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="totalPrice">900 SAR</td>
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



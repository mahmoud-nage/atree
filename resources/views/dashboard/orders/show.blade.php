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
                    <div class="card-header bg-primary text-white header-elements-sm-inline">
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
                                    <form action="{{ route('dashboard.orders.update' , $order ) }}" method='POST'>
                                        @csrf
                                        @method('PATCH')
                                        <select onchange="this.form.submit()" class='form-control' name="status_id"
                                                id="">
                                            @foreach ($statues as $statue)
                                                <option
                                                    value="{{ $statue->id }}" {{ $statue->id == $order->shipping_statues_id ? 'selected="selected"' : '' }} > {{ $statue->name }} </option>
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
                                <td> {{ $order->total }}  {{__('site.SAR')}} </td>
                            </tr>
                            <tr>
                                <th> {{__('site.delivery')}}  </th>
                                <td> {{ $order->shipping_cost }}  {{__('site.SAR')}} </td>
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
                    <div class="card-header bg-primary text-white header-elements-sm-inline">
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
                                <th> #</th>
                                <th> {{__('site.product')}}</th>
                                <th> {{__('site.design_image_front')}} </th>
                                <th> {{__('site.design_image_back')}} </th>
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
                                    <td>
                                        <a href="{{ route('dashboard.products.show' , $item->variation->product ) }}"> {{ $item->variation->product?->name }} </a>
                                    </td>
                                    <td>
                                        <div style="background-image: url('{{Storage::url('products/'.$item?->design?->image)}}');background-color: {{$item?->design?->main_color_code}}; background-position: center; position: relative;height: 13rem;background-size: cover;background-repeat: no-repeat;
    ">
                                            @if($item?->design?->design_image_front)
                                                <img class="img-fluid" alt="design"
                                                     src="{{Storage::url('designs/'.$item?->design?->design_image_front)}}"
                                                     style="width: {{$item?->design?->product?->site_front_width}}%; height: {{$item?->design?->product?->site_front_height}}%; top: {{$item?->design?->product?->site_front_top}}%; left: {{$item?->design?->product?->site_front_left}}%;position: absolute;">
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div style="background-image: url('{{Storage::url('products/'.$item?->design?->back_image)}}');background-color: {{$item?->design?->main_color_code}}; background-position: center; position: relative;height: 13rem;background-size: cover;background-repeat: no-repeat;
    ">
                                            @if($item?->design?->design_image_back)
                                                <img class="img-fluid" alt="design"
                                                     src="{{Storage::url('designs/'.$item?->design?->design_image_back)}}"
                                                     style="width: {{$item?->design?->product?->site_back_width}}%; height: {{$item?->design?->product?->site_back_height}}%; top: {{$item?->design?->product?->site_back_top}}%; left: {{$item?->design?->product?->site_back_left}}%;position: absolute;">
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        {{ $item->variation?->color?->name }} - {{ $item->variation?->size?->name }}
                                    </td>
                                    <td> {{ $item->price }} <span class='text-muted'>{{__('site.SAR')}} </span></td>
                                    <td> {{ $item->quantity }} <span class='text-muted'>{{__('site.piece')}} </span>
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn-primary" data-toggle="modal"
                                           data-target="#exampleModalCenter">
                                            {{__('site.front')}}
                                        </a>
                                        <a type="button" class="btn btn-primary" data-toggle="modal"
                                           data-target="#exampleModalCenterBack">
                                            {{__('site.back')}}
                                        </a>
                                    </td>

                                    <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="exampleModalLongTitle">{{__('site.design_info')}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                        <div
                                                            class="card-header bg-primary text-white header-elements-sm-inline">
                                                            <h5 class="card-title"> {{__('site.product_info')}} </h5>
                                                        </div>
                                                        <div class="card-body row">
                                                            <div class="col-md-6 ml-auto">
                                                                <div class="col-md-12 ml-auto">
                                                                    <div style="background-image: url('{{Storage::url('products/'.$item?->design?->image)}}');background-color: {{$item?->design?->main_color_code}}; background-position: center; position: relative;height: 27rem;background-size: cover;background-repeat: no-repeat;
    ">
                                                                        @if($item?->design?->design_image_front)
                                                                            <img class="img-fluid" alt="design"
                                                                                 src="{{Storage::url('designs/'.$item?->design?->design_image_front)}}"
                                                                                 style="width: {{$item?->design?->product?->site_front_width}}%; height: {{$item?->design?->product?->site_front_height}}%; top: {{$item?->design?->product?->site_front_top}}%; left: {{$item?->design?->product?->site_front_left}}%;position: absolute;">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 ml-auto row text-center">
                                                                <div
                                                                    class="col-md-6 ml-auto"> {{__('products.site_front_width')}} </div>
                                                                <div
                                                                    class="col-md-6 ml-auto"> {{ $item->variation->product?->site_front_width }}
                                                                    %
                                                                </div>

                                                                <div
                                                                    class="col-md-6 ml-auto"> {{__('products.site_front_height')}} </div>
                                                                <div
                                                                    class="col-md-6 ml-auto"> {{ $item->variation->product?->site_front_height }}
                                                                    %
                                                                </div>

                                                                <div
                                                                    class="col-md-6 ml-auto"> {{__('products.site_front_left')}} </div>
                                                                <div
                                                                    class="col-md-6 ml-auto"> {{ $item->variation->product?->site_front_left }}
                                                                    %
                                                                </div>

                                                                <div
                                                                    class="col-md-6 ml-auto"> {{__('products.site_front_top')}} </div>
                                                                <div
                                                                    class="col-md-6 ml-auto"> {{ $item->variation->product?->site_front_top }}
                                                                    %
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    @if($item->details)
                                                        @foreach ($item->details as $details)
                                                            <div class="card">
                                                                <div
                                                                    class="card-header bg-info text-white header-elements-sm-inline">
                                                                    <h5 class="card-title"> {{__('site.items_info')}} </h5>
                                                                </div>
                                                                @if($details['type'] == 'text')
                                                                    <div class="card-body row text-center">
                                                                        <div
                                                                            class="col-md-3 ml-auto"> {{__('site.text')}} </div>
                                                                        <div
                                                                            class="col-md-3 ml-auto"> {{ $details['content'] }} </div>

                                                                        <div
                                                                            class="col-md-3 ml-auto"> {{__('site.item_text_color')}} </div>
                                                                        <div
                                                                            class="col-md-3 ml-auto"> {{ $details['color'] }} </div>

                                                                        <div
                                                                            class="col-md-3 ml-auto"> {{__('site.site_text_font_family')}} </div>
                                                                        <div
                                                                            class="col-md-3 ml-auto"> {{ $details['font_family'] }} </div>

                                                                        <div
                                                                            class="col-md-3 ml-auto"> {{__('site.site_text_size')}} </div>
                                                                        <div
                                                                            class="col-md-3 ml-auto"> {{ $details['size'] }} </div>

                                                                        <div
                                                                            class="col-md-3 ml-auto"> {{__('site.site_text_weight')}} </div>
                                                                        <div
                                                                            class="col-md-3 ml-auto"> {{ $details['weight'] }} </div>
                                                                    </div>
                                                                @else
                                                                    <div class="card-body row">
                                                                        <div
                                                                            class="col-md-6 ml-auto"> {{__('site.image')}} </div>
                                                                        <div
                                                                            class="col-md-6 ml-auto"><img alt="img"
                                                                                                          class="img-fluid"
                                                                                                          src="{{ $details['content'] }}">
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade bd-example-modal-lg" id="exampleModalCenterBack"
                                         tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="exampleModalLongTitle">{{__('site.design_info')}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                        <div
                                                            class="card-header bg-primary text-white header-elements-sm-inline">
                                                            <h5 class="card-title"> {{__('site.product_info')}} </h5>
                                                        </div>
                                                        <div class="card-body row">
                                                            <div class="col-md-6 ml-auto">
                                                                <div class="col-md-12 ml-auto">
                                                                    <div
                                                                        style="background-image: url('{{Storage::url('products/'.$item?->design?->back_image)}}');background-color: {{$item?->design?->main_color_code}}; background-position: center; position: relative;height: 27rem;background-size: cover;background-repeat: no-repeat;">
                                                                        @if($item?->design?->design_image_back)
                                                                            <img class=" img-fluid
                                                                    " alt="design"
                                                                                 src="{{Storage::url('designs/'.$item?->design?->design_image_back)}}
                                                                    "
                                                                                 style="width: {{$item?->design?->product?->site_back_width}}
                                                                    %;
                                                                    height: {{$item?->design?->product?->site_back_height}}
                                                                    %; top: {{$item?->design?->product?->site_back_top}}
                                                                    %;
                                                                    left: {{$item?->design?->product?->site_back_left}}
                                                                    %;position: absolute;">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 ml-auto row text-center">
                                                                <div
                                                                    class="col-md-6 ml-auto"> {{__('products.site_back_width')}} </div>
                                                                <div
                                                                    class="col-md-6 ml-auto"> {{ $item->variation->product?->site_back_width }}
                                                                    %
                                                                </div>

                                                                <div
                                                                    class="col-md-6 ml-auto"> {{__('products.site_back_height')}} </div>
                                                                <div
                                                                    class="col-md-6 ml-auto"> {{ $item->variation->product?->site_back_height }}
                                                                    %
                                                                </div>

                                                                <div
                                                                    class="col-md-6 ml-auto"> {{__('products.site_back_left')}} </div>
                                                                <div
                                                                    class="col-md-6 ml-auto"> {{ $item->variation->product?->site_back_left }}
                                                                    %
                                                                </div>

                                                                <div
                                                                    class="col-md-6 ml-auto"> {{__('products.site_back_top')}} </div>
                                                                <div
                                                                    class="col-md-6 ml-auto"> {{ $item->variation->product?->site_back_top }}
                                                                    %
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    @if($item->details_back)
                                                        @foreach ($item->details_back as $details)
                                                            <div class="card">
                                                                <div
                                                                    class="card-header bg-info text-white header-elements-sm-inline">
                                                                    <h5 class="card-title"> {{__('site.items_info')}} </h5>
                                                                </div>
                                                                @if($details['type'] == 'text')
                                                                    <div class="card-body row text-center">
                                                                        <div
                                                                            class="col-md-3 ml-auto"> {{__('site.text')}} </div>
                                                                        <div
                                                                            class="col-md-3 ml-auto"> {{ $details['content'] }} </div>

                                                                        <div
                                                                            class="col-md-3 ml-auto"> {{__('site.item_text_color')}} </div>
                                                                        <div
                                                                            class="col-md-3 ml-auto"> {{ $details['color'] }} </div>

                                                                        <div
                                                                            class="col-md-3 ml-auto"> {{__('site.site_text_font_family')}} </div>
                                                                        <div
                                                                            class="col-md-3 ml-auto"> {{ $details['font_family'] }} </div>

                                                                        <div
                                                                            class="col-md-3 ml-auto"> {{__('site.site_text_size')}} </div>
                                                                        <div
                                                                            class="col-md-3 ml-auto"> {{ $details['size'] }} </div>

                                                                        <div
                                                                            class="col-md-3 ml-auto"> {{__('site.site_text_weight')}} </div>
                                                                        <div
                                                                            class="col-md-3 ml-auto"> {{ $details['weight'] }} </div>
                                                                    </div>
                                                                @else
                                                                    <div class="card-body row">
                                                                        <div
                                                                            class="col-md-6 ml-auto"> {{__('site.image')}} </div>
                                                                        <div
                                                                            class="col-md-6 ml-auto"><img alt="img"
                                                                                                          class="img-fluid"
                                                                                                          src="{{ $details['content'] }}">
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <hr>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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



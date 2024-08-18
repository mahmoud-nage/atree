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
        <div class="col-md-9">
            @forelse($records as $record)
                <div class="card card-widget">
                    <div class="card-header">
                        <div class="user-block">
                            <img class="img-circle" src="{{ Storage::url('users/'.$record->user->image) ?? '' }}"
                                 alt="User Image">
                            <span class="username"><a
                                    href="{{$record->user->url() ?? ''}}">{{$record->user->name() ?? ''}}</a></span>
                            <span class="description">@ {{$record->user->username ?? ''}}</span>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a
                                onclick="goToDesignPage({{$record}})"
                                {{--                                        href="{{ route('custom-designs', $record->id).'?type=design' }}"--}}
                                data-image="{{ Storage::url('products/'.$record->product->front_image) }}"
                                {{--                                onclick="changeNewDesignProduct('card-product{{$record->id}}')"--}}
                                class="text-center post-image-container">
                                <div class="badge badge-light">
                                    @if($record->design_image_front && $record->design_image_back)
                                        {{$record->product->price_full_design}}
                                    @else
                                        {{$record->product->price}}
                                    @endif
                                    <span>{{__('site.SAR')}}</span>
                                </div>
                                <div style="position: relative; direction: ltr">
                                    {{--                        <div class="badge badge-light">200 <span>SAR</span></div>--}}
                                    <img class="img-fluid pad"
                                         style="background-color: {{$record->main_color_code}}"
                                         src="{{Storage::url('products/'.$record->product->front_image)}}"
                                         alt="Photo">
                                    <img class="img-fluid pad" alt="design"
                                         src="{{Storage::url('designs/'.$record->design_image_front)}}"
                                         style="width: {{$record->product->site_front_width}}%; height: {{$record->product->site_front_height}}%; top: {{$record->product->site_front_top}}%; left: {{$record->product->site_front_left}}%;position: absolute;">
                                </div>
                            </a>
                            <p>{{$record->description}}</p>
                            <div class="tag-btns-container">
                                <ul>
                                    @foreach($record->products as $product)
                                        <a href="{{ route('designs').'?product_id='.$product->id }}"
                                           class="btn tag-btn"> {{$product->name}} </a>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-primary" role="alert">
                    @lang('site.no_records')
                </div>
            @endforelse
        </div>
        <!-- /.col -->
        @include('site.layouts.sidebar_left')
    </div>
    <!-- /.row -->
@endsection

@section('scripts')
    <!----------- Slider Scripts --------->
    <script>
        function goToDesignPage(newProduct) {
            const product =
                {
                    id: "1",
                    front: {
                        boundaryBox: {
                            top: newProduct['product']['site_front_top'] + '%',
                            left: newProduct['product']['site_front_left'] + '%',
                            width: newProduct['product']['site_front_width'] + '%',
                            height: newProduct['product']['site_front_height'] + '%',
                        },
                        boundaryBoxChildren: [],
                        "name": "T-shirt",
                        "price": 200,
                        "currency": "SAR",
                        "frontImage": '/storage/products/' + newProduct['product']['front_image'],
                    }, back: {
                        boundaryBox: {
                            top: newProduct['product']['site_back_top'] + '%',
                            left: newProduct['product']['site_back_left'] + '%',
                            width: newProduct['product']['site_back_width'] + '%',
                            height: newProduct['product']['site_back_height'] + '%',
                        },
                        boundaryBoxChildren: [],
                        "name": "T-shirt",
                        "price": 200,
                        "currency": "SAR",
                        "backImage": '/storage/products/' + newProduct['product']['back_image'],
                        "colors": [
                            {"color": "black", "image": "img/color-1.jpg"},
                            {"color": "#darkblue", "image": "img/color-3.jpg"},
                            {"color": "#fcdb86", "image": "img/color-2.jpg"}
                        ]
                    }
                }
            const productJSON = JSON.stringify(product);
            localStorage.setItem('product', productJSON);
            let url = '{{ route('custom-designs', 'id').'?type=design' }}';
            url = url.replace("id", newProduct['id']);
            window.location.href = url;
        }
    </script>
@endsection

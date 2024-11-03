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

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">


                    <ul class="nav nav-tabs Explore-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="Products-tab" data-toggle="tab" data-target="#Products"
                                    type="button" role="tab" aria-controls="Products"
                                    aria-selected="true"> @lang('site.Products') </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="Artistes-tab" data-toggle="tab" data-target="#Artistes"
                                    type="button" role="tab" aria-controls="Artistes"
                                    aria-selected="false"> @lang('site.Artistes') </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="Designes-tab" data-toggle="tab" data-target="#Designes"
                                    type="button" role="tab" aria-controls="Designes"
                                    aria-selected="true"> @lang('site.Designes') </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">

                        <!-------------------------- Products Tab --------------------------->
                        <div class="tab-pane fade py-3 show active" id="Products" role="tabpanel"
                             aria-labelledby="Products-tab">

                            <!-------------------------- Best Selling --------------------------->


                            <!-------------------------- Products List --------------------------->
                            <div class="section Products-list">
                                <div class="title d-flex justify-content-between col-md-12">
                                    <h5 class="mb-2"> @lang('site.Best Selling Products') </h5>
                                    <a href="{{ route('products') }}" class="text-sm text-dark"> @lang('site.More') </a>
                                </div>

                                <ul class="users-list clearfix">
                                    @foreach ($products as $product)
                                        <li>
                                            <div class="product-container">
                                                <a href="{{ $product->url() }}" class="image-container"
                                                   data-image="{{ Storage::url('products/'.$product->front_image) }}">
                                                    <div class="card-front" id="0-card-front{{$product->id}}"
                                                         style="background-image: url('{{ Storage::url('products/'.$product->front_image) }}');background-color:{{$product->variations->unique('color_id')->first()->color->code??'#fff'}}; background-size: contain; background-position: center; background-repeat: no-repeat;">
                                                    </div>
                                                    <div class="card-back" id="0-card-back{{$product->id}}"
                                                         style="position: relative; background-image: url('{{ Storage::url('products/'.$product->back_image) }}');background-color:{{$product->variations->unique('color_id')->first()->color->code??'#fff'}}; background-size: contain; background-position: center; background-repeat: no-repeat;">
                                                    </div>
                                                </a>
                                                <ul class="color-list">
                                                    @foreach ($product->variations->unique('color_id') as $record_color_variation)
                                                        <li class="color-item"
                                                            onmouseover="changeCardColor('{{$record_color_variation->color->code}}','0-card-front{{$product->id}}')"
                                                            onmouseleave="changeCardColor('rgb(255, 250, 255)','0-card-front{{$product->id}}')"
                                                            style="background:{{$record_color_variation->color->code}}" data-image="img/color-1.jpg"
                                                            id="color-Button"></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <a class="users-list-name"
                                               href="{{ $product->url() }}">{{ $product->name }}</a>
                                            <div class="users-list-date"> {{ $product->price }}
                                                <span> @lang('site.SAR')</span></div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-------------------------- Artistes Tab --------------------------->
                        <div class="tab-pane fade py-3" id="Artistes" role="tabpanel" aria-labelledby="Artistes-tab">
                            @foreach ($users as $user)
                                <div class="card artest-card">
                                    <div class="card-body">
                                        <div class="img-container">
                                            <img src="{{ Storage::url('users/'.$user->image) }}"
                                                 alt="{{$user->name()}}">
                                        </div>

                                        <h5 class="card-title text-truncate">{{ $user->name() }}</h5>
                                        <a href='{{ $user->url() }}'
                                           class="card-text text-truncate"> @lang('site.Profile') </a>
                                    </div>
                                    <div class="card-footer">
                                        @livewire('site.follow-user' , ['designer' => $user ] , key($user->id) )
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="tab-pane fade py-3" id="Designes" role="tabpanel" aria-labelledby="Designes-tab">
                            @forelse($designs as $record)
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
                                                class="text-center post-image-container d-flex justify-content-around">
                                                <div class="badge badge-light">
                                                    @if($record->design_image_front && $record->design_image_back)
                                                        {{$record->product->price_full_design}}
                                                    @else
                                                        {{$record->product->price}}
                                                    @endif
                                                    <span>{{__('site.SAR')}}</span>
                                                </div>
                                                <div style="position: relative; direction: ltr;max-width: 500px">
                                                    {{--                        <div class="badge badge-light">200 <span>SAR</span></div>--}}
                                                    <img class="img-fluid pad"
                                                         style="background-color: {{$record->main_color_code}}"
                                                         src="{{Storage::url('products/'.$record->product->front_image)}}"
                                                         alt="Photo">
                                                    <img class="img-fluid pad" alt="design"
                                                         src="{{Storage::url('designs/'.$record->design_image_front)}}"
                                                         style="width: {{$record->product->site_front_width}}% !important; height: {{$record->product->site_front_height}}% !important;
                                                          top: {{$record->product->site_front_top}}% !important; left: {{$record->product->site_front_left}}% !important;
                                                          position: absolute;">
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
                    </div>
                </div>
                <!-- /.col -->
                @include('site.layouts.sidebar_left')
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
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

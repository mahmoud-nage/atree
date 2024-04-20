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
            <!-------------------------- Best Selling --------------------------->
            <div class="section best-selling">
                <div class="title d-flex justify-content-between col-md-12">
                    <h5 class="mb-2">@lang('site.Best Selling Products')</h5>
                </div>

                <ul class="users-list clearfix">
                    @foreach ($best_sellings as $product)
                    <li>
                        <a href="{{ $product->url() }}">
                            <div class="image-container">
                                <img src="{{ Storage::url('products/'.$product->front_image) }}" alt="{{ $product->name }}">
                            </div>
                            <div class="users-list-name" href="#">{{ $product->name }}</div>
                            <div class="users-list-date">{{ $product->price }} <span>@lang('site.SAR')</span></div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-------------------------- Products List --------------------------->
            <div class="section Products-list">
                <div class="title d-flex justify-content-between col-md-12">
                    <h5 class="mb-2"> @lang('site.Products')</h5>
                </div>
                <ul class="users-list clearfix">
                    @foreach ($products as $product)
                        <li>
                            <div class="product-container">
                                <a href="{{ $product->url() }}" class="image-container"
                                   data-image="{{ Storage::url('products/'.$product->front_image) }}">
                                    <div class="card-front"><img
                                            src="{{ Storage::url('products/'.$product->front_image) }}"/>
                                    </div>
                                    <div class="card-back"><img
                                            src="{{ Storage::url('products/'.$product->back_image) }}"/>
                                    </div>
                                </a>
                                <ul class="color-list">
                                    @foreach ($product->variations->unique('color_id') as $prodict_color_variate)
                                        <li class="color-item"
                                            style="background:{{ $prodict_color_variate->color?->code }}"></li>
                                    @endforeach

                                </ul>
                            </div>
                            <a class="users-list-name" href="{{ $product->url() }}">{{ $product->name }}</a>
                            <div class="users-list-date"> {{ $product->price }}
                                <span> @lang('site.SAR')</span></div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- /.col -->
        @include('site.layouts.sidebar_left')
    </div>
    <!-- /.row -->
@endsection

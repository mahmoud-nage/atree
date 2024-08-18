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
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach ($slides as $slide)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}"
                            class="{{ $loop->index == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach ($slides as $slide)
                        <a href="{{ $slide->link }}" class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                            <img class="d-block w-100" src="{{ Storage::url('slides/'.$slide->image) }}"
                                 alt="First slide">
                        </a>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-custom-icon" aria-hidden="true">
          <i class="fas fa-chevron-left"></i>
        </span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-custom-icon" aria-hidden="true">
          <i class="fas fa-chevron-right"></i>
        </span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- /.card -->
            <!-------------------------- Heigh Recomanded Designers --------------------------->
            <div class="section home-users">
                <div class="title col-md-12">
                    <h5 class="mb-2"> @lang('site.Heigh Recomanded Designers') </h5>
                </div>

                <ul class="users-list clearfix">
                    @foreach ($recomanded_users as $user)
                        <li>
                            <a href="{{ route('users.show' , $user ) }}">
                                <div class="image-container">
                                    <img src="{{ Storage::url('users/'.$user->image) }}" alt="{{ $user->name() }}">
                                </div>
                                <div class="users-list-name"> {{ $user->name() }} </div>
                            </a>
                        </li>
                    @endforeach
                </ul>

            </div>
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
                                         style="background-image: url('{{ Storage::url('products/'.$product->front_image) }}');background-color:{{$product->variations->unique('color_id')->first()->color->color??'#fff'}}; background-size: contain; background-position: center; background-repeat: no-repeat;">
                                    </div>
                                    <div class="card-back" id="0-card-back{{$product->id}}"
                                         style="position: relative; background-image: url('{{ Storage::url('products/'.$product->back_image) }}');background-color:{{$product->variations->unique('color_id')->first()->color->color??'#fff'}}; background-size: contain; background-position: center; background-repeat: no-repeat;">
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
                            <a class="users-list-name" href="{{ $product->url() }}">{{ $product->name }}</a>
                            <div class="users-list-date"> {{ $product->price }} <span> @lang('site.SAR')</span></div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-------------------------- Posts List --------------------------->
            @foreach($designs as $record)
                <div class="card card-widget">
                    <div class="card-header">
                        <div class="user-block">
                            <img class="img-circle" src="{{ Storage::url('users/'.$record->user->image) ?? '' }}"
                                 alt="User Image">
                            <span class="username"><a
                                    href="{{$record->user->url() ?? ''}}">{{$record->user->name() ?? ''}}</a></span>
                            <span class="description">@ {{$record->user->username ?? ''}}</span>
                        </div>
                        <!-- /.user-block -->
                        <div class="card-tools">
                            <span class="text-muted p-4"></span>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
{{--                        <a href="{{ route('custom-designs', $record->id).'?type=design' }}" class="text-center post-image-container">--}}
                            {{--                        <div class="badge badge-light">200 <span>SAR</span></div>--}}
{{--                            <img class="img-fluid pad" style="background-color: {{$record->main_color_code}}" src="{{Storage::url('designs/'.$record->image)}}" alt="Photo">--}}
                            <a href="{{ route('custom-designs', $record->id).'?type=design' }}"
                               class="text-center post-image-container">
                                {{--                        <div class="badge badge-light">200 <span>SAR</span></div>--}}
                                <img class="img-fluid pad"
                                     style="background-color: {{$record->main_color_code}}"
                                     src="{{Storage::url('products/'.$record->image)}}" alt="Photo">
                            </a>
                            <img class="img-fluid pad" alt="design"
                                 src="{{Storage::url('designs/'.$record->design_image_front)}}"
                                 style="width:50px;height:50px;z-index:156445;top: 50%;left: 50%;position: absolute;">
{{--                        </a>--}}

                        <p>{{$record->description}}</p>
                        <div class="tag-btns-container">
                            <ul>
                                @foreach($record->products as $product)
                                    <a href="{{ $product->url() }}" class="btn tag-btn"> {{$product->name}} </a>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
        <!-- /.col -->
        @include('site.layouts.sidebar_left')
    </div>
@endsection
@section('scripts')
@endsection

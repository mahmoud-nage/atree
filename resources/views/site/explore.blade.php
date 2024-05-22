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
                                                            style="background:{{ $prodict_color_variate->color?->code }}"
                                                            ></li>
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
                                        <!-- /.user-block -->
                                        <div class="card-tools">
                                            <span class="text-muted p-4"></span>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <a href="#" class="text-center post-image-container">
                                            {{--                        <div class="badge badge-light">200 <span>SAR</span></div>--}}
                                            <img class="img-fluid pad" style="background-color: {{$record->main_color_code}}"  src="{{Storage::url('designs/'.$record->image)}}" alt="Photo">
                                        </a>

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

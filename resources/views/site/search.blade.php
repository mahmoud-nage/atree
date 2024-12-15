@extends('site.layouts.master')
@section('page_content')

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
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade py-3 show active" id="Products" role="tabpanel"
                     aria-labelledby="Products-tab">
                    <div class="section Products-list">
                        <div class="title d-flex justify-content-between col-md-12">
                            <h5 class="mb-2"> @lang('site.Search For') : {{ $search }} </h5>
                        </div>
                        <ul class="users-list clearfix">
                            @forelse ($products as $product)
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
                                                    onmouseleave="changeCardColor('{{$product->variations->unique('color_id')->first()->color->code??'#fff'}}','0-card-front{{$product->id}}')"
                                                    style="background:{{$record_color_variation->color->code}}"
                                                    data-image="img/color-1.jpg"
                                                    id="color-Button"></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <a class="users-list-name" href="{{ $product->url() }}">{{ $product->name }}</a>
                                    <div class="users-list-date"> {{ $product->price }} <span> @lang('site.SAR')</span>
                                    </div>
                                </li>
                            @empty
                                <div class="alert alert-primary col-12 text-center" role="alert">
                                    @lang('site.no_records')
                                </div>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="tab-pane fade py-3" id="Artistes" role="tabpanel" aria-labelledby="Artistes-tab">
                    @forelse($users as $user)
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
                    @empty
                        <div class="alert alert-primary col-12 text-center" role="alert">
                            @lang('site.no_records')
                        </div>
                    @endforelse
                </div>
            </div>


        </div>
        <!-- /.col -->

        @include('site.layouts.sidebar_left')

    </div>
@endsection


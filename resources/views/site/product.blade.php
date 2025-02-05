@extends('site.layouts.master')
@section('styles')
    {{--    <link rel="stylesheet" href="{{ Storage::url('site_assets/css/slick-theme.css') }}">--}}
@endsection
@section('page_content')
    <div class="content-wrapper pt-3">
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card-solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9 col-sm-6">
                            <div class="row">
                                <div class="col-3 product-image-thumbs flex-column">
                                    <div class="product-image-thumb active"><img
                                            src="{{ Storage::url('products/'.$product->front_image) }}"
                                            alt="Product Image"></div>
                                    @foreach ($product->images as $product_image)
                                        <div class="product-image-thumb "><img
                                                src="{{ Storage::url('products/'.$product_image->image) }}"
                                                alt="Product Image"></div>
                                    @endforeach
                                </div>

                                <div class="col-9 product-image-container">
                                    <div class="flip-shirt btn btn-primary p-3 ml-3 bg-primary-gridant"
                                         data-back="{{ Storage::url('products/'.$product->back_image) }}"
                                         data-front="{{ Storage::url('products/'.$product->front_image) }}">
                                        {{__('site.back')}}
                                    </div>
                                    <img src="{{ Storage::url('products/'.$product->front_image) }}"
                                         class="product-image" alt="Product Image">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6  p-3">
                            @livewire('site.add-product-to-wishlist' , ['product' => $product ] )
                            <h3 class="mb-3"> {{ $product->name }} </h3>
{{--                            <div class="starrating risingstar d-inline-flex flex-row-reverse">--}}
{{--                                <input type="radio" id="star5" name="rating" value="5"/><label class="fa fa-star"--}}
{{--                                                                                               for="star5"--}}
{{--                                                                                               title="5 star"></label>--}}
{{--                                <input type="radio" id="star4" name="rating" value="4"/><label class="fa fa-star"--}}
{{--                                                                                               for="star4"--}}
{{--                                                                                               title="4 star"></label>--}}
{{--                                <input type="radio" id="star3" name="rating" value="3"/><label class="fa fa-star"--}}
{{--                                                                                               for="star3"--}}
{{--                                                                                               title="3 star"></label>--}}
{{--                                <input type="radio" id="star2" name="rating" value="2"/><label class="fa fa-star"--}}
{{--                                                                                               for="star2"--}}
{{--                                                                                               title="2 star"></label>--}}
{{--                                <input type="radio" id="star1" name="rating" value="1"/><label class="fa fa-star"--}}
{{--                                                                                               for="star1"--}}
{{--                                                                                               title="1 star"></label>--}}
{{--                            </div>--}}
{{--                            <span class="px-2">(2 @lang('site.Review') )</span>--}}

                            <p class="product-page-info">
                                {!! $product->description !!}
                            </p>

                            <div class="ProductPrice mb-3">
                                <span class="price mr-3"> {{$product->price}} @lang('site.SAR') </span>
{{--                                <div class="diamondPriceContainer bg-primary-gridant d-inline-block"--}}
{{--                                     style="cursor:default">--}}
{{--                                    <i class="far fa-gem mr-1"></i>--}}
{{--                                    {{$product->diamonds}} {{__('site.Diamond')}}--}}
{{--                                </div>--}}

                            </div>
                            <!-- <hr> -->


                            {{--          <div class="btn-group btn-group-toggle" data-toggle="buttons">--}}

                            {{--            @foreach ($product->variations->unique('color_id') as $product_color_variation)--}}
                            {{--            <label class="btn text-center p-2 active">--}}
                            {{--              <input type="radio" name="color_option" id="color_option_a1" autocomplete="off">--}}
                            {{--              <i class="fas fa-circle fa-1x" style="color: {{ $product_color_variation->color }};"></i>--}}
                            {{--            </label>--}}
                            {{--            @endforeach--}}


                            {{--          </div>--}}

                            {{--          <div class="select">--}}
                            {{--            <select>--}}
                            {{--                <option> @lang('site.Select Size') </option>--}}
                            {{--                @foreach ($product->variations->unique('size_id') as $product_color_variation)--}}
                            {{--                    <option>{{$product_color_variation->size->name}}</option>--}}
                            {{--                @endforeach--}}
                            {{--            </select>--}}
                            {{--          </div>--}}

                            <a  onclick="goToDesignPage()"
                               class="btn btn-primary p-3 bg-primary-gridant">
                                <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                @lang('site.custom-design')
                            </a>

                        </div>
                    </div>


                    <!-------------------------- Products List --------------------------->
                    <div class="mt-4">
                        <div class="section relatedProducts Products-list">
                            <div class="title d-flex justify-content-between">
                                <h3 class="mb-2"> @lang('site.Related Products') </h5>
                            </div>


                            <ul class="users-list clearfix">

                                @foreach ($products as $record)
                                    <li>
                                        <div class="product-container">
                                            <a href="{{ $record->url() }}" class="image-container"
                                               data-image="{{ Storage::url('products/'.$record->front_image) }}">
                                                <div class="card-front" id="0-card-front{{$record->id}}"
                                                     style="background-image: url('{{ Storage::url('products/'.$record->front_image) }}');background-color:{{$record->variations->unique('color_id')->first()->color->code??'#fff'}}; background-size: contain; background-position: center; background-repeat: no-repeat;">
                                                </div>
                                                <div class="card-back" id="0-card-back{{$record->id}}"
                                                     style="position: relative; background-image: url('{{ Storage::url('products/'.$record->back_image) }}');background-color:{{$record->variations->unique('color_id')->first()->color->code??'#fff'}}; background-size: contain; background-position: center; background-repeat: no-repeat;">
                                                </div>
                                            </a>
                                            <ul class="color-list">
                                                @foreach ($record->variations->unique('color_id') as $record_color_variation)
                                                    <li class="color-item"
                                                        onmouseover="changeCardColor('{{$record_color_variation->color->code}}','0-card-front{{$record->id}}')"
                                                        onmouseleave="changeCardColor('{{$product->variations->unique('color_id')->first()->color->code??'#fff'}}','0-card-front{{$record->id}}')"
                                                        style="background:{{$record_color_variation->color->code}}" data-image="img/color-1.jpg"
                                                        id="color-Button"></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <a class="users-list-name" href="{{ $record->url() }}">T-shirt</a>
                                        <div class="users-list-date"> {{ $record->price }}
                                            <span> @lang('site.SAR') </span></div>
                                    </li>
                                @endforeach
                            </ul>

                        </div>

                    </div>
                    <!-- /.col-md-12 -->


                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection

@section('scripts')
    <!----------- Slider Scripts --------->
    <script>
        $(document).ready(function () {
            $(".product-image-thumbs").mCustomScrollbar({
                theme: "dark",
                axis: "y"
            });
        })
    </script>

    <!----------- Slider Scripts --------->
    <script>
        $(document).ready(function () {
            $('.product-image-thumb').on('click', function () {
                var $image_element = $(this).find('img')
                $('.product-image').prop('src', $image_element.attr('src'))
                $('.product-image-thumb.active').removeClass('active')
                $(this).addClass('active')
            });
            ///////////////////////////
            $(".flip-shirt").click(function () {
                var rotateImgback = $(this).data("back")
                var rotateImgfront = $(this).data("front")
                if ($('.product-image').attr('src') == rotateImgfront) {
                    $('.product-image').attr('src', rotateImgback)
                    $('.flip-shirt').html('{{__('site.front')}}')
                } else if ($('.product-image').attr('src') == rotateImgback) {
                    $('.flip-shirt').html('{{__('site.back')}}')
                    $('.product-image').attr('src', rotateImgfront)
                } else {
                    $('.flip-shirt').html('{{__('site.front')}}')
                    $('.product-image').attr('src', rotateImgback)
                }
            })
        })
    </script>

    <!----------- Product Scripts --------->
    <script>
        $("document").ready(function () {
            $(".users-list .color-list li").mouseenter(function () {
                var hoverImage = $(this).data("image");
                $(this).closest('.product-container').find(".image-container .card-front img").attr('src', hoverImage);
            });
            $(".users-list .color-list li").mouseleave(function () {
                var mainImage = $(this).closest('.product-container').find(".image-container").data("image");
                $(this).closest('.product-container').find(".card-front img").attr('src', mainImage);
            });
        });
    </script>
    <script>
        function goToDesignPage() {
            localStorage.removeItem('product');
            const product =
                {
                    id: "1",
                    front: {
                        boundaryBox: { top: '{{$product->site_front_top}}%', left: "{{$product->site_front_left}}%", width: "{{$product->site_front_width}}%", height: "{{$product->site_front_height}}%" },
                        boundaryBoxChildren: [],
                        "name": "T-shirt",
                        "price": 200,
                        "currency": "SAR",
                        "frontImage": "{{ Storage::url('products/'.$product->front_image) }}",
                        "colors": [
                            { "color": "black", "image": "img/color-1.jpg" },
                            { "color": "#darkblue", "image": "img/color-3.jpg" },
                            { "color": "#fcdb86", "image": "img/color-2.jpg" }
                        ]
                    }, back: {
                        boundaryBox: { top: '{{$product->site_back_top}}%', left: "{{$product->site_back_left}}%", width: "{{$product->site_back_width}}%", height: "{{$product->site_back_height}}%" },
                        boundaryBoxChildren: [],
                        "name": "T-shirt",
                        "price": 200,
                        "currency": "SAR",
                        "backImage": "{{ Storage::url('products/'.$product->back_image) }}",
                        "colors": [
                            { "color": "black", "image": "img/color-1.jpg" },
                            { "color": "#darkblue", "image": "img/color-3.jpg" },
                            { "color": "#fcdb86", "image": "img/color-2.jpg" }
                        ]
                    }
                }

            const productJSON = JSON.stringify(product);
            localStorage.setItem('product', productJSON);
            window.location.href = '{{ route('custom-designs', $product->id) }}';
        }
    </script>
    {{--<script type="text/javascript">--}}
    {{--  $(function() {--}}
    {{--    $(".center").slick({--}}
    {{--      dots: true,--}}
    {{--      infinite: true,--}}
    {{--      centerMode: true,--}}
    {{--      slidesToShow: 5,--}}
    {{--      slidesToScroll: 3--}}
    {{--    });--}}
    {{--  });--}}
    {{--</script>--}}
@endsection

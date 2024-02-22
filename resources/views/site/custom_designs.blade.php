@php
    $lang = LaravelLocalization::getCurrentLocale();
    if ($lang == 'ar') {
      $dir = 'rtl';
    } else {
      $dir = 'ltr';
    }
@endphp
@extends('site.layouts.master')
@section('styles')
    <style>
        .canvas-container {
            position: absolute !important;
        }
    </style>
@endsection
@section('page_content')
    <div class="content-wrapper pt-3">
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card-solid">
                <div class="card-body">
                    <form method="post" action="{{route('cart.store')}}" enctype="multipart/form-data" id="myForm">
                        @csrf
                        <input type="hidden" name="product_id" id="product_id" value="{{$record->id}}"/>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="row">
                                    <div class="col-9 product-image-container"
                                         id="product-image-container">
                                        <canvas id="main">
                                            <input type="hidden" name="mainImg" id="mainImg"/>
                                        </canvas>
                                        <canvas id="mainBack" class="d-none">
                                            <input type="hidden" name="mainBackImg" id="mainBackImg"/>
                                        </canvas>
                                        <canvas id="front">
                                            <input type="hidden" name="pngFrontURL" id="pngFrontURL"/>
                                            <input type="hidden" name="image_front_width" id="image_front_width"/>
                                            <input type="hidden" name="image_front_height" id="image_front_height"/>
                                            <input type="hidden" name="image_front_left" id="image_front_left"/>
                                            <input type="hidden" name="image_front_top" id="image_front_top"/>
                                        </canvas>
                                        <canvas id="back">
                                            <input type="hidden" name="pngBackURL" id="pngBackURL"/>
                                            <input type="hidden" name="image_back_width" id="image_back_width"/>
                                            <input type="hidden" name="image_back_height" id="image_back_height"/>
                                            <input type="hidden" name="image_back_left" id="image_back_left"/>
                                            <input type="hidden" name="image_back_top" id="image_back_top"/>
                                        </canvas>
                                        <div class="row">
                                            <div class="flip-shirt col-3"
                                                 style="right: auto !important; left: 10px !important;">
                                                <input type="file" class="filestyle" name="image_front_src"
                                                       id="image_front_src"/>
                                                <input type="file" class="filestyle d-none" name="image_back_src"
                                                       id="image_back_src"/>
                                            </div>
                                            <div class="flip-shirt col-3"
                                                 style="right: auto !important; left: 50px !important;">
                                                <a href="#" type="button" id="text_front" class="">
                                                    <i class="fa fa-envelope-open-text"></i>
                                                </a>
                                                <a href="#" type="button" id="text_back" class="d-none">
                                                    <i class="fa fa-envelope-open-text"></i>
                                                </a>
                                            </div>
                                            <div class="flip-shirt col-3" id="flip-shirt"
                                                 data-back="{{ Storage::url('products/'.$record->back_image) }}"
                                                 data-front="{{ Storage::url('products/'.$record->front_image) }}">
                                                <i class="fa fa-rotate-right"></i>
                                            </div>
                                        </div>
                                        <img src="{{ Storage::url('products/'.$record->front_image) }}"
                                             class="product-image d-none" alt="Product Image" id="frontImage" width="50"
                                             height="50">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6  pl-3">
                                @livewire('site.add-product-to-wishlist' , ['product' => $record ] )
                                <h3 class="mb-3"> {{ $record->name }} </h3>
                                <div class="starrating risingstar d-inline-flex flex-row-reverse">
                                    <input type="radio" id="star5" name="rating" value="5"/><label class="fa fa-star"
                                                                                                   for="star5"
                                                                                                   title="5 star"></label>
                                    <input type="radio" id="star4" name="rating" value="4"/><label class="fa fa-star"
                                                                                                   for="star4"
                                                                                                   title="4 star"></label>
                                    <input type="radio" id="star3" name="rating" value="3"/><label class="fa fa-star"
                                                                                                   for="star3"
                                                                                                   title="3 star"></label>
                                    <input type="radio" id="star2" name="rating" value="2"/><label class="fa fa-star"
                                                                                                   for="star2"
                                                                                                   title="2 star"></label>
                                    <input type="radio" id="star1" name="rating" value="1"/><label class="fa fa-star"
                                                                                                   for="star1"
                                                                                                   title="1 star"></label>
                                </div>
                                <span class="px-2">(2 @lang('site.Review') )</span>

                                <p class="product-page-info">
                                    {!! $record->description !!}
                                </p>

                                <div class="ProductPrice mb-3">
                                    <span class="price mr-3"> {{$record->price}} @lang('site.SAR') </span>
                                    <div class="diamondPriceContainer bg-primary-gridant d-inline-block"
                                         style="cursor:default">
                                        <i class="far fa-gem mr-1"></i>
                                        {{$record->diamonds}} {{__('site.Diamond')}}
                                    </div>
                                </div>
                                <!-- <hr> -->

                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    @foreach ($record->variations->unique('color_id') as $record_color_variation)
                                        <label class="btn text-center p-2 active">
                                            <input required type="radio" name="color_id"
                                                   value="{{$record_color_variation->color->id}}" id="color_option_a1"
                                                   autocomplete="off">
                                            <i class="fas fa-circle fa-1x"
                                               style="color: {{ $record_color_variation->color }};"></i>
                                        </label>
                                    @endforeach
                                </div>

                                <div class="select">
                                    <select name="size_id" required>
                                        <option> @lang('site.Select Size') </option>
                                        @foreach ($record->variations->unique('size_id') as $record_color_variation)
                                            <option
                                                value="{{$record_color_variation->size->id}}">{{$record_color_variation->size->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary p-3 ml-3 bg-primary-gridant" id="save">
                                    <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                    @lang('site.add-to-cart')
                                </button>

                            </div>
                        </div>
                    </form>
                    <!-------------------------- Products List --------------------------->
                    <div class="mt-4">
                        <!-------------------------- Used Design --------------------------->
                        <div class="section used-design same-designes">
                            <div class="title d-flex justify-content-between col-md-12">
                                <h5 class="mb-2"> @lang('site.Same Designer Designes') </h5>
                            </div>

                            <ul class="users-list clearfix">
                                <li>
                                    <a href="#">
                                        <div class="image-container">
                                            <img src="{{ asset('site_assets/'.$dir.'/img/design-1.jpg') }}"
                                                 alt="User Image">
                                        </div>
                                    </a>
                                    <a class="users-list-name" href="#" title="Alexander Pierce Alexander">Alexander
                                        Pierce Alexander </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="image-container">
                                            <img src="{{ asset('site_assets/'.$dir.'/img/design-2.png') }}"
                                                 alt="User Image">
                                        </div>
                                    </a>
                                    <a class="users-list-name" href="#">Norman</a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="image-container">
                                            <img src="{{ asset('site_assets/'.$dir.'/img/design-1.jpg') }}"
                                                 alt="User Image">
                                        </div>
                                    </a>
                                    <a class="users-list-name" href="#">Jane</a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="image-container">
                                            <img src="{{ asset('site_assets/'.$dir.'/img/design-2.png') }}"
                                                 alt="User Image">
                                        </div>
                                    </a>
                                    <a class="users-list-name" href="#">John</a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="image-container">
                                            <img src="{{ asset('site_assets/'.$dir.'/img/design-1.jpg') }}"
                                                 alt="User Image">
                                        </div>
                                    </a>
                                    <a class="users-list-name" href="#" title="Alexander Pierce">Alexander Pierce</a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="image-container">
                                            <img src="{{ asset('site_assets/'.$dir.'/img/design-2.png') }}"
                                                 alt="User Image">
                                        </div>
                                    </a>
                                    <a class="users-list-name" href="#">John</a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="image-container">
                                            <img src="{{ asset('site_assets/'.$dir.'/img/design-1.jpg') }}"
                                                 alt="User Image">
                                        </div>
                                    </a>
                                    <a class="users-list-name" href="#" title="Alexander Pierce">Alexander Pierce</a>
                                </li>

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
        // var canvasFront = new fabric.Canvas('front');
        // var canvasFront = new fabric.Canvas('back');
        // Initiate a front Canvas instance
        var canvasMain = new fabric.Canvas("main", {
            width: '488',
            height: '445',
        });
        // Add an image
        fabric.Image.fromURL(
            "{{ Storage::url('products/'.$record->front_image) }}",
            function (img) {
                var image = img.set({
                    selectable: false,
                    evented: false,
                });
                canvasMain.add(image);
                canvasMain.sendToBack(image);
                canvasMain.renderAll();
            },
            {crossOrigin: "anonymous"}
        );
        var canvasBackMain = new fabric.Canvas("mainBack", {
            width: '488',
            height: '445',
        });
        // Add an image
        fabric.Image.fromURL(
            "{{ Storage::url('products/'.$record->back_image) }}",
            function (img) {
                var image = img.set({
                    selectable: false,
                    evented: false,
                });
                canvasBackMain.add(image);
                canvasBackMain.sendToBack(image);
                canvasBackMain.renderAll();
            },
            {crossOrigin: "anonymous"}
        );


        var canvasFront = new fabric.Canvas("front", {
            // isDrawingMode:true,
            width: '{{$record->site_front_width}}',
            height: '{{$record->site_front_height}}',
        });
        canvasFront.setDimensions({
            top: '{{$record->site_front_top}}',
            left: '{{$record->site_front_left}}',
        });
        // Initiate a front Canvas instance
        var canvasBack = new fabric.Canvas("back", {
            // isDrawingMode:true,
            width: '{{$record->site_back_width}}',
            height: '{{$record->site_back_height}}',
        });
        canvasBack.setDimensions({
            top: '{{$record->site_back_top}}',
            right: '{{$record->site_back_left}}',
        });

        $(function () {
            // document.getElementById("text_front").onclick = function () {
            //     // Add a text
            //     let text = new fabric.IText("Type here...", {
            //         fontSize: 14,
            //     });
            //     canvasFront.add(text);
            // }

            document.getElementById("image_front_src").onchange = function (e) {
                console.log('front')
                var reader = new FileReader();
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = e.target.result;
                    image.onload = function () {
                        var img = new fabric.Image(image);
                        // img.set({
                        //     margin: 50,
                        // });
                        img.scaleToWidth('{{$record->site_front_width * 0.75}}');
                        canvasFront.centerObject(img);
                        // canvasFront.remove(canvasFront.getActiveObject());
                        canvasFront.add(img).setActiveObject(img).renderAll();
                    }
                }
                reader.readAsDataURL(e.target.files[0]);
            }
            let CanvasEventFrontImage = function (evt) {
                let movingObject = evt.target;
                $('#image_front_width').val(movingObject.get('width'));
                $('#image_front_height').val(movingObject.get('height'));
                $('#image_front_left').val(movingObject.get('left'));
                $('#image_front_top').val(movingObject.get('top'));
                console.log(movingObject.get('width'), movingObject.get('height'), movingObject);
            };
            canvasFront.on('object:modified', CanvasEventFrontImage);

            document.getElementById("image_back_src").onchange = function (e) {
                console.log('back')
                var reader = new FileReader();
                reader.onload = function (e) {
                    var imageBack = new Image();
                    imageBack.src = e.target.result;
                    imageBack.onload = function () {
                        var imgBack = new fabric.Image(imageBack);
                        // img.set({
                        //     margin: 50,
                        // });
                        imgBack.scaleToWidth('{{$record->site_back_width * 0.75}}');
                        canvasBack.centerObject(imgBack);
                        // canvasBack.remove(canvasBack.getActiveObject());
                        canvasBack.add(imgBack).setActiveObject(imgBack).renderAll();
                    }
                }
                reader.readAsDataURL(e.target.files[0]);
            }
            let CanvasEventBackImage = function (evt) {
                let movingObject = evt.target;
                $('#image_back_width').val(movingObject.get('width'));
                $('#image_back_height').val(movingObject.get('height'));
                $('#image_back_left').val(movingObject.get('left'));
                $('#image_back_top').val(movingObject.get('top'));
            };
            canvasBack.on('object:modified', CanvasEventBackImage);


            // Handle download button click
            document.getElementById("save").onclick = function () {
                var pngFrontURL = canvasFront.toDataURL({
                    format: "png"
                });
                var pngBackURL = canvasBack.toDataURL({
                    format: "png"
                });
                var pngMainURL = canvasMain.toDataURL({
                    format: "png"
                });
                var pngMainBackURL = canvasBackMain.toDataURL({
                    format: "png"
                });
                console.log(pngMainURL);
                $('#mainImg').val(pngMainURL);
                $('#mainBackImg').val(pngMainBackURL);
                $('#pngFrontURL').val(pngFrontURL);
                $('#pngBackURL').val(pngBackURL);
            };
        });
        $(document).ready(function () {
            $('.product-image-thumb').on('click', function () {
                var $image_element = $(this).find('img')
                $('.product-image').prop('src', $image_element.attr('src'))
                $('.product-image-thumb.active').removeClass('active')
                $(this).addClass('active')
            });
            ///////////////////////////
            $("#flip-shirt").click(function () {
                var rotateImgback = $(this).data("back")
                var rotateImgfront = $(this).data("front")
                console.log(rotateImgback, rotateImgfront, 'on')
                if ($('.product-image').attr('src') == rotateImgfront) {
                    $('#mainBack').removeClass('d-none');
                    $('#back').removeClass('d-none');
                    $('#front').addClass('d-none');
                    $('#main').addClass('d-none');
                    $('#image_front_src').addClass('d-none');
                    $('#image_back_src').removeClass('d-none');
                    $('.product-image').attr('src', rotateImgback)
                    // $('.product-image-container').css('background', "url('" + rotateImgback + "')").css('background-repeat', "no-repeat").css('background-size', "contain")
                } else if ($('.product-image').attr('src') == rotateImgback) {
                    $('#main').removeClass('d-none');
                    $('#front').removeClass('d-none');
                    $('#mainBack').addClass('d-none');
                    $('#back').addClass('d-none');
                    $('#image_back_src').addClass('d-none');
                    $('#image_front_src').removeClass('d-none');
                    $('.product-image').attr('src', rotateImgfront)
                    // $('.product-image-container').css('background', "url('" + rotateImgfront + "')").css('background-repeat', "no-repeat").css('background-size', "contain")
                } else {
                    $('#main').removeClass('d-none');
                    $('#front').removeClass('d-none');
                    $('#back').addClass('d-none');
                    $('#mainBack').addClass('d-none');
                    $('#image_back_src').addClass('d-none');
                    $('#image_front_src').removeClass('d-none');
                    $('.product-image').attr('src', rotateImgback)
                    // $('.product-image-container').css('background', "url('" + rotateImgback + "')").css('background-repeat', "no-repeat").css('background-size', "contain")
                }
            })
        })
    </script>
@endsection

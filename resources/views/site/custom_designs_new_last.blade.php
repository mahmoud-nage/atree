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
    <link rel="stylesheet" href="{{ asset('site_assets/'.$dir.'/css/custom-design.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.css"
        integrity="sha512-087vysR/jM0N5cp13Vlp+ZF9wx6tKbvJLwPO8Iit6J7R+n7uIMMjg37dEgexOshDmDITHYY5useeSmfD1MYiQA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    >
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css"
        integrity="sha512-UtLOu9C7NuThQhuXXrGwx9Jb/z9zPQJctuAgNUBK3Z6kkSYT9wJ+2+dh6klS+TDBCV9kNPBbAxbVD+vCcfGPaA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    >
@endsection
@section('page_content')
    <div class="content-wrapper pt-3  gap-3">
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card-solid">
                <div class="card-body">
                    <div class="row d-flex">
                        <!-- product-image -->
                        <div class="d-flex flex-column justify-content-between align-items-center mx-auto">
                            <div class="toggle-img-button d-flex">
                                <div id="front-img-button" class="front">{{__('site.front')}}</div>
                                <div id="back-img-button" class="back">{{__('site.back')}}</div>
                            </div>
                            <!-- main-image -->
                            <div id="design-area" class="resize-container">
                                <div id="boundary-box"
                                     style="border: 2px dashed rgb(255, 5, 5); position: relative; width: {{$record->site_front_width}}%; height: {{$record->site_front_height}}%; top: {{$record->site_front_top}}%; left: {{$record->site_front_left}}%"></div>
                            </div>
                        </div>
                        <!-- ///////////////////////// -->
                        <!-- image controllers -->
                        <div id="image-controls" style="display: none;">
                            <div class="d-flex justify-content-between w-100 h-100"
                                 style="border: 1px solid rgba(84, 84, 84, 0.263);">
                                <div class="controls-new align-items-center w-fit">
                                    <button class="btn-custom btn-primary bg-primary-gridant"
                                            id="image-delete-button">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <button class="btn-custom btn-primary bg-primary-gridant"
                                            id="image-rotate-left-button">
                                        <i class="fa-solid fa-arrow-rotate-left"></i>
                                    </button>
                                    <button class="btn-custom btn-primary bg-primary-gridant"
                                            id="image-rotate-right-button">
                                        <i class="fa-solid fa-arrow-rotate-right"></i>
                                    </button>
                                    <button class="btn-custom btn-primary bg-primary-gridant" id="crop-btn">
                                        <i class="fa-solid fa-crop-simple"></i>
                                    </button>
                                    <button class="btn-custom btn-primary bg-primary-gridant" id="finish-btn"
                                            style="display: none;">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                    <input id="image-size" type="range" max="300" min="10" value="100"
                                           style="width: 6rem;">
                                </div>
                            </div>
                        </div>
                        <!-- text controllers -->
                        <div id="text-controls" style="display: none;">
                            <div class="d-flex justify-content-between w-100 h-100"
                                 style="border: 1px solid rgba(84, 84, 84, 0.263);">
                                <div class="controls-new align-items-center w-fit">
                                    <button class="btn-custom btn-primary bg-primary-gridant"
                                            id="text-delete-button">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <button class="btn-custom btn-primary bg-primary-gridant" id="bold-text">
                                        <i class="fa-solid fa-bold"></i>
                                    </button>
                                    <button class="btn-custom btn-primary bg-primary-gridant" id="italic-text">
                                        <i class="fa-solid fa-italic"></i>
                                    </button>
                                    <button class="btn-custom btn-primary bg-primary-gridant"
                                            id="strikethrough-text">
                                        <i class="fa-solid fa-strikethrough"></i>
                                    </button>
                                    <button class="btn-custom btn-primary bg-primary-gridant"
                                            id="underline-text-button">
                                        <i class="fa-solid fa-underline"></i>
                                    </button>
                                    <input class="btn-custom btn-primary bg-primary-gridant" type="range"
                                           id="text-size" max="50" min="8" value="12" style="width: 6rem;">
                                    <input class="btn-primary bg-primary-gridant" type="color" style="width: 5rem;"
                                           id="text-color" value="#ffffff">
                                    <select id="font-family" style="width: 5rem;">
                                        <option value="Arial">Arial</option>
                                        <option value="Courier New">Courier New</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Times New Roman">Times New Roman</option>
                                        <option value="Verdana">Verdana</option>
                                        <option value="Cairo-Regular">Cairo Regular</option>
                                        <option value="Cairo-Medium">Cairo Medium</option>
                                        <option value="OpenSansRegular">Open Sans Regular</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- ///////////////////////// -->
                        <!-- operation column -->
                        <div class="operation-column">
                            <div class="card-sidebar">
                                <ul class="list">
                                    <li class="photo-item" style=" cursor: pointer;">
                                        <i class="fa big fa-tshirt"></i>
                                        <span class="d-flex">Add existing Design</span>
                                    </li>
                                    <li id="file-input-trigger" class="photo-item border-top border-white pt-4"
                                        style=" cursor: pointer;">
                                        <i class="fa big fa-camera" style="size: 5px;"></i>
                                        <span class="d-flex">
                                                    {{__('site.image')}}
                                                </span>
                                        <input
                                            type="file"
                                            id="file-input"
                                            style="display: none;"
                                            accept="image/*"
                                        >
                                    </li>
                                    <li id="add-text" class="photo-item border-top border-white pt-4 text-sm"
                                        style=" cursor: pointer;">
                                        <i class="fa big fa-text-height"></i>
                                        <span class="d-flex">
                                                    {{__('site.text')}}
                                                </span>
                                    </li>
                                    <li id="Layers" class="photo-item border-top border-white pt-4"
                                        style=" cursor: pointer;">
                                        <i class="fa big fa-solid fa-layer-group"></i>
                                        <span class="d-flex">Layers</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- layers-div -->
                        <div class="mx-auto flex-column"
                             style="display: none;min-height: 100%;min-width:max-content;border: 1px solid #cc33;padding: 15px;align-items: space-between;"
                             id="layers-container"></div>
                        <!-- details & add to cart button -->
                        <div class="cart-operation col-4 mx-auto px-0">
                            <div class="well">
                                <h6 class="d-inline">@lang('site.order_quantity')</h6>
                                <a href="#" type="button" class="btn btn-success float-left"
                                   id="add_sizes">@lang('site.add')</a>
                                <hr>
                                <div class="form-row">
                                    <div class="row" id="size_form">
                                        <div class="form-group col-3 p-1">
                                            <select name="color_id[]" required
                                                    class="form-control @error('color_id') is-invalid @enderror">
                                                <option> @lang('site.Select Color') </option>
                                                @foreach ($record->variations->unique('color_id') as $record_color_variation)
                                                    <option
                                                        @if($design && $design->main_color_code == $record_color_variation->color->code) selected
                                                        @elseif($loop->first) selected @endif
                                                        value="{{$record_color_variation->color->id}}">{{$record_color_variation->color->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('color_id')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-3 p-1">
                                            <select name="size_id[]" required
                                                    class="form-control @error('size_id') is-invalid @enderror">
                                                <option> @lang('site.Select Size') </option>
                                                @foreach ($record->variations->unique('size_id') as $record_color_variation)
                                                    <option
                                                        value="{{$record_color_variation->size->id}}">{{$record_color_variation->size->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('size_id')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-2 p-1">
                                            <input name="quantities[]" min="0" value="1" type="number"
                                                   onchange="changeQty()"
                                                   id="quantities"
                                                   class="form-control @error('quantities') is-invalid @enderror"
                                                   required>
                                            @error('quantities')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-3 p-1">
                                            <input min="0" value="{{$record->price}} {{__('site.SAR')}}"
                                                   type="text" id="price1" disabled class="form-control">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <input value="{{__('site.total')}}" type="text" disabled
                                                   class="form-control">
                                        </div>
                                        <div class="form-group col-6">
                                            <input value="{{$record->price}} {{__('site.SAR')}}" type="text"
                                                   disabled
                                                   id="total_amount"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column align-items-end p-2">
                                <h6>@lang('site.product_preview_color')</h6>
                                <hr class="w-100">
                                <ul class="nav" id="colorList">
                                    <li class="color-preview" data-color-id="#ffffff" title="white"
                                        style="background-color: rgb(255, 255, 255);" onclick="changeColor('#fff')">
                                    </li>
                                    @foreach ($record->variations->unique('color_id') as $record_color_variation)
                                        <li class="color-preview"
                                            data-color-id="{{$record_color_variation->color->code}}"
                                            title="{{$record_color_variation->color->name}}"
                                            style="background-color: {{$record_color_variation->color->code}};"
                                            onclick="changeColor('{{$record_color_variation->color->code}}')">
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <button type="button" onclick="addType(1)"
                                        class="btn btn-primary bg-primary-gridant span6 py-2"
                                        style="width: 50% !important;" id="save" fdprocessedid="p0s243">
                                    @lang('site.add-to-cart')
                                    <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                </button>
                                <button type="button" class="btn btn-success bg-success-gridant span6 py-2"
                                        style="width: 49% !important;" id="generate-cards" fdprocessedid="0tvxz">
                                    @lang('site.add-design')
                                    <i class="fa fa-crop-alt fa-lg mr-2"></i>
                                </button>
                            </div>
                        </div>
                        <div class="section relatedProducts Products-list w-100 mt-2" style="border: 1px solid rgba(148, 148, 148, 0.2);padding: 15px;align-items: space-between;">
                            <div class="title d-flex justify-content-between">
                                <h3 class="mb-2">@lang('site.Products')</h3>
                            </div>
                            <ul class="users-list clearfix" id="products-list">
                                @foreach ($products as $product)
                                    <li id="product{{$product->id}}" style="
                                        position: relative;
                                    ">
                                        <div style="
                                        position: absolute;
                                        z-index: 10;
                                        left: 15px;
                                        top: 15px;
                                    ">
                                            <label for="product{{$product->id}}-checkbox" class="custom-checkbox">
                                                <input
                                                    type="checkbox"
                                                    id="product{{$product->id}}-checkbox"
                                                    name="products[]"
                                                    value="{{$product->id}}"
                                                >
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="product-container">
                                            <a class="image-container" data-image="{{ Storage::url('products/'.$product->front_image) }}" onclick="changeNewDesignProduct('card-product{{$product->id}}')">
                                                <div class="card-front" id="card-product{{$product->id}}"
                                                     style="background-image: url('{{ Storage::url('products/'.$product->front_image) }}');background-color:{{$product->variations->unique('color_id')->first()->color->color??'#fff'}}; background-size: contain; background-position: center; background-repeat: no-repeat;">
                                                    <div
                                                        style="border: 0px dashed rgb(255, 5, 5); position: relative; width: {{$product->site_front_width}}%; height: {{$product->site_front_height}}%; top: {{$product->site_front_top}}%; left: {{$product->site_front_left}}%;"></div>
                                                </div>
                                                <div class="card-back" id="card-product{{$product->id}}"
                                                     style="position: relative; background-image: url('{{ Storage::url('products/'.$product->back_image) }}');background-color:{{$product->variations->unique('color_id')->first()->color->color??'#fff'}}; background-size: contain; background-position: center; background-repeat: no-repeat;">
                                                    <div
                                                        style="border: 0px dashed rgb(255, 5, 5); position: relative; width: {{$product->site_back_width}}%; height: {{$product->site_back_height}}%; top: {{$product->site_back_top}}%; left: {{$product->site_back_left}}%;"></div>
                                                </div>
                                            </a>
                                            <ul class="color-list">
                                                @foreach ($product->variations->unique('color_id') as $record_color_variation)
                                                    <li class="color-item"
                                                        onmouseover="changeCardColor('{{$record_color_variation->color->code}}','card-product{{$product->id}}')"
                                                        onmouseleave="changeCardColor('rgb(255, 250, 255)','card-product{{$product->id}}')"
                                                        style="background:{{$record_color_variation->color->code}}" data-image="img/color-1.jpg"
                                                        id="color-Button"></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <a class="users-list-name" href="{{ $product->url() }}">{{$product->name}}</a>
                                        <div class="users-list-date">{{$product->price}} <span>{{__('site.SAR')}}</span></div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- //////////////////////////////////////////////////////////////// -->
                <!-- old designs  -->
                <!-- <div class="card-body section used-design">
                        <div class="title d-flex justify-content-between align-items-center col-md-12">
                            <h5 class="mb-2">Most used design</h5>
                            <a href="Products.html" class="text-sm text-dark">more</a>
                        </div>
                        <ul id="designs-list" class="users-list clearfix"> -->
                <!-- List items will be inserted here dynamically -->
                <!-- </ul>
                    </div> -->
                <!-- old designs  -->
                <!-- <div class="section relatedProducts Products-list">
                        <div class="title d-flex justify-content-between">
                            <h3 class="mb-2">Related Products</h3>
                        </div>
                        <ul class="users-list clearfix" id="products-list"> -->
                <!-- Products will be generated here by JavaScript -->
                <!-- </ul>
                    </div> -->
                <!-- container for adding new design  -->
                <div class="card-body">
                    <div class="row d-flex justify-content-between">
                        <div id="cards-container"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('scripts')
    <script>
        $(function () {
            $("#add_sizes").on('click', function () {
                var ele = $('#size_form').clone(true);
                $('#size_form').closest('#size_form').before(ele).append(`
                                                <div class="form-group col-1">
                                                    <a href="#" class="text-danger float-left"
                                                       id="remove_sizes" onclick="removeCart(this)"><i class="fa fa-times"></i></a>
                                                </div>`);
                changeQty();
            });

            $('#flipback').click(
                function () {
                    if ($(this).attr("data-original-title") === "Show Back View") {
                        $(this).html('{{__('site.front')}}')
                        if (count === 0) {
                            Swal.fire({
                                title: "{{__('site.alert')}}",
                                text: "{{__('site.additional_price')}}",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "{{__('site.ok')}}",
                                cancelButtonText: "{{__('site.cancel')}}"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    count++;
                                    $('#price').html('{{$record->price_full_design}}' + '{{__('site.SAR')}}');
                                    $('#price1').val('{{$record->price_full_design}}' + '{{__('site.SAR')}}');
                                    $('#total_amount').val('{{$record->price_full_design}}' + '{{__('site.SAR')}}');
                                    $('#flipback').attr('data-original-title', 'Show Front View');

                                    $('#shirtDiv').addClass('d-none');
                                    $('#shirtDivBack').removeClass('d-none');
                                    $('#canvasBack').parent().removeClass('d-none');
                                    $('#tcanvas').parent().addClass('d-none');

                                    $('#drawingAreaBack').removeClass('d-none');
                                    $('#drawingArea').addClass('d-none');
                                    canvasBack.renderAll();
                                }
                            });
                        } else {
                            $('#price').html('{{$record->price_full_design}}' + '{{__('site.SAR')}}');
                            $('#price1').val('{{$record->price_full_design}}' + '{{__('site.SAR')}}');
                            $('#total_amount').val('{{$record->price_full_design}}' + '{{__('site.SAR')}}');
                            $('#flipback').attr('data-original-title', 'Show Front View');

                            $('#shirtDiv').addClass('d-none');
                            $('#shirtDivBack').removeClass('d-none');
                            $('#canvasBack').parent().removeClass('d-none');
                            $('#tcanvas').parent().addClass('d-none');

                            $('#drawingAreaBack').removeClass('d-none');
                            $('#drawingArea').addClass('d-none');
                            canvasBack.renderAll();
                        }

                    } else {
                        $(this).html('{{__('site.back')}}')
                        $('#flipback').attr('data-original-title', 'Show Back View');
                        $('#shirtDivBack').addClass('d-none');
                        $('#shirtDiv').removeClass('d-none');

                        $('#canvasBack').parent().addClass('d-none');
                        $('#tcanvas').parent().removeClass('d-none');

                        $('#drawingAreaBack').addClass('d-none');
                        $('#drawingArea').removeClass('d-none');
                    }

                });
            $('#removeColorBtn').click(
                function () {
                    $('#design_color_id').val('#ffffff');
                    document.getElementById("shirtDiv").style.backgroundColor = '#ffffff';
                    document.getElementById("shirtDivBack").style.backgroundColor = '#ffffff';
                });
        });

        function removeCart(e) {
            e.closest('#size_form').remove();
            changeQty();
        }

        function changeQty() {
            let price = count > 1 ? parseInt({{$record->price}}) : parseInt({{$record->price_full_design}});
            let qty = 0;
            $("input[name='quantities[]']").each(function () {
                qty += parseInt($(this).val());
            });
            $('#total_amount').val('' + price * qty + ' {{__('site.SAR')}}');
        }

        function addType(type) {
            console.log(type);
            $("#type").val(type);
            this.save();
        }


        function changeColor(color) {
            const designArea = document.getElementById('design-area');
            designArea.style.backgroundColor = color;
        }

        function changeCardColor(color, id) {
            const card = document.getElementById(id);
            card.style.backgroundColor = color;

        }

        function changeDesignProduct(newProduct) {
            const productJSON = JSON.stringify(newProduct);
            localStorage.setItem('product', productJSON);
            GLOBAL_PRODUCT = newProduct
            TEM_Product = newProduct
            initPage(newProduct)
        }
    </script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"
    ></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.js"
    ></script>
    <script src="{{ asset('site_assets/'.$dir.'/js/custom-design.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
@endsection

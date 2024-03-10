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
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script type="text/javascript" src="{{ asset('site_assets/designs/js/excanvas.js') }}"></script>
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>--}}
    <script type="text/javascript" src="{{ asset('site_assets/designs/js/fabric.js') }}"></script>
    <script type="text/javascript"></script>
    <!-- Le styles -->
    <link type="text/css" rel="stylesheet" href="{{ asset('site_assets/designs/css/jquery.miniColors.css') }}"/>
    <link href="{{ asset('site_assets/designs/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('site_assets/designs/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
    <script type="text/javascript"></script>
    <style type="text/css">
        .color-preview {
            border: 1px solid #CCC;
            margin: 2px;
            zoom: 1;
            vertical-align: top;
            display: inline-block;
            cursor: pointer;
            overflow: hidden;
            width: 20px;
            height: 20px;
        }

        .rotate {
            -webkit-transform: rotate(90deg);
            -moz-transform: rotate(90deg);
            -o-transform: rotate(90deg);
            /* filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=1.5); */
            -ms-transform: rotate(90deg);
        }

        .Arial {
            font-family: "Arial";
        }

        .Helvetica {
            font-family: "Helvetica";
        }

        .MyriadPro {
            font-family: "Myriad Pro";
        }

        .Delicious {
            font-family: "Delicious";
        }

        .Verdana {
            font-family: "Verdana";
        }

        .Georgia {
            font-family: "Georgia";
        }

        .Courier {
            font-family: "Courier";
        }

        .ComicSansMS {
            font-family: "Comic Sans MS";
        }

        .Impact {
            font-family: "Impact";
        }

        .Monaco {
            font-family: "Monaco";
        }

        .Optima {
            font-family: "Optima";
        }

        .HoeflerText {
            font-family: "Hoefler Text";
        }

        .Plaster {
            font-family: "Plaster";
        }

        .Engagement {
            font-family: "Engagement";
        }

        .span3, .span6 {
            width: 80%;
        }

        .tab-content {
            width: 60%;
            position: absolute;
            left: 1%;
            height: 10rem;
        }

        .nav-tabs {
            font-size: 18px;
            background: #552e90;
            display: flex;
            justify-content: space-between;
        }

        .nav-tabs li a:hover {
            background-color: #552e90;
        }

        .nav-tabs li a {
            color: #ffffff;
        }

        .span3 {
            position: absolute;
            z-index: 9;
            top: 0;
        }

        .tab-pane {
            height: 100%;
        }

        .well {
            background-color: #f5f5f575;
            border-color: #ebebeb;
            height: 100%;
        }

        #text-string {
            height: auto;
            width: 70%;
            margin: auto 3%;
        }

        .flip-shirt {
            position: absolute;
            left: 19%;
            top: 6%;
            z-index: 99;
        }

        .span6 .clearfix {
            position: absolute;
            bottom: 0;
            z-index: 99;
        }

        .remove-btn {
            position: absolute;
            right: 92%;
            top: 3%;
            border: none;
            background: transparent;
        }

        .well {
            padding-top: 15%;
        }

    </style>
@endsection
@section('page_content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card-solid">
                <div class="card-body">
                    <form method="post" action="{{route('cart.store')}}" enctype="multipart/form-data" id="myForm">
                        @csrf
                        <input type="hidden" name="product_id" id="product_id" value="{{$record->id}}"/>
                        <input type="hidden" id="design_front_photo" name="design_front_photo"/>
                        <input type="hidden" id="color_id" name="color_id"/>
                        <input type="hidden" id="main_image_width" name="main_image_width" value="530"/>
                        <input type="hidden" id="main_image_height" name="main_image_height" value="630"/>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="row">
                                    <div class="span3">
                                        <div class="tabbable"> <!-- Only required for left/right tabs -->
                                            <ul class="nav nav-tabs">
                                                <li class=""><a href="#tab1"
                                                                data-toggle="tab">{{__('site.colors')}} <i
                                                            class="fa fa-palette"></i></a></li>
                                                <li><a href="#tab2" data-toggle="tab">{{__('site.text')}} <i
                                                            class="fa fa-pen"></i></a></li>
                                                <li><a href="#tab3" data-toggle="tab">{{__('site.image')}} <i
                                                            class="fa fa-image"></i></a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <button type="button" class="close remove-btn text-danger"
                                                        aria-label="Close"
                                                        onclick="$('.tab-pane').removeClass('active');$('.nav-tabs li').removeClass('active')">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <div class="tab-pane" id="tab1">
                                                    <div class="well d-none">
                                                        <!--					      	<h3>Tee Styles</h3>-->
                                                        <!--						      <p>-->
                                                        <select id="tshirttype">
                                                            <option
                                                                value="{{ Storage::url('products/'.$record->front_image) }}"
                                                                selected="selected">Short Sleeve Shirts
                                                            </option>
                                                        </select>
                                                        <!--						      </p>-->
                                                    </div>
                                                    <div class="well">
                                                        <ul class="nav">
                                                            <li class="color-preview" id="removeColorBtn"
                                                                data-color-id=""
                                                                title="white"
                                                                style="background-color:#ffffff"></li>
                                                            @foreach ($record->variations->unique('color_id') as $record_color_variation)
                                                                <li class="color-preview" id="changeColorBtn"
                                                                    data-color-id="{{$record_color_variation->color->id}}"
                                                                    title="{{$record_color_variation->color->name}}"
                                                                    style="background-color:{{$record_color_variation->color->code}};">
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab2">
                                                    <div class="well">
                                                        <div class="input-append">
                                                            <input class="span2" id="text-string" type="text"
                                                                   placeholder="{{__('site.add text here...')}}">
                                                            <button id="add-text" class="btn btn-sm" title="Add text"
                                                                    type="button"><i class="icon-share-alt"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab3">
                                                    <div class="well">
                                                        {{--                                                        <div id="avatarlist">--}}
                                                        {{--                                                            @foreach($images as $image)--}}
                                                        {{--                                                                <img style="cursor:pointer;" class="img-polaroid"--}}
                                                        {{--                                                                     src="{{ asset($image->image) }}">--}}
                                                        {{--                                                            @endforeach--}}
                                                        {{--                                                        </div>--}}
                                                        <div>
                                                            {{--                                                            <form action="" method="post" enctype="multipart/form-data">--}}
                                                            <input type="file" name="fileToUpload"
                                                                   id="fileToUpload">
                                                            {{--                                                                <input class="btn btn-primary" type="button"--}}
                                                            {{--                                                                       value="Upload Custom Image" name="submit">--}}
                                                            {{--                                                            </form>--}}
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span6">
                                        <div align="center" style="min-height: 32px;">
                                            <div class="clearfix">
                                                <div class="btn-group inline pull-right" id="texteditor"
                                                     style="display:none">
                                                    <button id="font-family" class="btn dropdown-toggle" type="button"
                                                            data-toggle="dropdown" title="Font Style"><i
                                                            class="icon-font" style="width:19px;height:19px;"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu"
                                                        aria-labelledby="font-family-X">
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Arial');"
                                                               class="Arial">Arial</a></li>
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Helvetica');"
                                                               class="Helvetica">Helvetica</a></li>
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Myriad Pro');"
                                                               class="MyriadPro">Myriad Pro</a></li>
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Delicious');"
                                                               class="Delicious">Delicious</a></li>
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Verdana');"
                                                               class="Verdana">Verdana</a></li>
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Georgia');"
                                                               class="Georgia">Georgia</a></li>
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Courier');"
                                                               class="Courier">Courier</a></li>
                                                        <li><a tabindex="-1" href="#"
                                                               onclick="setFont('Comic Sans MS');" class="ComicSansMS">Comic
                                                                Sans MS</a></li>
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Impact');"
                                                               class="Impact">Impact</a></li>
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Monaco');"
                                                               class="Monaco">Monaco</a></li>
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Optima');"
                                                               class="Optima">Optima</a></li>
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Hoefler Text');"
                                                               class="Hoefler Text">Hoefler Text</a></li>
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Plaster');"
                                                               class="Plaster">Plaster</a></li>
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Engagement');"
                                                               class="Engagement">Engagement</a></li>
                                                    </ul>
                                                    <button id="text-bold" type="button" class="btn"
                                                            data-original-title="Bold"><img
                                                            src="{{ asset('site_assets/designs/img/font_bold.png') }}"
                                                            height="" width=""></button>
                                                    <button id="text-italic" type="button" class="btn"
                                                            data-original-title="Italic"><img
                                                            src="{{ asset('site_assets/designs/img/font_italic.png') }}"
                                                            height="" width=""></button>
                                                    <button id="text-strike" type="button" class="btn" title="Strike"
                                                            style=""><img
                                                            src="{{ asset('site_assets/designs/img/font_strikethrough.png') }}"
                                                            height="" width=""></button>
                                                    <button id="text-underline" type="button" class="btn"
                                                            title="Underline" style=""><img
                                                            src="{{ asset('site_assets/designs/img/font_underline.png') }}">
                                                    </button>
                                                    <a class="btn" href="#" rel="tooltip" data-placement="top"
                                                       data-original-title="Font Color"><input type="hidden"
                                                                                               id="text-fontcolor"
                                                                                               class="color-picker"
                                                                                               size="7" value="#000000"></a>
                                                    <a class="btn" href="#" rel="tooltip" data-placement="top"
                                                       data-original-title="Font Border Color"><input type="hidden"
                                                                                                      id="text-strokecolor"
                                                                                                      class="color-picker"
                                                                                                      size="7"
                                                                                                      value="#000000"></a>
                                                    <input type="hidden" id="text-bgcolor" class="color-picker" size="7"
                                                           value="#ffffff">
                                                </div>
                                                <div class="pull-right" align="" id="imageeditor" style="display:none">
                                                    <div class="btn-group">
                                                        <button class="btn" type="button" id="bring-to-front"
                                                                title="Bring to Front"><i
                                                                class="icon-fast-backward rotate"
                                                                style="height:19px;"></i></button>
                                                        <button class="btn" type="button" id="send-to-back"
                                                                title="Send to Back"><i class="icon-fast-forward rotate"
                                                                                        style="height:19px;"></i>
                                                        </button>
                                                        {{--                                                        <button id="flip" type="button" class="btn" title="Show Back View"><i class="icon-retweet" style="height:19px;"></i></button>--}}
                                                        <button id="remove-selected" type="button" class="btn"
                                                                title="Delete selected item"><i class="icon-trash"
                                                                                                style="height:19px;"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--	EDITOR      -->
                                        <a href="#" id="downloadDesign" type="button" class="flip-shirt"
                                           style="top: 6%;right: 8%;" title="save View"><i
                                                class="icon-download-alt" style="height:19px;"></i></a>
                                        <!--	EDITOR      -->
                                        <button id="flipback" type="button" class="flip-shirt" title="Rotate View"><i
                                                class="icon-retweet" style="height:19px;"></i></button>
                                        <div id="shirtDiv" class="page"
                                             style="width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255);">
                                            <img name="tshirtview" id="tshirtFacing"
                                                 src="{{ Storage::url('products/'.$record->front_image) }}">
                                            <div id="drawingArea"
                                                 style="position: absolute;top: {{$record->site_front_top}}px;left: {{$record->site_front_left}}px;z-index: 1;width: {{$record->site_front_width}}px;height: {{$record->site_front_height}}px;">
                                                <canvas id="tcanvas" width="{{$record->site_front_width}}"
                                                        height="{{$record->site_front_height}}" class="hover"
                                                        style="-webkit-user-select: none;"></canvas>
                                            </div>
                                        </div>
                                        <div id="shirtBack" class="page"
                                             style="width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255); display:none;">
                                            <img src="{{ Storage::url('products/'.$record->back_image) }}">
                                            <div id="drawingArea"
                                                 style="position: absolute;top: {{$record->site_back_top}}px;left: {{$record->site_back_left}}px;z-index: 1;width: {{$record->site_back_width}}px;height: {{$record->site_back_height}}px;">
                                                <canvas id="backCanvas" width="{{$record->site_back_width}}"
                                                        height="{{$record->site_back_height}}" class="hover"
                                                        style="-webkit-user-select: none;"></canvas>
                                            </div>
                                        </div>

                                        <!--	/EDITOR		-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6  pl-3">
                                @livewire('site.add-product-to-wishlist' , ['product' => $record ] )
                                <h3 class="mb-3"> {{ $record->name }} </h3>
                                <div class="starrating risingstar d-inline-flex flex-row-reverse">
                                    <input type="radio" id="star5" name="rating" value="5"/><label
                                        class="fa fa-star"
                                        for="star5"
                                        title="5 star"></label>
                                    <input type="radio" id="star4" name="rating" value="4"/><label
                                        class="fa fa-star"
                                        for="star4"
                                        title="4 star"></label>
                                    <input type="radio" id="star3" name="rating" value="3"/><label
                                        class="fa fa-star"
                                        for="star3"
                                        title="3 star"></label>
                                    <input type="radio" id="star2" name="rating" value="2"/><label
                                        class="fa fa-star"
                                        for="star2"
                                        title="2 star"></label>
                                    <input type="radio" id="star1" name="rating" value="1"/><label
                                        class="fa fa-star"
                                        for="star1"
                                        title="1 star"></label>
                                </div>
                                <span class="px-2">(0 @lang('site.Review') )</span>

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
                                {{--                                <div class="select">--}}
                                {{--                                    <select name="size_id" required>--}}
                                {{--                                        <option> @lang('site.Select Size') </option>--}}
                                {{--                                        @foreach ($record->variations->unique('size_id') as $record_color_variation)--}}
                                {{--                                            <option--}}
                                {{--                                                value="{{$record_color_variation->size->id}}">{{$record_color_variation->size->name}}</option>--}}
                                {{--                                        @endforeach--}}
                                {{--                                    </select>--}}
                                {{--                                </div>--}}

                                {{--                                <input type="number" value="1" step="1" min="1" name="quantity" required>--}}
                                <div class="span7">
                                    <div class="well p-0 mt-1 mb-1">
                                        <h3>@lang('site.Select Size')</h3>
                                        <table class="table">
                                            @foreach ($record->variations->unique('size_id') as $record_color_variation)
                                                <tr>
                                                    <td><input name="sizes[]" type="checkbox" required
                                                               value="{{$record_color_variation->size->id}}">&emsp;{{$record_color_variation->size->name}}
                                                    </td>
                                                    <td><input name="quantities[]" min="0" value="1" type="number"
                                                               required></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <button type="submit"
                                        class="btn btn-large btn-block btn-primary bg-primary-gridant span7"
                                        style="margin-top: 1rem;"
                                        id="save">@lang('site.add-to-cart')
                                    <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                </button>
                                {{--                                <button type="submit" class="btn btn-primary p-3 ml-3 bg-primary-gridant" id="save">--}}
                                {{--                                    <i class="fas fa-cart-plus fa-lg mr-2"></i>--}}
                                {{--                                    @lang('site.add-to-cart')--}}
                                {{--                                </button>--}}


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
                                @foreach($designs as $design)
                                    <li>
                                        <a href="#">
                                            <div class="image-container">
                                                <img src="{{Storage::url('designs/'.$design->image)}}"
                                                     alt="User Image">
                                            </div>
                                        </a>
                                        <a class="users-list-name" href="{{$design->user->url() ?? ''}}"
                                           title="{{$design->user->name() ?? ''}}"> {{$design->user->name() ?? ''}} </a>
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

    <!-- Footer ================================================== -->
    <script>
        $(document).ready(function () {
            $("#drawingArea").hover(
                function () {
                    canvas.add(line1);
                    canvas.add(line2);
                    canvas.add(line3);
                    canvas.add(line4);
                    canvas.renderAll();
                },function () {
                    canvas.remove(line1);
                    canvas.remove(line2);
                    canvas.remove(line3);
                    canvas.remove(line4);
                    canvas.renderAll();
                }
            );

            line1 = new fabric.Line([0, 0, {{$record->site_front_width}}, 0], {
                "stroke": "#000000",
                "strokeWidth": 1,
                hasBorders: false,
                hasControls: false,
                hasRotatingPoint: false,
                selectable: false
            });
            line2 = new fabric.Line([{{$record->site_front_width-1}}, 0, {{$record->site_front_width}}, {{$record->site_front_height-1}}], {
                "stroke": "#000000",
                "strokeWidth": 1,
                hasBorders: false,
                hasControls: false,
                hasRotatingPoint: false,
                selectable: false
            });
            line3 = new fabric.Line([0, 0, 0, {{$record->site_front_height}}], {
                "stroke": "#000000",
                "strokeWidth": 1,
                hasBorders: false,
                hasControls: false,
                hasRotatingPoint: false,
                selectable: false
            });
            line4 = new fabric.Line([0, {{$record->site_front_height}}, {{$record->site_front_width}}, {{$record->site_front_height-1}}], {
                "stroke": "#000000",
                "strokeWidth": 1,
                hasBorders: false,
                hasControls: false,
                hasRotatingPoint: false,
                selectable: false
            });

            $("#tshirttype").change(function () {
                $("img[name=tshirtview]").attr("src", $(this).val());
            });
        });
    </script>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
        var valueSelect = $("#tshirttype").val();
        $("#tshirttype").change(function () {
            valueSelect = $(this).val();
        });
        $('#flipback').click(
            function () {
                if (valueSelect === "{{ Storage::url('products/'.$record->front_image) }}") {
                    if ($(this).attr("data-original-title") == "Show Back View") {
                        $('#flipback').attr('data-original-title', 'Show Front View');
                        $("#tshirtFacing").attr("src", "{{ Storage::url('products/'.$record->back_image) }}");
                        a = JSON.stringify(canvas);
                        canvas.clear();
                        try {
                            var json = JSON.parse(b);
                            canvas.loadFromJSON(b);
                        } catch (e) {
                        }
                    } else {
                        $('#flipback').attr('data-original-title', 'Show Back View');
                        $("#tshirtFacing").attr("src", "{{ Storage::url('products/'.$record->front_image) }}");
                        b = JSON.stringify(canvas);
                        canvas.clear();
                        try {
                            var json = JSON.parse(a);
                            canvas.loadFromJSON(a);
                        } catch (e) {
                        }
                    }
                }
                canvas.renderAll();
                setTimeout(function () {
                    canvas.calcOffset();
                }, 200);
            });

        $('#changeColorBtn').click(
            function () {
                $('#color_id').val($(this).data('color-id'));
            });

        $('#removeColorBtn').click(
            function () {
                $('#color_id').val('');
            });
    </script>
    <script src="{{ asset('site_assets/designs/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('site_assets/designs/js/tshirtEditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('site_assets/designs/js/jquery.miniColors.min.js') }}"></script>

@endsection

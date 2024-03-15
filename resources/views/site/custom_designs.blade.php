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
    {{--    <link type="text/css" rel="stylesheet" href="{{ asset('site_assets/designs/css/jquery.miniColors.css') }}"/>--}}
    {{--    <link href="{{ asset('site_assets/designs/css/bootstrap.min.css') }}" rel="stylesheet">--}}
    {{--    <link href="{{ asset('site_assets/designs/css/bootstrap-responsive.min.css') }}" rel="stylesheet">--}}
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
            width: 3rem;
            height: 3rem;
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
            padding: 1rem;
            font-size: 18px;
            background: #552e90;
            display: flex;
            justify-content: space-around;
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
            top: -1rem;
        }

        .span6 {
            width: 100% !important;
        }

        .span3 {
            width: 98% !important;
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
            right: 5%;
            top: 10%;
            z-index: 99;
            width: 3rem;
            height: 3rem;
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

        .color-picker {
            width: 1rem;
            height: 2rem !important;
            margin-top: 0.6rem;
        }

        #tshirtFacing, #tshirtFacingBack {
            margin: auto;
            display: block;
        }

    </style>
@endsection
@section('page_content')
    <div class="container">
        {{--                <div class="content-wrapper">--}}
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card-solid">
                <div class="card-header">
                    @if(count($errors))
                        @foreach($errors->all() as $error)
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{$error}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('cart.store')}}" enctype="multipart/form-data" id="myForm">
                        @csrf
                        <input type="hidden" name="product_id" id="product_id" value="{{$record->id}}"/>
                        <input type="hidden" id="design_front_photo" name="design_front_photo"/>
                        <input type="hidden" id="design_color_id" name="design_color_id"/>
                        <input type="hidden" id="main_image_width" name="main_image_width" value="530"/>
                        <input type="hidden" id="main_image_height" name="main_image_height" value="630"/>
                        <div class="row">
                            <div class="col-7" style="box-shadow: 0 0 10px 10px #00000012;">
                                <div class="row">
                                    <div class="span3">
                                        <div class="tabbable"> <!-- Only required for left/right tabs -->
                                            <ul class="nav nav-tabs">
                                                {{--                                                    <li class=""><a href="#tab1"--}}
                                                {{--                                                                    data-toggle="tab">{{__('site.colors')}} <i--}}
                                                {{--                                                                class="fa fa-palette"></i></a></li>--}}
                                                <li><a href="#tab2" data-toggle="tab">{{__('site.text')}} <i
                                                            class="fa fa-pen"></i></a></li>
                                                <li><a href="#tab3" data-toggle="tab">{{__('site.image')}} <i
                                                            class="fa fa-image"></i></a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane" id="tab1">
                                                    <button type="button" class="close remove-btn text-danger"
                                                            aria-label="Close"
                                                            onclick="$('.tab-pane').removeClass('active');$('.nav-tabs li').removeClass('active')">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
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
                                                    {{--                                                    <div class="well">--}}
                                                    {{--                                                        <ul class="nav">--}}
                                                    {{--                                                            <li class="color-preview" id="removeColorBtn"--}}
                                                    {{--                                                                data-color-id="#ffffff"--}}
                                                    {{--                                                                title="white"--}}
                                                    {{--                                                                style="background-color:#ffffff"></li>--}}
                                                    {{--                                                            @foreach ($record->variations->unique('color_id') as $record_color_variation)--}}
                                                    {{--                                                                <li class="color-preview" id="changeColorBtn"--}}
                                                    {{--                                                                    data-color-id="{{$record_color_variation->color->code}}"--}}
                                                    {{--                                                                    title="{{$record_color_variation->color->name}}"--}}
                                                    {{--                                                                    style="background-color:{{$record_color_variation->color->code}};">--}}
                                                    {{--                                                                </li>--}}
                                                    {{--                                                            @endforeach--}}
                                                    {{--                                                        </ul>--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                                <div class="tab-pane" id="tab2">
                                                    <button type="button" class="close remove-btn text-danger"
                                                            aria-label="Close"
                                                            onclick="$('.tab-pane').removeClass('active');$('.nav-tabs li').removeClass('active')">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <div class="well">
                                                        <div class="input-append">
                                                            <input class="span2" id="text-string" type="text"
                                                                   placeholder="{{__('site.add text here...')}}">
                                                            <button id="add-text" class="btn btn-sm"
                                                                    title="Add text"
                                                                    type="button"><i class="fa fa-share"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab3">
                                                    <button type="button" class="close remove-btn text-danger"
                                                            aria-label="Close"
                                                            onclick="$('.tab-pane').removeClass('active');$('.nav-tabs li').removeClass('active')">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <div class="well">
                                                        <div>
                                                            <input type="file" name="fileToUpload"
                                                                   id="fileToUpload">
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
                                                    <button id="font-family" class="btn dropdown-toggle"
                                                            type="button"
                                                            data-toggle="dropdown" title="Font Style"><i
                                                            class="icon-font" style="width:19px;height:19px;"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu"
                                                        aria-labelledby="font-family">
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Arial');"
                                                               class="Arial dropdown-item">Arial</a></li>
                                                        <li><a tabindex="-1" href="#"
                                                               onclick="setFont('Helvetica');"
                                                               class="Helvetica dropdown-item">Helvetica</a></li>
                                                        <li><a tabindex="-1" href="#"
                                                               onclick="setFont('Myriad Pro');"
                                                               class="MyriadPro dropdown-item">Myriad Pro</a></li>
                                                        <li><a tabindex="-1" href="#"
                                                               onclick="setFont('Delicious');"
                                                               class="Delicious dropdown-item">Delicious</a></li>
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Verdana');"
                                                               class="Verdana dropdown-item">Verdana</a></li>
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Georgia');"
                                                               class="Georgia dropdown-item">Georgia</a></li>
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Courier');"
                                                               class="Courier dropdown-item">Courier</a></li>
                                                        <li><a tabindex="-1" href="#"
                                                               onclick="setFont('Comic Sans MS');"
                                                               class="ComicSansMS dropdown-item">Comic
                                                                Sans MS</a></li>
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Impact');"
                                                               class="Impact dropdown-item">Impact</a></li>
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Monaco');"
                                                               class="Monaco dropdown-item">Monaco</a></li>
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Optima');"
                                                               class="Optima dropdown-item">Optima</a></li>
                                                        <li><a tabindex="-1" href="#"
                                                               onclick="setFont('Hoefler Text');"
                                                               class="Hoefler Text dropdown-item">Hoefler Text</a></li>
                                                        <li><a tabindex="-1" href="#" onclick="setFont('Plaster');"
                                                               class="Plaster dropdown-item">Plaster</a></li>
                                                        <li><a tabindex="-1" href="#"
                                                               onclick="setFont('Engagement');"
                                                               class="Engagement dropdown-item">Engagement</a></li>
                                                    </ul>
                                                    <button id="text-bold" type="button" class="btn"
                                                            data-original-title="Bold"><img
                                                            src="{{ asset('site_assets/designs/img/font_bold.png') }}"
                                                            height="" width=""></button>
                                                    <button id="text-italic" type="button" class="btn"
                                                            data-original-title="Italic"><img
                                                            src="{{ asset('site_assets/designs/img/font_italic.png') }}"
                                                            height="" width=""></button>
                                                    <button id="text-strike" type="button" class="btn"
                                                            title="Strike"
                                                            style=""><img
                                                            src="{{ asset('site_assets/designs/img/font_strikethrough.png') }}"
                                                            height="" width=""></button>
                                                    <button id="text-underline" type="button" class="btn"
                                                            title="Underline" style=""><img
                                                            src="{{ asset('site_assets/designs/img/font_underline.png') }}">
                                                    </button>
                                                    <input type="color"
                                                           id="text-fontcolor"
                                                           class="color-picker btn" title="Text Color"
                                                           size="7" value="#000000">
                                                    <input type="color" id="text-strokecolor"
                                                           class="color-picker btn" title="Border Color"
                                                           size="7"
                                                           value="#000000">
                                                </div>
                                                <div class="pull-right" align="" id="imageeditor"
                                                     style="display:none">
                                                    <div class="btn-group">
                                                        {{--                                                        <button class="btn" type="button" id="bring-to-front"--}}
                                                        {{--                                                                title="Bring to Front"><i--}}
                                                        {{--                                                                class="fa fa-fast-backward rotate"--}}
                                                        {{--                                                                style="height:19px;"></i></button>--}}
                                                        {{--                                                        <button class="btn" type="button" id="send-to-back"--}}
                                                        {{--                                                                title="Send to Back"><i--}}
                                                        {{--                                                                class="fa fa-fast-forward rotate"--}}
                                                        {{--                                                                style="height:19px;"></i>--}}
                                                        {{--                                                        </button>--}}
                                                        {{--                                                        <button id="flip" type="button" class="btn" title="Show Back View"><i class="icon-retweet" style="height:19px;"></i></button>--}}
                                                        <button id="remove-selected" type="button" class="btn"
                                                                title="Delete selected item"><i
                                                                class="fa fa-trash text-danger"
                                                                style="height:19px;"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--	EDITOR      -->
                                        {{--                                            <a href="#" id="downloadDesign" type="button" class="flip-shirt"--}}
                                        {{--                                               style="top: 9%;right: 5%;" title="save View"><i--}}
                                        {{--                                                    class="fa fa-download"></i></a>--}}
                                        <!--	EDITOR      -->
                                        <button id="flipback" type="button" class="flip-shirt" title="Rotate View">
                                            <i class="fa fa-rotate-right fa-lg"></i></button>
                                        <div id="shirtDiv" class="page"
                                             style="position: relative; background-color: rgb(255, 255, 255);">
                                            {{--                                            width: 530px; height: 630px;--}}
                                            <img name="tshirtview" id="tshirtFacing" style="width: 100%;height: 38rem;"
                                                 src="{{ Storage::url('products/'.$record->front_image) }}">
                                            <div id="drawingArea"
                                                 style="position: absolute;top: {{$record->site_front_top}}px;left: {{$record->site_front_left}}px;z-index: 1;width: {{$record->site_front_width}}px;height: {{$record->site_front_height}}px;">
                                                <canvas id="tcanvas" width="{{$record->site_front_width}}"
                                                        height="{{$record->site_front_height}}" class="hover"
                                                        style="-webkit-user-select: none;"></canvas>
                                            </div>
                                        </div>
                                        <div id="shirtBack" class="page"
                                             style="position: relative; background-color: rgb(255, 255, 255); display:none;">
                                            {{--                                            width: 530px; height: 630px;--}}
                                            <img name="tshirtviewBack" id="tshirtFacingBack"
                                                 src="{{ Storage::url('products/'.$record->back_image) }}">
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
                            <div class="col-5">
                                <div class="ProductPrice mb-3">
                                    <span class="price mr-3"> {{$record->price}} @lang('site.SAR') </span>
                                </div>
                                <div class="alert alert-warning" role="alert"
                                     style="background-color: #fff3cd;border-color: #fff3cd">
                                    @lang('site.alert_quantity')
                                </div>
                                <div class="span6" style="width: 90%;margin-top: 1rem;">
                                    <div class="well" style="border: 1px solid #ccc3c3;padding: 15px;">
                                        <h6 class="d-inline">@lang('site.order_quantity')</h6>
                                        <a href="#" type="button" class="btn btn-success float-left"
                                           id="add_sizes">@lang('site.add')</a>
                                        <hr>
                                        <div class="form-row">
                                            <div class="row" id="size_form">
                                                <div class="form-group col-4">
                                                    <select name="color_id[]" required
                                                            class="form-control @error('color_id') is-invalid @enderror">
                                                        <option> @lang('site.Select Color') </option>
                                                        @foreach ($record->variations->unique('color_id') as $record_color_variation)
                                                            <option
                                                                value="{{$record_color_variation->color->id}}">{{$record_color_variation->color->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('color_id')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-4">
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
                                                <div class="form-group col-3">
                                                    <input name="quantities[]" min="0" value="1" type="number"
                                                           class="form-control @error('quantities') is-invalid @enderror"
                                                           required>
                                                    @error('quantities')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-1">
                                                    <a href="#" class="text-danger float-left"
                                                       id="remove_sizes"><i class="fa fa-times"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="well">
                                        <h6>@lang('site.product_preview_color')</h6>
                                        <hr>
                                        <ul class="nav">
                                            <li class="color-preview" id="removeColorBtn"
                                                data-color-id="#ffffff"
                                                title="white"
                                                style="background-color:#ffffff"></li>
                                            @foreach ($record->variations->unique('color_id') as $record_color_variation)
                                                <li class="color-preview"
                                                    id="changeColorBtn{{$record_color_variation->color->id}}"
                                                    onclick="changeColor({{$record_color_variation->color->id}})"
                                                    data-color-id="{{$record_color_variation->color->code}}"
                                                    title="{{$record_color_variation->color->name}}"
                                                    style="background-color:{{$record_color_variation->color->code}};">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <button type="submit"
                                        class="btn btn-large btn-block btn-primary bg-primary-gridant span6"
                                        style="margin-top: 1rem;width: 90%"
                                        id="save">@lang('site.add-to-cart')
                                    <i class="fas fa-cart-plus fa-lg mr-2"></i>
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
    {{--    </div>--}}
@endsection

@section('scripts')

    <!----------- Slider Scripts --------->

    <!-- Footer ================================================== -->
    <script>
        $(function () {
            $("#add_sizes").on('click', function () {
                console.log('test')
                var ele = $('#size_form').clone(true);
                $('#size_form').closest('#size_form').before(ele);
            });
            $("#remove_sizes").on('click', function () {
                console.log('test remove')
                $(this).closest('#size_form').remove();
            });
        })
        $(document).ready(function () {


            $("#drawingArea").hover(
                function () {
                    canvas.add(line1);
                    canvas.add(line2);
                    canvas.add(line3);
                    canvas.add(line4);
                    canvas.renderAll();
                }, function () {
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

        $('#removeColorBtn').click(
            function () {
                $('#design_color_id').val('#ffffff');
                document.getElementById("shirtDiv").style.backgroundColor = '#ffffff';
            });

        function changeColor(id) {
            let color = $('#changeColorBtn' + id).data('color-id');
            $('#design_color_id').val(color);
            document.getElementById("shirtDiv").style.backgroundColor = color;
        }
    </script>
    <script src="{{ asset('site_assets/designs/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('site_assets/designs/js/tshirtEditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('site_assets/designs/js/jquery.miniColors.min.js') }}"></script>

@endsection

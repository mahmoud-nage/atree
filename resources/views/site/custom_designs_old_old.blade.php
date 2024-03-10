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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
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
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="span3">
                                            <div class="tabbable"> <!-- Only required for left/right tabs -->
                                                <div class="tab-content">
                                                    <div class="tab-pane" id="tab1">
                                                        <div class="well">
                                                            <select id="tshirttype" class="d-none">
                                                                <option value="{{ Storage::url('products/'.$record->front_image) }}" selected="selected">Short Sleeve Shirts</option>
                                                            </select>
                                                            <!--						      </p>-->
                                                        </div>
                                                        <div class="well">
                                                            <ul class="nav">
                                                                @foreach ($record->variations->unique('color_id') as $record_color_variation)
                                                                    <li class="color-preview"
                                                                        title="{{$record_color_variation->color->name}}"
                                                                        style="background-color:{{ $record_color_variation->color->code }};"></li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab2">
                                                        <div class="well">
                                                            <div id="avatarlist">
                                                            </div>
                                                            <div>
                                                                <hr>
                                                                <input type="file" name="fileToUpload"
                                                                       id="fileToUpload">
                                                                <button id="add-image" class="btn" title="Add image"
                                                                        type="button">
                                                                    <i class="fa fa-share-alt"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab3">
                                                        <div class="well">
                                                            <div class="input-append">
                                                                <input class="span2" id="text-string" type="text"
                                                                       placeholder="add text here...">
                                                                <button id="add-text" class="btn" title="Add text"
                                                                        type="button">
                                                                    <i class="fa fa-share-alt"></i></button>
                                                                <hr>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span6">
                                            <div align="center" style="min-height: 32px;">
                                                <div class="clearfix">
                                                    <div class="btn-group inline pull-left" id="texteditor"
                                                         style="display:none">
                                                        <button id="font-family" class="btn dropdown-toggle"
                                                                data-toggle="dropdown" title="Font Style"><i
                                                                class="icon-font" type="button"
                                                                style="width:19px;height:19px;"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu"
                                                            aria-labelledby="font-family-X">
                                                            <li><a tabindex="-1" href="#"
                                                                   onclick="setFont('Arial');"
                                                                   class="Arial">Arial</a></li>
                                                            <li><a tabindex="-1" href="#"
                                                                   onclick="setFont('Helvetica');"
                                                                   class="Helvetica">Helvetica</a>
                                                            </li>
                                                            <li><a tabindex="-1" href="#"
                                                                   onclick="setFont('Myriad Pro');"
                                                                   class="MyriadPro">Myriad
                                                                    Pro</a></li>
                                                            <li><a tabindex="-1" href="#"
                                                                   onclick="setFont('Delicious');"
                                                                   class="Delicious">Delicious</a>
                                                            </li>
                                                            <li><a tabindex="-1" href="#"
                                                                   onclick="setFont('Verdana');"
                                                                   class="Verdana">Verdana</a></li>
                                                            <li><a tabindex="-1" href="#"
                                                                   onclick="setFont('Georgia');"
                                                                   class="Georgia">Georgia</a></li>
                                                            <li><a tabindex="-1" href="#"
                                                                   onclick="setFont('Courier');"
                                                                   class="Courier">Courier</a></li>
                                                            <li><a tabindex="-1" href="#"
                                                                   onclick="setFont('Comic Sans MS');"
                                                                   class="ComicSansMS">Comic Sans MS</a></li>
                                                            <li><a tabindex="-1" href="#"
                                                                   onclick="setFont('Impact');"
                                                                   class="Impact">Impact</a></li>
                                                            <li><a tabindex="-1" href="#"
                                                                   onclick="setFont('Monaco');"
                                                                   class="Monaco">Monaco</a></li>
                                                            <li><a tabindex="-1" href="#"
                                                                   onclick="setFont('Optima');"
                                                                   class="Optima">Optima</a></li>
                                                            <li><a tabindex="-1" href="#"
                                                                   onclick="setFont('Hoefler Text');"
                                                                   class="Hoefler Text">Hoefler Text</a></li>
                                                            <li><a tabindex="-1" href="#"
                                                                   onclick="setFont('Plaster');"
                                                                   class="Plaster">Plaster</a></li>
                                                            <li><a tabindex="-1" href="#"
                                                                   onclick="setFont('Engagement');"
                                                                   class="Engagement">Engagement</a>
                                                            </li>
                                                        </ul>
                                                        <button id="text-bold" class="btn" type="button"
                                                                data-original-title="Bold">
                                                            <img
                                                                src="{{ asset('site_assets/designs/img/font_bold.png') }}"
                                                                height="" width="">
                                                        </button>
                                                        <button id="text-italic" class="btn" type="button"
                                                                data-original-title="Italic"><img
                                                                src="{{ asset('site_assets/designs/img/font_italic.png') }}"
                                                                height="" width="">
                                                        </button>
                                                        <button id="text-strike" class="btn" title="Strike"
                                                                type="button"
                                                                style="">
                                                            <img
                                                                src="{{ asset('site_assets/designs/img/font_strikethrough.png') }}"
                                                                height=""
                                                                width="">
                                                        </button>
                                                        <button id="text-underline" class="btn" title="Underline"
                                                                type="button"
                                                                style=""><img
                                                                src="{{ asset('site_assets/designs/img/font_underline.png') }}">
                                                        </button>
                                                        <a class="btn" href="#" rel="tooltip" data-placement="top"
                                                           data-original-title="Font Color"><input type="hidden"
                                                                                                   id="text-fontcolor"
                                                                                                   class="color-picker"
                                                                                                   size="7"
                                                                                                   value="#000000"></a>
                                                        <a class="btn" href="#" rel="tooltip" data-placement="top"
                                                           data-original-title="Font Border Color"><input
                                                                type="hidden"
                                                                id="text-strokecolor"
                                                                class="color-picker"
                                                                size="7"
                                                                value="#000000"></a>
                                                        <!--- Background <input type="hidden" id="text-bgcolor" class="color-picker" size="7" value="#ffffff"> --->
                                                    </div>
                                                    <div class="pull-right" align="" id="imageeditor"
                                                         style="display:none">
                                                        <div class="btn-group">
                                                            <button class="btn" id="bring-to-front" type="button"
                                                                    title="Bring to Front"><i
                                                                    class="icon-fast-backward rotate"
                                                                    style="height:19px;"></i></button>
                                                            <button class="btn" id="send-to-back" type="button"
                                                                    title="Send to Back">
                                                                <i class="icon-fast-forward rotate"
                                                                   style="height:19px;"></i></button>
{{--                                                            <button id="flip" type="button" class="btn"--}}
{{--                                                                    title="Show Back View"><i class="icon-retweet"--}}
{{--                                                                                              style="height:19px;"></i>--}}
{{--                                                            </button>--}}
                                                            <button id="remove-selected" class="btn" type="button"
                                                                    title="Delete selected item"><i
                                                                    class="icon-trash"
                                                                    style="height:19px;"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--	EDITOR      -->

                                            <div id="shirtBack" class="page"
                                                 style="width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255); display:none;">
                                                <img src="{{ Storage::url('products/'.$record->back_image) }}">
                                                <div id="drawingArea"
                                                     style="position: absolute;top: 100px;left: 160px;z-index: 10;width: 200px;height: 400px;">
                                                    <canvas id="backCanvas" width=200 height="400" class="hover"
                                                            style="-webkit-user-select: none;"></canvas>
                                                </div>
                                            </div>

                                            <!--	/EDITOR		-->
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <ul class="nav nav-tabs">
                                            <li><a href="#tab2" data-toggle="tab">Image</a></li>
                                            <li><a href="#tab3" data-toggle="tab">Text</a></li>
                                            <li><a href="#tab1" data-toggle="tab">Colors</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-12">
                                        <button id="flipback" type="button" class="btn" title="Rotate View"
                                                data-original-title="Show Back View">
                                            <i class="fa fa-rotate-right"></i>
                                        </button>

                                        <div id="shirtDiv" class="page"
                                             style="width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255);">
                                            <img name="tshirtview" id="tshirtFacing"
                                                 src="{{ Storage::url('products/'.$record->front_image) }}">
                                            <div id="drawingArea"
                                                 style="position: absolute;top: 100px;left: 160px;z-index: 10;width: 200px; height: 400px;">
                                                <canvas id="tcanvas" width="200" height="400" class="hover"
                                                        style="-webkit-user-select: none;"></canvas>
                                            </div>
                                        </div>
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
                                <div class="select">
                                    <select name="size_id" required>
                                        <option> @lang('site.Select Size') </option>
                                        @foreach ($record->variations->unique('size_id') as $record_color_variation)
                                            <option
                                                value="{{$record_color_variation->size->id}}">{{$record_color_variation->size->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="number" value="1" step="1" min="1" name="quantity" required>

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
    </script>
    <script src="{{ asset('site_assets/designs/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('site_assets/designs/js/tshirtEditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('site_assets/designs/js/jquery.miniColors.min.js') }}"></script>
    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-35639689-1']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();

    </script>
@endsection

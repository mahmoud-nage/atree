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

            <div class="card card-widget">
                <div class="card-header">
                    <div class="user-block">
                        <img class="img-circle" src="img/user1-128x128.jpg" alt="User Image">
                        <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                        <span class="description">@Jonathan</span>
                    </div>
                    <!-- /.user-block -->
                    <div class="card-tools">
                        <span class="text-muted p-4"> 12 H </span>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="Product-details.html" class="text-center post-image-container">
                        <div class="badge badge-light">200 <span>SAR</span></div>
                        <img class="img-fluid pad" src="img/tshirt-4.jpg" alt="Photo">
                    </a>

                    <p>I took this photo this morning. What do you guys think?</p>
                    <div class="tag-btns-container">
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        </ul>
                    </div>

                </div>



            </div>

            <div class="card card-widget">
                <div class="card-header">
                    <div class="user-block">
                        <img class="img-circle" src="img/user1-128x128.jpg" alt="User Image">
                        <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                        <span class="description">@Jonathan</span>
                    </div>
                    <!-- /.user-block -->
                    <div class="card-tools">
                        <span class="text-muted p-4"> 12 H </span>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="Product-details.html" class="text-center post-image-container">
                        <div class="badge badge-light">200 <span>SAR</span></div>
                        <img class="img-fluid pad" src="img/tshirt-5.jpg" alt="Photo">
                    </a>

                    <p>I took this photo this morning. What do you guys think?</p>
                    <div class="tag-btns-container">
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        </ul>
                    </div>

                </div>



            </div>



            <div class="card card-widget">
                <div class="card-header">
                    <div class="user-block">
                        <img class="img-circle" src="img/user1-128x128.jpg" alt="User Image">
                        <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                        <span class="description">@Jonathan</span>
                    </div>
                    <!-- /.user-block -->
                    <div class="card-tools">
                        <span class="text-muted p-4"> 12 H </span>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="Product-details.html" class="text-center post-image-container">
                        <div class="badge badge-light">200 <span>SAR</span></div>
                        <img class="img-fluid pad" src="img/front.png" alt="Photo">
                    </a>

                    <p>I took this photo this morning. What do you guys think?</p>
                    <div class="tag-btns-container">
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        </ul>
                    </div>

                </div>



            </div>

            <div class="card card-widget">
                <div class="card-header">
                    <div class="user-block">
                        <img class="img-circle" src="img/user1-128x128.jpg" alt="User Image">
                        <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                        <span class="description">@Jonathan</span>
                    </div>
                    <!-- /.user-block -->
                    <div class="card-tools">
                        <span class="text-muted p-4"> 12 H </span>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="Product-details.html" class="text-center post-image-container">
                        <div class="badge badge-light">200 <span>SAR</span></div>
                        <img class="img-fluid pad" src="img/front-1.JPG" alt="Photo">
                    </a>

                    <p>I took this photo this morning. What do you guys think?</p>
                    <div class="tag-btns-container">
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        <a href="#" class="btn tag-btn"> Tag link </a>
                        </ul>
                    </div>

                </div>



            </div>



        </div>
        <!-- /.col -->
        @include('site.layouts.sidebar_left')
    </div>
    <!-- /.row -->
@endsection

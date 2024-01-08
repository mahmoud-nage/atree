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

    <!-- Main content -->
    <section class="content">
        <div class="card-body">
            <div class="row">
                <!-- Wishlist Container container -->
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title my-1"> @lang('site.Your Wishlist') </h4>
                        </div>
                        <div class="card-body category-container">
                            @livewire('site.wishlist')
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <!-- Right side -->
                @include('site.layouts.sidebar_left2')
            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection

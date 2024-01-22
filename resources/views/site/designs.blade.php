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
            @forelse($records as $record)
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
                            <img class="img-fluid pad" src="{{Storage::url('designs/'.$record->image)}}" alt="Photo">
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
        <!-- /.col -->
        @include('site.layouts.sidebar_left')
    </div>
    <!-- /.row -->
@endsection

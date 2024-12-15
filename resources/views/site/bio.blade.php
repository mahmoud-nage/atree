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
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="card card-widget widget-user" style="width: 100%">
                <div class="widget-user-header text-white"
                     style="background: url('{{ Storage::url('users/'.$user->banner) }}') center center;">
                    {{--                    <label class="upload-icon fa fa-image">--}}
                    {{--                        <input id="panner-background" type="file">--}}
                    {{--                    </label>--}}
                </div><!-- Add the bg color to the header using any of the bg-* classes -->


            </div><!-- /.col -->
            <div class="col-md-1"></div>
            <div class="bio-header col-md-10 col-12 ">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="bio-user-image">
                            <img class="img-circle" src="{{ Storage::url('users/'.$user->image) }}" alt="User Avatar">
                            {{--                    <label class="upload-icon fa fa-image">--}}
                            {{--                        <input id="file-input" type="file"/>--}}
                            {{--                    </label>--}}
                        </div>
                        <div class="bio-user-info">
                            <h5 class="widget-user-desc text-center  text-bold mb-1"> {{ $user->name() }} </h5>
                            <h3 class="widget-user-username text-center  mb-3">@ {{ $user->username }}</h3>
                        </div>
                    </div>
                    <div class="col-md-8 col-12">
                        <div class=" d-flex justify-content-end">
                            <div class="bio-user-info" style="margin: 0 0.5rem;">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#followersPopup">
                                    {{$user->followers_count ?? 0}} @lang('site.Followers') </button>
                            </div>
                            {{--                            @if(auth()->check() && auth()->id() == $user->id)--}}
                            {{--                                <div class="bio-user-info" style="margin: 0 0.5rem;">--}}
                            {{--                                    <a type="button" class="btn btn-primary" data-toggle="modal"--}}
                            {{--                                       data-target="#diamondsPopup">--}}
                            {{--                                        {{$user->total_diamonds ?? 0}} @lang('site.Diamond') </a>--}}
                            {{--                                </div>--}}
                            {{--                            @endif--}}
                            @if(auth()->check() && auth()->id() == $user->id)
                                <div class="bio-user-info" style="margin: 0 0.5rem;">
                                    <a type="button" class="btn btn-primary"
                                       href="{{ route('profile.index') }}"> @lang('site.Settings') </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="modal fade" id="followersPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">@lang('site.My Followers')</h5>
                        </div>
                        <div class="modal-body">
                            @foreach ($user->followers as $follower)
                                <div class="card artest-card">
                                    <div class="card-body">
                                        <div class="img-container">
                                            <img src="{{ Storage::url('users/'.$follower->designer->image) }}" alt="">
                                        </div>
                                        <h5 class="card-title text-truncate"> {{ $follower?->designer->name() }} </h5>
                                        <a href='{{ $follower->designer?->url() }}'
                                           class="card-text text-truncate"> @lang('site.Profile') </a>
                                    </div>
                                    <div class="card-footer">
                                        @livewire('site.follow-user', ['designer' => $follower->designer ] ,
                                        key($follower->designer->id) )
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"
                                    data-dismiss="modal">{{__('site.close')}}</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //////////////////////////////////// -->
            <div class="col-1"></div>
            <div class="col-md-10 ">
                <div class="card p-2 " style="margin-top: 3rem;">

                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <h5 class="font-weight-bold"> @lang('site.Bio') </h5>
                        {{--                        <div>--}}
                        {{--                            <button type="button" class="btn circle-btn fa fa-edit" style="background: #eee;"></button>--}}
                        {{--                        </div>--}}
                    </div>

                    <p>
                        {{ $user->bio }}
                    </p>

                </div>
            </div>
            <div class="col-1"></div>
            @if(auth()->check() && auth()->id() == $user->id)
                <div class="col-md-1"></div>
                <div class="col-md-10 col-12">
                    <div class="diamond-header">
                        <div class="diamond-header-left">
                            <div class="font-weight-bold "><span
                                    class="diamond-title">{{__('site.My Diamonds')}} </span> </div>
                            <div class="diamond-progress-header">
                                <div> {{$user->total_diamonds}} </div>
                                <div> {{__('site.Diamond')}} </div>
                            </div>
                            <div class="diamond-progress-header">
                                <div> {{round($user->total_diamonds / 100, 2)}} </div>
                                <div> {{__('site.SAR')}} </div>
                            </div>
                        </div>

                        <div class="diamond-header-right">
                            <div class="mb-4">
                                {{__('site.Earn More Every Day By stilling Be Amazing Designer')}}
                            </div>
                            <div class="diamond-progress-header">
                                <div class="diamond-title"> {{__('site.Diamonds')}} </div>
                                <div class="diamond-total">{{$user->total_diamonds}}</div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="{{round((auth()->user()->total_diamonds / 10000)*100)}}" aria-valuemin="0"
                                     aria-valuemax="100" style="width: {{round((auth()->user()->total_diamonds / 10000)*100)}}">
                                </div>
                            </div>
                            <div>
                                {{__('site.Complete 10000 Diamond To enable Using')}}
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-md-1"></div>
            @endif
            <!-- Order list Container -->
            <div class="col-1"></div>
            <div class="col-md-10">
                @livewire('site.create-design')

                <!-- Order list item -->
                {{--                <div class="card card-primary bio-content">--}}
                {{--                    <div class="card-header">--}}
                {{--                        <div>--}}
                {{--                            <p class="card-title text-lg font-weight-bold mb-0">Create</p>--}}
                {{--                            <p class="font-weight-normal mb-0">Your Owen Design</p>--}}
                {{--                        </div>--}}


                {{--                        <div class="ml-auto">--}}
                {{--                            <a href="custom-designs.html" class="btn circle-btn fa fa-plus"></a>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="card-body">--}}
                {{--                        @forelse($user->designs as $record)--}}
                {{--                            <!-------------------------- Posts List --------------------------->--}}
                {{--                            <div class="card card-widget mb-3">--}}
                {{--                                <div class="card-header">--}}
                {{--                                    <div class="user-block">--}}
                {{--                                        <img class="img-circle" src="{{ Storage::url('users/'.$user->image) }}" alt="User Image">--}}
                {{--                                        <span class="username"><a href="{{$record->user->url() ?? ''}}">{{$record->user->name() ?? ''}}</a></span>--}}
                {{--                                        <span class="description">@ {{$record->user->username ?? ''}}</span>--}}
                {{--                                        <span class=" @if($record->is_active) text-success @else text-danger @endif">@if($record->is_active) {{__('site.active')}} @else {{__('site.deactive')}} @endif</span>--}}
                {{--                                    </div>--}}
                {{--                                    <!-- /.user-block -->--}}
                {{--                                    <div class="card-tools">--}}
                {{--                                        <span class="text-muted p-4"> 12 H </span>--}}
                {{--                                    </div>--}}
                {{--                                    <!-- /.card-tools -->--}}
                {{--                                </div>--}}
                {{--                                <!-- /.card-header -->--}}
                {{--                                <div class="card-body">--}}
                {{--                                    <a href="#" class="text-center post-image-container">--}}
                {{--                                        <div class="badge badge-light">200 <span>SAR</span></div>--}}
                {{--                                        <img class="img-fluid pad" src="{{Storage::url('designs/'.$record->image)}}" alt="Photo">--}}
                {{--                                    </a>--}}

                {{--                                    <p>{{$record->description}}</p>--}}
                {{--                                    <div class="tag-btns-container">--}}
                {{--                                        <ul>--}}
                {{--                                            @foreach($record->products as $product)--}}
                {{--                                                <a href="{{ $product->url() }}" class="btn tag-btn"> {{$product->name}} </a>--}}
                {{--                                            @endforeach--}}
                {{--                                        </ul>--}}
                {{--                                    </div>--}}

                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        @empty--}}
                {{--                            <div class="alert alert-primary" role="alert">--}}
                {{--                                @lang('site.no_records')--}}
                {{--                            </div>--}}
                {{--                        @endforelse--}}
                {{--                        <!-------------------------- Posts List --------------------------->--}}
                {{--                        <div class="section used-design">--}}
                {{--                            <div class="title d-flex justify-content-between col-md-12">--}}
                {{--                                <h5 class="mb-2">@lang('site.latest_designs')</h5>--}}
                {{--                                <a href="{{route('my_designs')}}" class="text-sm text-dark"> more</a>--}}
                {{--                            </div>--}}

                {{--                            <ul class="users-list clearfix">--}}
                {{--                                @foreach($latest_designs as $latest_design)--}}
                {{--                                    <li>--}}
                {{--                                        <a href="{{$record->user->url() ?? ''}}">--}}
                {{--                                            <div class="image-container">--}}
                {{--                                                <img src="{{ Storage::url('designs/'.$record->image) }}" alt="User Image">--}}
                {{--                                            </div>--}}
                {{--                                        </a>--}}
                {{--                                        <a class="users-list-name" href="{{$record->user->url() ?? ''}}">{{$record->user->name() ?? ''}}</a>--}}
                {{--                                    </li>--}}
                {{--                                @endforeach--}}
                {{--                            </ul>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
            <div class="col-1"></div>
        </div>
        <!-- /.row -->
    </div>
@endsection



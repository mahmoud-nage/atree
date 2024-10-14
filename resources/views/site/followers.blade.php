@extends('site.layouts.master')

@section('page_content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="title d-flex justify-content-between col-md-12">
                        <h5 class="mb-2"> @lang('site.My Followers') </h5>
{{--                        <a href="Products.html" class="text-sm text-dark"> more</a>--}}
                    </div>
                    @foreach ($followers as $follower)
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
                <!-- /.col -->
                @include('site.layouts.sidebar_left')
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection

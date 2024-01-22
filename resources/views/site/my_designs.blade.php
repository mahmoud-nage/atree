@extends('site.layouts.master')

@section('page_content')
    <div class="row">
        <div class="col-md-9">
            @livewire('site.create-design')
        </div>
        <!-- /.col -->
        @include('site.layouts.sidebar_left')
    </div>
@endsection

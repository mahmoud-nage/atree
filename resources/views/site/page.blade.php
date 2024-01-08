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
  <div class="content-wrapper">

    <div class="header-panner-container">
      <div class="header-panner text-white" style="background-image: url('{{ asset('site_assets/'.$dir.'/images/about.png') }}');">
       {{ $page->title }}
      </div>
    </div>

    <div class="col-sm-12">
      <ol class="breadcrumb container">
        <li class="breadcrumb-item"><a href="index.html"> @lang('site.Home') </a></li>
        <li class="breadcrumb-item active"> {{ $page->title }} </li>
      </ol>
    </div>

    <section class="content inner-pages-content">
      <div class="container inner-pages-container">
       
       <section>

          <p class="mb-4">
            {!! $page->content !!}
          </p>
       </section>
              

        
      </div>
      <!-- /.container-fluid -->

    </section>

  </div>

@endsection
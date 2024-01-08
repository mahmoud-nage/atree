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
    <div class="header-panner text-white" style="background-image: url('{{ asset('site_assets/'.$dir.'/images/contact-us-panner.png') }}');">
     @lang('site.Contact Us') 
   </div>
 </div>

 <div class="col-sm-12">
  <ol class="breadcrumb container">
    <li class="breadcrumb-item"><a href="{{ url('/') }}"> @lang('site.Home') </a></li>
    <li class="breadcrumb-item active"> @lang('site.Contact Us') </li>
  </ol>
</div>


<section class="content inner-pages-content">
  <div class="container inner-pages-container">


    <div class="row">

      <div class="col-6 text-center d-flex justify-content-center">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27612.84495186347!2d31.317777963476566!3d30.105479290289782!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1458158a9a0d791f%3A0x7529fe67e633be7c!2sSt.%20Mark%20Coptic%20cathedral!5e0!3m2!1sen!2seg!4v1684960022051!5m2!1sen!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

      @livewire('site.contact-us-form')

    </div>
  </div>
  <!-- /.container-fluid -->

</section>
</div>

@endsection

@section('scripts')
@endsection
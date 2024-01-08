@php
$lang = LaravelLocalization::getCurrentLocale();
if ($lang == 'ar') {
  $dir = 'rtl';
} else {
  $dir = 'ltr';
}
@endphp
<div class="section footer-sidebar">
  <ul class="footer-sidebar-list">
    <li><a href="{{ route('contact') }}"> @lang('site.Contact Us') </a></li>
    @foreach ($data['pages'] as $page)
    <li><a href="{{ route('pages.show' , ['page' => $page->id.'-'.$page->title ] ) }}"> {{ $page->title }} </a></li>
    @endforeach
    <li><a href="{{ $data['settings']->facebook }}" class="fab fa-facebook"></a></li>
    <li><a href="{{ $data['settings']->twitter }}" class="fab fa-twitter"></a></li>
    <li><a href="{{ $data['settings']->instagram }}" class="fab fa-instagram"></a></li>
    <li class="col-md-6 mb-2 p-2"><a href="#"> <img class="vatFotter" src="{{ asset('site_assets/'.$dir.'/images/VAT.png') }}"/> </a></li>
    <li class="col-md-6 mb-2 p-2"><a href="#"> <img src="{{ asset('site_assets/'.$dir.'/images/maroofStamp.png') }}"/> </a></li>
    <li class="col-md-6 p-2"><a href="{{ $data['settings']->android_link }}"> <img class="vatFotter" src="{{ asset('site_assets/'.$dir.'/images/googleplay.png') }}"/> </a></li>
    <li class="col-md-6 p-2"><a href="{{ $data['settings']->ios_link }}"> <img src="{{ asset('site_assets/'.$dir.'/images/appstore.png') }}"/> </a></li>
  </ul>
  <p> @lang('site.All Rights Reserved') </p>
</div>

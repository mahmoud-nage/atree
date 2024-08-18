@php
    $lang = LaravelLocalization::getCurrentLocale();
    if ($lang == 'ar') {
      $dir = 'rtl';
    } else {
      $dir = 'ltr';
    }
@endphp
@if(!in_array(request()->route()->getName(), ['login.post', 'login.form', 'register.form','register.post','verify_phone.index','verify_phone.store',
'password.request','password.send','password.check','password.newPassword']))
    <footer class="login-footer text-center">
        <div class="d-sm-block">
            <i class="fa fa-mobile-alt"></i> <span
                class="text-sm text-muted px-2"> {{__('site.Download App Now')}} </span>
        </div>
        <div class="appIcons my-2">
            <a href="{{ $data['settings']->android_link }}"><img
                    src="{{ asset('site_assets/'.$dir.'/images/googleplay.png') }}"/></a>
            <a href="{{ $data['settings']->ios_link }}"><img
                    src="{{ asset('site_assets/'.$dir.'/images/appstore.png') }}"/></a>
        </div>
        <div class="login-fotter-links">
            <a href="{{ route('contact') }}">@lang('site.Contact Us')</a>
            @foreach ($data['pages'] as $page)
                <a href="{{ route('pages.show' , ['page' => $page->id.'-'.$page->title ] ) }}">{{ $page->title }}</a>
            @endforeach
        </div>
        <div class="text-bold py-1" style="color: black;font-size: 10px;">@lang('site.All Rights Reserved')</div>
    </footer>
@endif
<div class="section footer-sidebar">
    <ul class="footer-sidebar-list">
        <li><a href="{{ route('contact') }}"> @lang('site.Contact Us') </a></li>
        @foreach ($data['pages'] as $page)
            <li><a
                    href="{{ route('pages.show' , ['page' => $page->id.'-'.$page->title ] ) }}"> {{ $page->title }} </a>
            </li>
        @endforeach
    </ul>
    <ul class="footer-sidebar-list">

        <li><a href="{{ $data['settings']->facebook }}" class="fab fa-facebook"></a></li>
        <li><a href="{{ $data['settings']->twitter }}" class="fab fa-twitter"></a></li>
        <li><a href="{{ $data['settings']->instagram }}" class="fab fa-instagram"></a></li>
    </ul>
    <ul class="footer-sidebar-list">
        <li class="col-md-6 mb-2 p-2"><a href="{{ $data['settings']->vat }}"> <img class="vatFotter"
                                                                                   src="{{ asset('site_assets/'.$dir.'/images/VAT.png') }}"/>
            </a>
        </li>
        <li class="col-md-6 mb-2 p-2"><a href="{{ $data['settings']->maroof }}"> <img
                    src="{{ asset('site_assets/'.$dir.'/images/maroofStamp.png') }}"/> </a></li>

        <li class="col-md-6 p-2"><a href="{{ $data['settings']->android_link }}">
                <img class="vatFotter"
                     src="{{ asset('site_assets/'.$dir.'/images/googleplay.png') }}"/>
            </a></li>
        <li class="col-md-6 p-2"><a href="{{ $data['settings']->ios_link }}"> <img
                    src="{{ asset('site_assets/'.$dir.'/images/appstore.png') }}"/> </a></li>
    </ul>
    <p> @lang('site.All Rights Reserved') </p>
</div>

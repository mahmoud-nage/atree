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

            <div class="container">
                <!-- Diamond Header -->
                <div class="diamond-header">
                    <div class="diamond-header-left">
                        <div class="font-weight-bold "><span
                                class="diamond-title">{{__('site.My Diamonds')}} </span> </div>
                        <div class="diamond-progress-header">
                            <div> {{auth()->user()->total_diamonds}} </div>
                            <div> {{__('site.Diamond')}} </div>
                        </div>
                        <div class="diamond-progress-header">
                            <div> {{round(auth()->user()->total_diamonds / 100, 2)}} </div>
                            <div> {{__('site.SAR')}} </div>
                        </div>
                    </div>

                    <div class="diamond-header-right">
                        <div class="mb-4">
                            {{__('site.Earn More Every Day By stilling Be Amazing Designer')}}
                        </div>
                        <div class="diamond-progress-header">
                            <div class="diamond-title"> {{__('site.Diamonds')}} </div>
                            <div class="diamond-total">{{auth()->user()->total_diamonds}}</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="{{round((auth()->user()->total_diamonds / 10000)*100)}}" aria-valuemin="0"
                                 aria-valuemax="100" style="{{round((auth()->user()->total_diamonds / 10000)*100)}}">
                            </div>
                        </div>
                        <div>
                            {{__('site.Complete 10000 Diamond To enable Using')}}
                        </div>

                    </div>

                </div>

                <div class="font-weight-bold mb-3 text-lg">
                    How Diamond Program Work ?
                </div>

                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                    the industry’s standard
                    dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it
                    to make a type specimen
                    book. It has survived not only five centuries, but also the leap into electronic typesetting,
                    remaining essentially
                    unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem
                    Ipsum passages, and more
                    recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
                    Lorem Ipsum is simply
                    dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s
                    standard dummy text ever since
                    the 1500s, when an unknown printer took a galley of type and scrambled it to make a type
                    specimen book. It has survived
                    not only five centuries, but also the leap into electronic typesetting, remaining essentially
                    unchanged. It was
                    popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                    and more recently with
                    desktop publishing software like Aldus PageMaker including versions of Lorem IpsumLorem Ipsum is
                    simply dummy text of
                    the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text
                    ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It
                    has survived not only
                    five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    It was popularised in
                    the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently
                    with desktop publishing
                    software like Aldus PageMaker including versions of Lorem IpsumLorem Ipsum is simply dummy text
                    of the printing and
                    typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the
                    1500s, when an unknown
                    printer took a galley of type and scrambled it to make a type specimen book. It has survived not
                    only five centuries,
                    but also the leap into electronic typesetting, remaining essentially unchanged. It was
                    popularised in the 1960s with the
                    release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                    publishing software like
                    Aldus PageMaker including versions of Lorem Ipsum
                </p>


            </div>

        </div>

    </section>
    <!-- /.content -->
    <!-- /.content-wrapper -->
@endsection

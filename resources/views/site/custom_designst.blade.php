@php
    $lang = LaravelLocalization::getCurrentLocale();
    if ($lang == 'ar') {
      $dir = 'rtl';
    } else {
      $dir = 'ltr';
    }
@endphp
@extends('site.layouts.master')
@section('styles')

@endsection
@section('page_content')
    <div class="container">
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card-solid">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('cart.store')}}" enctype="multipart/form-data" id="myForm">
                        @csrf
                        <div id="capture" style="padding: 10px; background: #f5da55">
                            <h4 style="color: #000; ">Hello world!</h4>
                            <input type="hidden" name="image" id="download" href="triangle.png">
                        </div>
                        <div id="capture1" style="padding: 10px; background: #000000">
                            <h4 style="color: #fff; ">Hello world!</h4>
                            <input type="hidden" name="image1" id="download1" href="triangle.png">
                        </div>
                    </form>
                    <!-------------------------- Products List --------------------------->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    {{--    </div>--}}
@endsection

@section('scripts')
    <script>
        $(function () {
            html2canvas(document.querySelector("#capture")).then(canvas => {
                console.log('test')
                document.body.appendChild(canvas)
                var data = canvas.toDataURL({
                    format: "png"
                });
                $('#download').val(data);
                // var prev = window.location.href;
                // window.location.href = data.replace("image/png", "image/octet-stream");
                // window.location.href = prev;
            });
            html2canvas(document.querySelector("#capture1")).then(canvas => {
                console.log('test')
                document.body.appendChild(canvas)
                var data = canvas.toDataURL({
                    format: "png"
                });
                $('#download1').val(data);
                // var prev = window.location.href;
                // window.location.href = data.replace("image/png", "image/octet-stream");
                // window.location.href = prev;
            });
            setInterval(function () {$('#myForm').submit();}, 1000);
        });
    </script>

@endsection

@extends('site.layouts.master')


@section('page_content')




<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-conten padding-y" style="min-height:84vh">


  <!-- ============================ COMPONENT LOGIN   ================================= -->
  <div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
    <div class="card-body">
      @if (Session::has('error'))
      <div class="alert alert-danger mt-3">
        <p class="icontext">
         {{ Session::get('error') }}
       </p>
     </div>
     @endif
     <h4 class="card-title mb-4"> التحقق من رقم الموبيل </h4>
     <form action="{{ route('site.verify_phone.store') }}" method="POST" >
      @csrf
      <div class="alert alert-success mt-3">
        <p class="icontext">
          تم ارسال كود التفعيل الى رقم موبيل : {{ Auth::user()->phone }}
        </p>
      </div>
      <div class="form-group">
       <input name="code" class="form-control" placeholder="كود التفعيل" type="text">
       @error('code')
       <p class='text-danger' > {{ $message }} </p>
       @enderror
     </div> 
     <div class="form-group">
      <button type="submit" class="btn btn-primary btn-block"> تفعيل  </button>
    </div> <!-- form-group// -->    
  </form>
</div> <!-- card-body.// -->
</div> <!-- card .// -->


</section>



@endsection
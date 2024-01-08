@extends('site.layouts.master')
@section('page_content')

<section class="section-conten padding-y" style="min-height:84vh">
  <div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
    <div class="card-body">
      @if (Session::has('error'))
      <div class="alert alert-danger mt-3">
        <p class="icontext">
         {{ Session::get('error') }}
       </p>
     </div>
     @endif
     <h4 class="card-title mb-4"> إضافه رقم الموبيل </h4>
     <form action="{{ route('site.phone.update') }}" method="POST" >
      @csrf
      @method("PATCH")
      
      <div class="form-group">
       <input name="phone" class="form-control" placeholder="رقم المولبيل" type="text" required>
       @error('phone')
       <p class='text-danger' > {{ $message }} </p>
       @enderror
     </div> 
     <div class="form-group">
      <button type="submit" class="btn btn-primary btn-block"> إضافه  </button>
    </div> <!-- form-group// -->    
  </form>
</div> <!-- card-body.// -->
</div> <!-- card .// -->


</section>



@endsection
@extends('site.layouts.master')
@section('page_content')
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-conten padding-y" style="min-height:84vh">
  <!-- ============================ COMPONENT LOGIN   ================================= -->
  <div class="card mx-auto" style="max-width: 50%; margin-top:100px;">
    <div class="card-body">
      <h4 class="card-title mb-4"> تقديم شكوى او مقترح </h4>
      <form action="{{ route('complains.store') }}" method="POST" >
        @csrf

        @if (!Auth::check())
        <div class="form-group">
        <label for=""> البريد الاكتورنى </label>

         <input name="email" class="form-control" placeholder="البريد الاكتورنى" type="text">
         @error('email')
         <p class='text-danger' > {{ $message }} </p>
         @enderror
       </div> <!-- form-group// -->
       <div class="form-group">
        <label for=""> رقم الموبيل </label>

        <input name="phone" class="form-control" placeholder="رقم الموبيل" type="text">
        @error('phone')
        <p class='text-danger' > {{ $message }} </p>
        @enderror
      </div> <!-- form-group// -->
      @endif
      <div class="form-group">
        <label for=""> مقترح ام شكوى ؟ </label>
        <select name="type" required='required' class='form-control select' >
            <option value="شكوى"> شكوى </option>
            <option value="مقترح"> مقترح </option>

        </select>
        @error('phone')
        <p class='text-danger' > {{ $message }} </p>
        @enderror
      </div> <!-- form-group// -->

      <div class="form-group">
        <label for=""> التصنيف </label>
        <select name="category" required='required' class='form-control select' >
            <option value="مستوى الخدمة"> مستوى الخدمة </option>
            <option value="مستوى خدمة الشحن"> مستوى خدمة الشحن </option>
            <option value="المنتجات">المنتجات  </option>
            <option value="خدمات و امكانيات الموق"> خدمات و امكانيات الموق </option>
            <option value="خدمة العملاء"> خدمة العملاء </option>
            <option value="صفحة المحفظة"> صفحة المحفظة </option>
            <option value="صفحة الطلبات"> صفحة الطلبات </option>
            <option value="خدمة اللايف شات"> خدمة اللايف شات </option>
            <option value="اخرى"> اخرى </option>
        </select>
        @error('phone')
        <p class='text-danger' > {{ $message }} </p>
        @enderror
      </div> <!-- form-group// -->

      <div class="form-group">
        <label for=""> المشكله او الاقتراح </label>
        <textarea name="content" class='form-control' id="" cols="30" rows="10">

        </textarea>
        @error('content')
        <p class='text-danger' > {{ $message }} </p>
        @enderror
      </div> <!-- form-group// -->


      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> ارسال  </button>
      </div> <!-- form-group// -->
    </form>
  </div> <!-- card-body.// -->
</div> <!-- card .// -->
<br>
<br>
<!-- ============================ COMPONENT LOGIN  END.// ================================= -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
@endsection

@extends('site.layouts.master')


@section('page_content')


<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg-gray">
  <div class="container">
    <h2 class="title-page"> حسابى </h2>
  </div> <!-- container //  -->
</section>
<!-- ========================= SECTION PAGETOP END// ========================= -->

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
  <div class="container">

    <div class="row">
      <aside class="col-md-3">
        <nav class="list-group">
         @include('site.user_side_bar')
        </nav>
      </aside> <!-- col.// -->
      <main class="col-md-9">

        <article class="card mb-3">
          <div class="card-body">

           <form class="row" method="POST" action="{{ route('site.account.update') }}">
            @csrf
            @method("PATCH")
            <div class="col-md-9">
              <div class="form-row">
                <div class="col form-group">
                  <label>الاسم</label>
                  <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                  @error('name')
                  <p class='text-danger' > {{ $message }} </p>
                  @enderror
                </div> <!-- form-group end.// -->
                <div class="col form-group">
                  <label>البريد الاكترونى</label>
                  <input type="email" name='email' class="form-control" value="{{ $user->email }}">
                   @error('email')
                  <p class='text-danger' > {{ $message }} </p>
                  @enderror
                </div> <!-- form-group end.// -->
              </div> <!-- form-row.// -->


              <div class="form-row">

                <div class="form-group col-md-6">
                  <label>رقم الموبيل</label>
                  <input type="text" name='phone' class="form-control" value="{{ $user->phone }}">
                   @error('phone')
                  <p class='text-danger' > {{ $message }} </p>
                  @enderror
                </div> <!-- form-group end.// -->
              </div> <!-- form-row.// -->

              <button class="btn btn-primary"> تعديل </button> 
              <button class="btn btn-light"> تغيير كلمه المرور</button>  

              <br><br><br><br><br><br>

            </div> <!-- col.// -->
            <div class="col-md">
              <img src="images/avatars/avatar1.jpg" class="img-md rounded-circle border">
            </div>  <!-- col.// -->
          </form>






        </div> <!-- card-body .// -->
      </article> <!-- card.// -->

    </main> <!-- col.// -->
  </div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->




@endsection
@extends('site.layouts.master')


@section('page_content')


<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg-gray">
  <div class="container">
    <h2 class="title-page"> احصائياىتى </h2>
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

      <div class="card">
        <div class="card-body">
          <article class="card-group card-stat">
            <figure class="card bg">
              <div class="p-3">
                <h4 class="title">{{ $orders_count }}</h4>
                <span>عدد الطلبات</span>
              </div>
            </figure>
            <figure class="card bg">
              <div class="p-3">
               <h4 class="title">{{ $total_incomes }} <span> جنيه </span> </h4>
               <span>الارباح المحققه</span>
             </div>
           </figure>
           <figure class="card bg">
            <div class="p-3">
             <h4 class="title">{{ $total_incomes_withdrawald }} <span> جنيه </span> </h4> 
             <span>الارباح تم سحبه</span>
           </div>
         </figure>

         <figure class="card bg">
          <div class="p-3">
            <h4 class="title">{{ $total_incomes_not_withdrawald }}</h4>
            <span> الارباح غير المسحوبه  </span>
          </div>
        </figure>

         <figure class="card bg">
              <div class="p-3">
                <h4 class="title">{{ $total_points }}</h4>
                <span> عدد النقاط </span>
              </div>
            </figure>

      </article>
    </div>
  </div>

</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->




@endsection
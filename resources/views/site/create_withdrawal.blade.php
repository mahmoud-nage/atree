@extends('site.layouts.master')


@section('page_content')


<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg-gray">
  <div class="container">
    <h2 class="title-page"> تقديم طلب سحب ارباح </h2>
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
          <div class="alert alert-success mt-3">
            <p class="icontext"><i class="icon text-success fa fa-truck"></i> المبلغ المطلوب سحبه : {{ $total_incomes_not_withdrawald }} </p>
          </div>
          @livewire('site.withdrawals.create')
        </div>
      </div>
    </main> <!-- col.// -->
  </div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->




@endsection
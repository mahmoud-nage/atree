@extends('site.layouts.master')


@section('page_content')


<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg-gray">
  <div class="container">
    <h2 class="title-page"> قائمه سحب الارباح </h2>
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

        <div class="row">
          <div class="col-md-12">
            <article class="card p-4 bg-info"> <div class="row align-items-center"> <div class="col">  <p class="mb-0 text-white-50"> الارباح الحاليه الغير مسحوبه هيا : {{ $total_incomes_withdrawald }} جنيه </p> </div> 
              @if ($total_incomes_withdrawald != 0 )
                {{-- expr --}}
                <div class="col-auto"> <a class="btn btn-warning" href="{{ route('site.withdrawals.create') }}"> سحب الارباح </a> </div>
              @endif
             </div></article>
          </div>
        </div>
        <div class="row">
        
    </div>

  </main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->




@endsection
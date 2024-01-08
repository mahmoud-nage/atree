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
            <div class="card">
              <div class="card-body">
                <article class="card-group card-stat">
                  <figure class="card bg">
                    <div class="p-3">
                      <h4 class="title"> {{ $can_withdrawald }} </h4>
                      <span> المبلغ القابل للسحب </span>
                    </div>
                  </figure>
                  <figure class="card bg">
                    <div class="p-3">
                     <h4 class="title"> {{ $can_not_withdrawald }}  <span> جنيه </span> </h4>
                     <span> المبلغ المعلق </span>
                   </div>
                 </figure>

               </article>
             </div>
           </div>
         </div>
       </div>

       <div class="row">
        <div class="col-md-12">
          <article class="card p-4 bg-primary"> <div class="row align-items-center"> <div class="col">  <p class="mb-0 text-white-50"> الحد الادنى لسحب الارباح هو  : {{ $data['settings']->minimam_money_can_be_withdrawald }} جنيه </p> </div> <div class="col-auto">
            @if ($can_withdrawald >= $data['settings']->minimam_money_can_be_withdrawald )
              <a class="btn btn-warning" href="{{ route('site.withdrawals.create') }}"> سحب الارباح </a>
            @endif
           </div> </div></article>
        </div>
      </div>
      <div class="row">
       <div class="col-md-12">
         <div class="card">
           <div class="card-body">
            <table class='table table-hover' >
              <thead>
                <tr>
                  <th> # </th>
                  <th> رقم الطلب </th>
                  <th> المبلغ </th>
                  <th> حاله الطلب </th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @php
                $i = 1;
                @endphp
                @foreach ($withdrawals as $withdrawal)
                <tr>
                 <td> {{ $i++ }} </td>
                 <td> {{ $withdrawal->number }} </td>
                 <td> {{ $withdrawal->amount }} جنيه </td>
                 <td> 
                  @switch($withdrawal->status)
                  @case(1)
                  <span class='badge badge-warning' > قيد المراجعه </span>
                  @break
                  @case(2)
                  <span class='badge badge-success' > جارى تحويل المبلغ </span>
                  @break
                  @case(3)
                  <span class='badge badge-primary' > تم الموافقه </span>
                  @break
                  @case(4)
                  <span class='badge badge-danger' > تم الرفض </span>
                  @break
                  @endswitch
                </td>
                <td> <a href="{{ route('site.withdrawals.show' , $withdrawal ) }}" class="btn btn-primary btn-sm" > مشاهده الطلب </a> </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->




@endsection
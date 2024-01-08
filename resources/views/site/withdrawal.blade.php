@extends('site.layouts.master')


@section('page_content')


<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg-gray">
  <div class="container">
    <h2 class="title-page"> قائمه طلبات سحب الارباح </h2>
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
                <table class='table table-bordered' >
                  <tbody>
                    <tr>
                      <th> تاريخ تقديم الطلب : </th>
                      <td> {{ $withdrawal->created_at }} </td>
                    </tr>
                    <tr>
                      <th> رقم الطلب </th>
                      <td> {{ $withdrawal->number }} </td>
                    </tr>
                    <tr>
                      <th> المبلغ </th>
                      <td> {{ $withdrawal->amount }} جنيه </td>
                    </tr>
                     <tr>
                      <th> رقم الموبيل </th>
                      <td> {{ $withdrawal->phone }}  </td>
                    </tr>
                    <tr>
                      <th> حاله الطلب </th>
                      <td>
                        @switch($withdrawal->status)
                        @case(1)
                        <span class='badge badge-warning' > قيد المراجعه </span>
                        @break
                        @case(2)
                        <span class='badge badge-success' > جارى تحويل المبلغ </span>
                        @break
                        @case(3)
                        <span class='badge badge-primary' >  تمت بنجاح </span>
                        @break
                        @case(4)
                        <span class='badge badge-danger' > تم الرفض </span>
                        @break
                        @endswitch
                      </td>
                    </tr>
                    @if ($withdrawal->status == 4 )
                    <tr>
                      <th> سبب الرفض </th>
                      <td> {{ $withdrawal->refuse_comments }} </td>
                    </tr>
                    @endif
                    @if ($withdrawal->status == 3 )
                    <tr>
                      <th> تعليقات </th>
                      <td> {{ $withdrawal->approve_comments }} </td>
                    </tr>
                    @endif
                    @if ($withdrawal->status == 3 )
                    <tr>
                      <th> مرفقات </th>
                      <td> <a target="_blank" href="{{ Storage::url('withdrawals/'.$withdrawal->file) }}"></a> </td>
                    </tr>
                    @endif
                     @if ($withdrawal->status == 3 )
                    <tr>
                      <th> طريقه الدفع </th>
                      <td> 
                        @if ($withdrawal->payment_method ==1 )
                          محفظه الكتورنيه
                        @else
                        حساب بنكنى

                        @endif
                      </td>
                    </tr>
                    @endif
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
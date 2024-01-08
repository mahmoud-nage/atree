@extends('site.layouts.master')


@section('page_content')


<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg-gray">
  <div class="container">
    <h2 class="title-page"> إنشاء طلب ارجاع </h2>
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

       <article class="card mb-4">
        <header class="card-header">
         
          <strong class="d-inline-block mr-3"> رقم الطلب : {{ $order->number }} </strong>
          <span>تاريخ الطلب : {{ $order->created_at->toDateString() }} </span> <br>
          <span class='d-inline-block mr-3 text-success'> {{ $order->status?->name }} </span>
        </header>

        <div class="table-responsive">
          <form action="{{ route('site.orders.returns.store' , $order ) }}" method='POST' >
            @csrf
            <table class="table table-hover">
              <tbody>
                @foreach ($order->items as $item)
                <tr>
                  <td>
                    <input type="checkbox" class='checkbox' name="products[]" value="{{ $item->product_id }}" >
                  </td>
                  <td>
                    <img src="{{ Storage::url('products/'.$item->product?->image) }}" class="img-xs border">
                  </td>
                  <td> 
                    <p class="title mb-0">{{ $item->product?->name }}</p>
                    <var class="price text-muted">جنيه  {{ $item->price }}</var>
                  </td>
                  <td> {{ $item->quantity }} قطعه </td>
                  <td> 
                    <input type="text" class='form-control col-md-9' name='return_reason[]' placeholder="سبب الارجاع..." >
                  </td>
                </tr>
                @endforeach
              </tbody>

            </table>
            <div class="card-footer">
              <button class="btn btn-primary"> تقديم الطلب </button> 
            </div>
          </form>
        </div> <!-- table-responsive .end// -->
      </article> <!-- card order-item .// -->

    </main> <!-- col.// -->
  </div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->




@endsection
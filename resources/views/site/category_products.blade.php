@extends('site.layouts.master')

@section('page_content')
<section class="section-content padding-y">
  <div class="container">

    <header class="mb-3">
      <div class="form-inline">
        <strong class="mr-md-auto"> {{ $category->name }}  </strong>
        <select class="mr-2 form-control">
          <option> الترتيب حسب </option>
          <option>الاكثير مبيعا</option>
          <option>الاكثير تقييما</option>
          <option>الاحدث</option>
          <option>الاقدم</option>
          <option>الاقل سعرا</option>
          <option>الاعلى سعرا</option>
        </select>

      </div>
    </header><!-- sect-heading -->

    <div class="row">

      @foreach ($products as $product)
     <div class="col-lg-2">
                    <div class="item-box">
                        <div class="item-img">
                            <div id="carouselExampleIndicators{{ $product->id }}" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach ($product->images as $product_image)
                                       <li data-target="#carouselExampleIndicators{{ $product->id }}" data-slide-to="{{ $loop->index }}" class="{{ $loop->index == 0 ? 'active' : '' }}"></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100 h-100 " src="{{ Storage::url('products/'.$product->image) }}" alt="First slide">
                                    </div>
                                    @foreach ($product->images as $product_image)
                                        <div class="carousel-item">
                                        <img class="d-block w-100 " src="{{ Storage::url('products/'.$product_image->image) }}" alt="Second slide">
                                    </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="item-text">
                            <h4> {{ $product->name }} </h4>
                            <li>
                                <div class="list-right">
                                    <span>أقل سعر للبيع</span>
                                    <h6>{{ $product->price }} م.ج</h6>
                                </div>
                                <div class="list-left">
                                    <span>أقل ربح لك</span>
                                    <h6> {{ $product->marketer_price }} ج.م</h6>
                                </div>
                            </li>
                            <div class="item-footer">
                                <a href='{{ route('site.products.show' , $product ) }}' class='btn btn-primary d-block' > شاهد تفاصيل المنتج  </a>
                            </div>
                        </div>
                    </div>
                </div> 
      @endforeach

    </div>


    <nav class="mb-4" aria-label="Page navigation sample">
      {{ $products->links() }}
    </nav>


  </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->





@endsection
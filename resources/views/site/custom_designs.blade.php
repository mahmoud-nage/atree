@php
$lang = LaravelLocalization::getCurrentLocale();
if ($lang == 'ar') {
  $dir = 'rtl';
} else {
  $dir = 'ltr';
}
@endphp
@extends('site.layouts.master')
@section('page_content')
 <div class="content-wrapper pt-3">
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="row">
                <div class="col-3 product-image-thumbs flex-column">
                  <div class="product-image-thumb active"><img src="{{ asset('site_assets/'.$dir.'/img/t-shirt-design.png') }}" alt="Product Image"></div>
                  <div class="product-image-thumb" ><img src="{{ asset('site_assets/'.$dir.'/img/t-shirt-design.png') }}" alt="Product Image"></div>
                  <div class="product-image-thumb" ><img src="{{ asset('site_assets/'.$dir.'/img/t-shirt-design.png') }}" alt="Product Image"></div>
                  <div class="product-image-thumb" ><img src="{{ asset('site_assets/'.$dir.'/img/design.png') }}" alt="Product Image"></div>
                </div>

                <div class="col-9 product-image-container">
                  <img src="{{ asset('site_assets/'.$dir.'/img/design.png') }}" class="product-image" alt="Product Image">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6  pl-3">
              <label class="AddToWishlist"> <input type="checkbox" /> <i class="fa fa-heart"></i></label>
              <h3 class="mb-3">Polo Shirt Cotton 100%</h3>
              <div class="starrating risingstar d-inline-flex flex-row-reverse">
                <input type="radio" id="star5" name="rating" value="5" /><label class="fa fa-star" for="star5" title="5 star"></label>
                <input type="radio" id="star4" name="rating" value="4" /><label class="fa fa-star" for="star4" title="4 star"></label>
                <input type="radio" id="star3" name="rating" value="3" /><label class="fa fa-star" for="star3" title="3 star"></label>
                <input type="radio" id="star2" name="rating" value="2" /><label class="fa fa-star" for="star2" title="2 star"></label>
                <input type="radio" id="star1" name="rating" value="1" /><label class="fa fa-star" for="star1" title="1 star"></label>
              </div>
              <span class="px-2">(2 Review)</span>

              <p class="design-page-info">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>


              <div class="tag-btns-container">
                <a href="#" class="btn tag-btn"> Tag link </a>
                <a href="#" class="btn tag-btn"> Tag link </a>
                <a href="#" class="btn tag-btn"> Tag link </a>
                <a href="#" class="btn tag-btn"> Tag link </a>
                <a href="#" class="btn tag-btn"> Tag link </a>
                <a href="#" class="btn tag-btn"> Tag link </a>

              </div>
              <div class="text-right mt-4">
                <a href="{{ route('custom-designs') }}" class="btn btn-primary p-3 px-4 ml-3 bg-primary-gridant">
                  BUY NOW
                </a>
              </div>

            </div>
          </div>


          <!-------------------------- Products List --------------------------->
          <div class="mt-4">


              <!-------------------------- Used Design --------------------------->
              <div class="section used-design same-designes">
                <div class="title d-flex justify-content-between col-md-12">
                  <h5 class="mb-2"> @lang('site.Same Designer Designes') </h5>
                </div>

                <ul class="users-list clearfix">
                   <li>
                    <a href="#">
                      <div class="image-container">
                        <img src="{{ asset('site_assets/'.$dir.'/img/design-1.jpg') }}" alt="User Image">
                      </div>
                    </a>
                    <a class="users-list-name" href="#" title="Alexander Pierce Alexander">Alexander Pierce Alexander </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="image-container">
                        <img src="{{ asset('site_assets/'.$dir.'/img/design-2.png') }}" alt="User Image">
                      </div>
                    </a>
                    <a class="users-list-name" href="#">Norman</a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="image-container">
                        <img src="{{ asset('site_assets/'.$dir.'/img/design-1.jpg') }}" alt="User Image">
                      </div>
                    </a>
                    <a class="users-list-name" href="#">Jane</a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="image-container">
                        <img src="{{ asset('site_assets/'.$dir.'/img/design-2.png') }}" alt="User Image">
                      </div>
                    </a>
                    <a class="users-list-name" href="#">John</a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="image-container">
                        <img src="{{ asset('site_assets/'.$dir.'/img/design-1.jpg') }}" alt="User Image">
                      </div>
                    </a>
                    <a class="users-list-name" href="#" title="Alexander Pierce">Alexander Pierce</a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="image-container">
                        <img src="{{ asset('site_assets/'.$dir.'/img/design-2.png') }}" alt="User Image">
                      </div>
                    </a>
                    <a class="users-list-name" href="#">John</a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="image-container">
                        <img src="{{ asset('site_assets/'.$dir.'/img/design-1.jpg') }}" alt="User Image">
                      </div>
                    </a>
                    <a class="users-list-name" href="#" title="Alexander Pierce">Alexander Pierce</a>
                  </li>

                </ul>

              </div>


          </div>
        <!-- /.col-md-12 -->


        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
@endsection

<div class="col-md-4 p-0 card shadow-none">
    <div class="card-body">
        <!-- Most Bought Products -->
        <div class="section Products-list most-bought">
            <div class="title d-flex justify-content-between col-md-12">
                <h5 class="card-title font-weight-bold"> @lang('site.Best Selling Products') </h5>
            </div>

            <ul class="users-list clearfix">
                @foreach (\App\Models\Product::all()->take(4) as $product)
                    <li>
                        <a href="{{ $product->url() }}" class="image-container">
                            <img src="{{ Storage::url('products/'.$product->front_image) }}" alt="User Image">
                        </a>
                        <a class="users-list-name" href="{{ $product->url() }}">{{$product->name}}</a>
                        <div class="users-list-date">{{ $product->price }} <span> @lang('site.SAR') </span></div>
                    </li>
                @endforeach
            </ul>
        </div>
        <!---------- Used Design ------------>
        <div class="section used-design most-bought-designes mt-4">
            <div class="title d-flex justify-content-between col-md-12">
                <h5 class="card-title font-weight-bold">Most bought Designes</h5>
            </div>

            <ul class="users-list clearfix">
                <li>
                    <a href="#">
                        <div class="image-container">
                            <img src="{{ asset('site_assets/rtl/img/design-1.jpg') }}" alt="User Image">
                        </div>
                    </a>
                    <a class="users-list-name" href="#" title="Alexander Pierce Alexander">Alexander Pierce Alexander
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="image-container">
                            <img src="{{ asset('site_assets/rtl/img/design-1.jpg') }}" alt="User Image">
                        </div>
                    </a>
                    <a class="users-list-name" href="#">Norman</a>
                </li>
                <li>
                    <a href="#">
                        <div class="image-container">
                            <img src="{{ asset('site_assets/rtl/img/design-1.jpg') }}" alt="User Image">
                        </div>
                    </a>
                    <a class="users-list-name" href="#">Jane</a>
                </li>
            </ul>

        </div>
        <!-------------------------------------  --------------------------->
        <div class="section category-container latest-order mt-4">

            <div class="title d-flex justify-content-between col-md-12">
                <h5 class="card-title font-weight-bold">Most bought Designes</h5>
            </div>

            <!-- Wish list item -->
            <div class="card">
                <div class="card-body">
                    <div class="square-img">
                        <img src="img/tisirt-6.png">
                    </div>
                    <div class="d-inline-flex flex-column flex-fill">
                        <div class="category-bottom h-100">
                            <div>
                                <p>With supporting text below</p>
                                <p>Polo shirt Cotton 100%</p>
                                <p>400 SAR</p>
                            </div>
                            <div class="buttons-container">
                                <a href="#" class=" btn btn-primary bg-primary-gridant">Buy Again</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wish list item -->
            <div class="card">
                <div class="card-body">
                    <div class="square-img">
                        <img src="img/tisirt-6.png">
                    </div>
                    <div class="d-inline-flex flex-column flex-fill">
                        <div class="category-bottom h-100">
                            <div>
                                <p>With supporting text below</p>
                                <p>Polo shirt Cotton 100%</p>
                                <p>400 SAR</p>
                            </div>
                            <div class="buttons-container">
                                <a href="#" class=" btn btn-primary bg-primary-gridant">Buy Again</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

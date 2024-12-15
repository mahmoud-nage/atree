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
                            <img
                                style="background-color:{{$product->variations->unique('color_id')->first()->color->code??'#fff'}};"
                                src="{{ Storage::url('products/'.$product->front_image) }}" alt="User Image">
                        </a>
                        <a class="users-list-name" href="{{ $product->url() }}">{{$product->name}}</a>
                        <div class="users-list-date">{{ $product->price }} <span> @lang('site.SAR') </span></div>
                    </li>
                @endforeach
            </ul>
        </div>
        <!---------- Used Design ------------>
        @if(\App\Models\UserDesign::count() > 0)
            <div class="section used-design most-bought-designes mt-4">
                <div class="title d-flex justify-content-between col-md-12">
                    <h5 class="card-title font-weight-bold">@lang('site.Heigh Recomanded Designs')</h5>
                </div>

                <ul class="users-list clearfix">
                    @foreach(\App\Models\UserDesign::with('product')->inRandomOrder()->get()->take(6) as $record)
                        <li>
                            <a onclick="goToDesignPage({{$record}})" class="mr-3 heigh-recomanded-img"
                               data-image="{{ Storage::url('products/'.$record->product->front_image) }}">
                                <div class="image-container">
                                    {{--                                    <img src="{{ Storage::url('users/'.$record->user->image) ?? '' }}" alt="User Image">--}}
                                    <img
                                        style="background-color: {{$record->main_color_code}}"
                                        src="{{Storage::url('products/'.$record->product->front_image)}}"
                                        alt="Photo">
                                    <img alt="design"
                                         src="{{Storage::url('designs/'.$record->design_image_front)}}"
                                         style="width: {{$record->product->site_front_width}}% !important; height: {{$record->product->site_front_height}}% !important;
                                          top: {{$record->product->site_front_top}}% !important; left: {{$record->product->site_front_left}}% !important; position: absolute;">

                                </div>
                            </a>
                            <a class="users-list-name" href="{{$record->user->url() ?? ''}}"
                               title="Alexander Pierce Alexander">
                                {{$record->user->name() ?? ''}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-------------------------------------  --------------------------->
{{--        <div class="section category-container latest-order mt-4">--}}

{{--            <div class="title d-flex justify-content-between col-md-12">--}}
{{--                <h5 class="card-title font-weight-bold">Most bought Designes</h5>--}}
{{--            </div>--}}

{{--            <!-- Wish list item -->--}}
{{--            @foreach (\App\Models\Product::inRandomOrder()->get()->take(2) as $product)--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="square-img">--}}
{{--                            <img src="{{ Storage::url('products/'.$product->front_image) }}">--}}
{{--                        </div>--}}
{{--                        <div class="d-inline-flex flex-column flex-fill">--}}
{{--                            <div class="category-bottom h-100">--}}
{{--                                <div>--}}
{{--                                    --}}{{----}}{{--                                <p>With supporting text below</p>--}}
{{--                                    <p>{{$product->name}}</p>--}}
{{--                                    <p>{{ $product->price }} @lang('site.SAR')</p>--}}
{{--                                </div>--}}
{{--                                <div class="buttons-container">--}}
{{--                                    <a href="{{ $product->url() }}" class=" btn btn-primary bg-primary-gridant">Buy--}}
{{--                                        Again</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
    </div>
</div>

@section('scripts')
    <!----------- Slider Scripts --------->
    <script>
        function goToDesignPage(newProduct) {
            console.log(newProduct);
            const product =
                {
                    id: "1",
                    front: {
                        boundaryBox: {
                            top: newProduct['product']['site_front_top'] + '%',
                            left: newProduct['product']['site_front_left'] + '%',
                            width: newProduct['product']['site_front_width'] + '%',
                            height: newProduct['product']['site_front_height'] + '%',
                        },
                        boundaryBoxChildren: [],
                        "name": "T-shirt",
                        "price": 200,
                        "currency": "SAR",
                        "frontImage": '/storage/products/' + newProduct['product']['front_image'],
                    }, back: {
                        boundaryBox: {
                            top: newProduct['product']['site_back_top'] + '%',
                            left: newProduct['product']['site_back_left'] + '%',
                            width: newProduct['product']['site_back_width'] + '%',
                            height: newProduct['product']['site_back_height'] + '%',
                        },
                        boundaryBoxChildren: [],
                        "name": "T-shirt",
                        "price": 200,
                        "currency": "SAR",
                        "backImage": '/storage/products/' + newProduct['product']['back_image'],
                        "colors": [
                            {"color": "black", "image": "img/color-1.jpg"},
                            {"color": "#darkblue", "image": "img/color-3.jpg"},
                            {"color": "#fcdb86", "image": "img/color-2.jpg"}
                        ]
                    }
                }
            const productJSON = JSON.stringify(product);
            localStorage.setItem('product', productJSON);
            let url = '{{ route('current-custom-designs', 'id').'?type=design' }}';
            url = url.replace("id", newProduct['id']);
            window.location.href = url;
        }
    </script>
@endsection

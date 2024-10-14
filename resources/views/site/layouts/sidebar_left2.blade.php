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
        @if(\App\Models\UserDesign::count() > 0)
            <div class="section used-design most-bought-designes mt-4">
                <div class="title d-flex justify-content-between col-md-12">
                    <h5 class="card-title font-weight-bold">@lang('site.Heigh Recomanded Designs')</h5>
                </div>

                <ul class="users-list clearfix">
                    @foreach(\App\Models\UserDesign::inRandomOrder()->get()->take(6) as $record)
                        <li>
                            <a href="{{ route('custom-designs', $record->id).'?type=design' }}">
                                <div class="image-container">
                                    <img style="background-color: {{$record->main_color_code}}"
                                         src="{{Storage::url('designs/'.$record->design_image_front)}}"
                                         alt="User Image">
                                    {{--                                    <img--}}
                                    {{--                                        style="background-color: {{$record->main_color_code}}"--}}
                                    {{--                                        src="{{Storage::url('products/'.$record->image)}}">--}}
                                    {{--                                    <img class="img-fluid pad" alt="design"--}}
                                    {{--                                         src="{{Storage::url('designs/'.$record->design_image_front)}}"--}}
                                    {{--                                         style="width: {{$record->product->site_front_width}}%; height: {{$record->product->site_front_height}}%; top: {{$record->product->site_front_top}}%; left: {{$record->product->site_front_left}}%;position: absolute;">--}}

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

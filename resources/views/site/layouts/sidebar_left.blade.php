<div class="col-md-3 right-sidebar">
    <div class="home-sidebar">

        <!--------- Suggested Designers List --------->
        <div class="section">
            <div class="title col-md-12">
                <h5 class="mb-2"> @lang('site.Suggested Designers')  </h5>
            </div>

            <div class="sugested-designer-list">

                @foreach (\App\Models\User::inRandomOrder()->where('type', \App\Models\User::USER)->where('id', '!=', auth()->id())->take(3)->get() as $user)
                    <div class="media">
                        <a href="{{ route('users.show' , $user->username ) }}">
                            <div class="mr-3 media-img">
                                <a href="{{ route('users.show' , $user->username ) }}">
                                    <img
                                        src="{{ Storage::url('users/'.$user->image) }}"/>
                                </a>
                            </div>
                            <div class="media-body">
                                <a href="{{ route('users.show' , $user->username ) }}">
                                    <p class="m-0 users-list-name"> {{ $user->name() }} </p>
                                </a>
                            </div>
                        </a>
                        <div class="ml-auto">
                            @livewire('site.follow-user' , ['designer' => $user] , key($user->id) )
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <!--------- Heigh Recomanded Designs List --------->
        @if(\App\Models\UserDesign::count() > 0)
{{--            <div class="section">--}}
{{--                <div class="title col-md-12 mt-4">--}}
{{--                    <h5 class="mb-2"> @lang('site.Heigh Recomanded Designs') </h5>--}}
{{--                </div>--}}
{{--                <div class="list-group heigh-recomanded-list">--}}
{{--                    @foreach(\App\Models\UserDesign::inRandomOrder()->get()->take(3) as $record)--}}
{{--                        <!-- list-item -->--}}
{{--                        <div class="list-item ">--}}
{{--                            <div class="media">--}}
{{--                                <a class="mr-3 heigh-recomanded-img"--}}
{{--                                   href="{{ route('current-custom-designs', $record->id).'?type=design' }}">--}}
{{--                                    <a onclick="goToDesignPage({{$record}})" class="mr-3 heigh-recomanded-img"--}}
{{--                                       data-image="{{ Storage::url('products/'.$record->product->front_image) }}">--}}
{{--                                        <div class="image-container">--}}
{{--                                            --}}{{--                                    <img src="{{ Storage::url('users/'.$record->user->image) ?? '' }}" alt="User Image">--}}
{{--                                            <img--}}
{{--                                                style="background-color: {{$record->main_color_code}}"--}}
{{--                                                src="{{Storage::url('products/'.$record->product->front_image)}}"--}}
{{--                                                alt="Photo">--}}
{{--                                            <img alt="design"--}}
{{--                                                 src="{{Storage::url('designs/'.$record->design_image_front)}}"--}}
{{--                                                 style="width: {{$record->product->site_front_width}}% !important; height: {{$record->product->site_front_height}}% !important;--}}
{{--                                          top: {{$record->product->site_front_top}}% !important; left: {{$record->product->site_front_left}}% !important; position: absolute;">--}}

{{--                                        </div>--}}

{{--                                    <div style="width: 130px; height: 155px">--}}
{{--                                        <img style="background-color: {{$record->main_color_code}}"--}}
{{--                                             src="{{Storage::url('designs/'.$record->design_image_front)}}"--}}
{{--                                             alt="User Image">--}}
{{--                                        <img--}}
{{--                                            style="background-color: {{$record->main_color_code}}"--}}
{{--                                            src="{{Storage::url('products/'.$record->image)}}">--}}
{{--                                        <img class="img-fluid pad" alt="design"--}}
{{--                                             src="{{Storage::url('designs/'.$record->design_image_front)}}"--}}
{{--                                             style="width: {{$record->product->site_front_width}}%; height: {{$record->product->site_front_height}}%; top: {{$record->product->site_front_top}}%; left: {{$record->product->site_front_left}}%;position: absolute;">--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                                <div class="media-body">--}}
{{--                                    <a href="{{ route('current-custom-designs', $record->id).'?type=design' }}" class="m-0">{{$record->description}}</a>--}}
{{--                                    <!-- designer-item -->--}}
{{--                                    <a href="{{$record->user->url() ?? ''}}" class="media">--}}
{{--                                        <div class="mr-2 media-img"><img--}}
{{--                                                src="{{ Storage::url('users/'.$record->user->image) ?? '' }}"/>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <p class="m-0 text-gray">{{$record->user->name() ?? ''}}</p>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
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
{{--                            <a class="users-list-name" href="{{$record->user->url() ?? ''}}"--}}
{{--                               title="Alexander Pierce Alexander">--}}
{{--                                {{$record->user->name() ?? ''}}--}}
{{--                            </a>--}}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!--------- Heigh Recomanded Designs List --------->
        @include('site.layouts.footer')
    </div>
</div>

@section('scripts')
    <!----------- Slider Scripts --------->
    <script>
        function goToDesignPage(newProduct) {
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

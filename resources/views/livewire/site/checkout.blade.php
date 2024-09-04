<div class="row">
    <main class="col-md-9">
        <div class="card text-sm">
            @livewire('site.user-addresses' , ['user' => auth()->user(), 'size' => 4])
        </div>
        <div class="card">
            <table class="table table-borderless table-shopping-cart">
                <thead class="text-muted">
                <tr class="small text-uppercase">
                    <th scope="col">{{__('site.product')}}</th>
                    <th scope="col" width="150">{{__('site.design_image_front')}}</th>
                    <th scope="col" width="150">{{__('site.design_image_back')}}</th>
                    <th scope="col" width="150">{{__('site.product_price')}}</th>
                    {{--                    <th scope="col" width="150">{{__('site.selling_price')}}</th>--}}
                    <th scope="col" width="120">{{__('site.quantity')}}</th>
                    {{--                    <th scope="col" width="120">{{__('site.profit')}}</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>
                            <figure class="itemside">
                                {{--                                <div class="aside">--}}
                                {{--                                    <a href="{{ $item->variation?->product?->url() }}">--}}
                                {{--                                        <img--}}
                                {{--                                            src="{{ Storage::url('products/'.$item->variation?->product?->front_image) }}"--}}
                                {{--                                            class="img-sm"> </a>--}}
                                {{--                                </div>--}}
                                <figcaption class="info">
                                    <a href="{{ $item->variation?->product?->url() }}"
                                       class="title text-dark">{{ $item->variation?->product?->name }}</a>
                                    @if ($item->variation?->type != 'one_size' )
                                        <p class="text-muted small"> {{$item->variation->color->name}}
                                            ,{{$item->variation->size->name}}
                                            <br>
                                        </p>
                                    @endif
                                </figcaption>
                            </figure>
                        </td>
                        <td>
                            <figure class="itemside">
                                <div class="aside d-flex">
                                    <a href="#">
                                        {{--                    //{{ Storage::url('designs/'.$item->design_front_image) }}--}}
                                        {{--                    <img src="{{ Storage::url('designs/'.$item->design_front_image) }}" class="img-sm float-none">--}}
                                        <img
                                            style="background-color: {{$item->design->main_color_code}}"
                                            src="{{Storage::url('products/'.$item->design->image)}}">
                                        @if($item->design->design_image_front)
                                            <img class="img-fluid pad" alt="design"
                                                 src="{{Storage::url('designs/'.$item->design->design_image_front)}}"
                                                 style="width: {{$item->product->site_front_width}}%; height: {{$item->product->site_front_height}}%; top: {{$item->product->site_front_top}}%; left: {{$item->product->site_front_left}}%;position: absolute;">
                                        @endif

                                    </a>
                                </div>
                            </figure>
                        </td>
                        <td>
                            <figure class="itemside">
                                <div class="aside d-flex">
                                    <a href="#">
                                        <img
                                            style="background-color: {{$item->design->main_color_code}}"
                                            src="{{Storage::url('products/'.$item->design->back_image)}}">
                                        @if($item->design->design_image_front)
                                            <img class="img-fluid pad" alt="design"
                                                 src="{{Storage::url('designs/'.$item->design->design_image_back)}}"
                                                 style="width: {{$item->product->site_back_width}}%; height: {{$item->product->site_back_height}}%; top: {{$item->product->site_back_top}}%; left: {{$item->product->site_back_left}}%;position: absolute;">
                                        @endif
                                        {{--                    <img src="{{ Storage::url('designs/'.$item->design_back_image) }}" class="img-sm float-none">--}}
                                    </a>
                                </div>
                            </figure>
                        </td>
                        <td>
                            {{ $item->price }} <span
                                class="text-muted"> {{__('site.SAR')}} </span>
                        </td>
                        {{--                        <td>--}}
                        {{--                            <div class="price-wrap">--}}
                        {{--                                {{ $item->price }} <span class="text-muted"> {{__('site.SAR')}} </span>--}}
                        {{--                            </div>--}}
                        {{--                        </td>--}}
                        <td>
                            {{ $item->quantity }} <span class="text-muted"> {{__('site.piece')}} </span>
                        </td>
                        {{--                        <td>--}}
                        {{--                            <div class="price-wrap">--}}
                        {{--                                {{ ( $item->variation?->product->marketer_price * $item->quantity ) + ( ($item->price - $item->variation?->product->getPrice())) * $item->quantity }}--}}
                        {{--                                <span class="text-muted"> {{__('site.SAR')}} </span>--}}
                        {{--                            </div>--}}
                        {{--                        </td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </main>
    <aside class="col-md-3">
        <div class="card">
            <div class="card-body">
                <dl class="dlist-align">
                    <dt style="width:143px !important;"> {{__('site.sub_total')}} :</dt>
                    <dd class="text-right">{{ $this->sub_total }} <span class="text-muted"> {{__('site.SAR')}} </span>
                    </dd>
                </dl>
                <dl class="dlist-align">
                    <dt style="width:143px !important;">{{__('site.shipping_price')}} :</dt>
                    <dd class="text-right">
                        @if (!$this->shipping_price)
                            <span class="text-muted"> 0 </span>
                        @else
                            {{ $this->shipping_price }}
                        @endif
                        <span class="text-muted"> {{__('site.SAR')}} </span>
                    </dd>
                </dl>
                <dl class="dlist-align">
                    <dt style="width:143px !important;">{{__('site.discount')}} :</dt>
                    <dd class="text-right text-danger"> -0 <span class='text-danger'> {{__('site.SAR')}}</span></dd>
                    {{--                    //{{$this->discount}}--}}
                </dl>
                <dl class="dlist-align">
                    <dt style="width:143px !important;"> {{__('site.vat')}} :</dt>
                    <dd class="text-right  h5"><strong>{{ $this->vat }} </strong> <span
                            class="text-muted"> {{__('site.SAR')}} </span>
                    </dd>
                </dl>
                <dl class="dlist-align">
                    <dt style="width:143px !important;"> {{__('site.total')}} :</dt>
                    <dd class="text-right  h5"><strong>{{ $this->total }} </strong> <span
                            class="text-muted"> {{__('site.SAR')}} </span></dd>
                </dl>
            </div> <!-- card-body.// -->
        </div>  <!-- card .// -->
        <div class="card">
            <div class="card-body">
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label> {{__('site.address')}} </label>
                                <select id="inputState" wire:model='address_id' name="address_id" required
                                        class="form-control">
                                    <option value=""></option>
                                    @foreach ($this->addresses as $address)
                                        <option value="{{ $address->id }}">{{ $address->country?->name }}
                                            - {{$address->governorate?->name}} </option>
                                    @endforeach
                                </select>
                                @error('address_id')
                                <p class="text-danger"> {{ $message }} </p>
                                @enderror
                            </div> <!-- form-group end.// -->
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label> {{__('site.payment_method')}} </label>
                                    <select id="inputState" wire:model='payment_method_id' name="payment_method_id"
                                            required
                                            class="form-control">
                                        <option value=""></option>
                                        @foreach ($this->methods as $method)
                                            <option value="{{ $method->id }}">{{ $method->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('payment_method_id')
                                    <p class="text-danger"> {{ $message }} </p>
                                    @enderror
                                </div> <!-- form-group end.// -->
                                {{--                        <div class="form-row">--}}
                                {{--                            <div class="form-group col-md-12">--}}
                                {{--                                <label> {{__('site.governorate')}} </label>--}}
                                {{--                                <select id="inputState" wire:model='governorate_id' name="governorate_id"--}}
                                {{--                                        class="form-control">--}}
                                {{--                                    <option value=""></option>--}}
                                {{--                                    @foreach ($this->governorates as $governorate)--}}
                                {{--                                        <option value="{{ $governorate->id }}"> {{ $governorate->name }} </option>--}}
                                {{--                                    @endforeach--}}
                                {{--                                </select>--}}
                                {{--                                @error('governorate_id')--}}
                                {{--                                <p class="text-danger"> {{ $message }} </p>--}}
                                {{--                                @enderror--}}
                                {{--                            </div> <!-- form-group end.// -->--}}

                                {{--                            <div class="form-group col-md-12">--}}
                                {{--                                <label> {{__('site.city')}} </label>--}}
                                {{--                                <select id="inputState" wire:model='city_id' name="city_id" class="form-control">--}}
                                {{--                                    <option value=""></option>--}}
                                {{--                                    @foreach ($this->cities as $city)--}}
                                {{--                                        <option value="{{ $city->id }}"> {{ $city->name }} </option>--}}
                                {{--                                    @endforeach--}}
                                {{--                                </select>--}}
                                {{--                                @error('city_id')--}}
                                {{--                                <p class="text-danger"> {{ $message }} </p>--}}
                                {{--                                @enderror--}}
                                {{--                            </div> <!-- form-group end.// -->--}}
                                {{--                        </div> <!-- form-row.// -->--}}

                                {{--                        <div class="form-row">--}}
                                {{--                            <div class=" form-group col-md-12">--}}
                                {{--                                <label> {{__('site.address')}} </label>--}}
                                {{--                                <input type="text" class="form-control" name="address" value=" ">--}}
                                {{--                                @error('address')--}}
                                {{--                                <p class="text-danger"> {{ $message }} </p>--}}
                                {{--                                @enderror--}}
                                {{--                            </div> <!-- form-group end.// -->--}}
                                {{--                        </div> <!-- form-row.// -->--}}

                                {{--                        <div class="form-row">--}}
                                {{--                            <div class="form-group col-md-12">--}}
                                {{--                                <label>اسم العميل </label>--}}
                                {{--                                <input type="text" class="form-control" name='client_name' value="">--}}
                                {{--                                @error('client_name')--}}
                                {{--                                <p class="text-danger"> {{ $message }} </p>--}}
                                {{--                                @enderror--}}
                                {{--                            </div> <!-- form-group end.// -->--}}
                                {{--                        </div> <!-- form-row.// -->--}}

                                {{--                        <div class="form-row">--}}
                                {{--                            <div class="form-group col-md-12">--}}
                                {{--                                <label> رقم موبيل العميل </label>--}}
                                {{--                                <input type="text" class="form-control" name='phone' value="">--}}
                                {{--                                @error('phone')--}}
                                {{--                                <p class="text-danger"> {{ $message }} </p>--}}
                                {{--                                @enderror--}}
                                {{--                            </div>--}}
                                {{--                        </div>--}}
                                @if(count($items) > 0)
                                    <button class="btn btn-primary btn-block">{{__('site.add_order')}}</button>
                                @endif
                                <br>
                            </div>
                </form>
            </div> <!-- card-body.// -->
        </div>
    </aside> <!-- col.// -->
</div>

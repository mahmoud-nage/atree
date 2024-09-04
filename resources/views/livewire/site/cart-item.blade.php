<tr>
    <td class="col-3">
        <figure class="itemside">
            {{--            <div class="aside">--}}
            {{--                <a href="{{ Storage::url('designs/'.$item->design_front_image) }}" target="_blank">--}}
            {{--                    <img src="{{ Storage::url('designs/'.$item->design_front_image) }}" class="img-sm">--}}
            {{--                </a>--}}
            {{--            </div>--}}
            <figcaption class="info">
                <a href="{{ $item->variation?->product?->url() }}"
                   class="title text-dark">{{ $item->variation?->product?->name }}</a>
                @if ($item->variation?->type != 'one_size' )
                    <p class="text-muted small"> {{$item->variation->color->name}},{{$item->variation->size->name}}
                        <br>
                    </p>
                @endif
            </figcaption>
        </figure>
    </td>
    <td class="col-2">
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
                {{--                <a href="#">--}}
                {{--                    <img--}}
                {{--                        style="background-color: {{$item->design->main_color_code}}"--}}
                {{--                        src="{{Storage::url('products/'.$item->design->back_image)}}">--}}
                {{--                    <img class="img-fluid pad" alt="design"--}}
                {{--                         src="{{Storage::url('designs/'.$item->design->design_image_back)}}"--}}
                {{--                         style="width: {{$item->product->site_back_width}}%; height: {{$item->product->site_back_height}}%; top: {{$item->product->site_back_top}}%; left: {{$item->product->site_back_left}}%;position: absolute;">--}}

                {{--                    <img src="{{ Storage::url('designs/'.$item->design_back_image) }}" class="img-sm float-none">--}}
                {{--                </a>--}}
            </div>
        </figure>
    </td>
    <td class="col-2">
        <figure class="itemside">
            <div class="aside d-flex">
                {{--                <a href="#">--}}
                {{--                    //{{ Storage::url('designs/'.$item->design_front_image) }}--}}
                {{--                    <img src="{{ Storage::url('designs/'.$item->design_front_image) }}" class="img-sm float-none">--}}
                {{--                    <img--}}
                {{--                        style="background-color: {{$item->design->main_color_code}}"--}}
                {{--                        src="{{Storage::url('products/'.$item->design->image)}}">--}}
                {{--                    <img class="img-fluid pad" alt="design"--}}
                {{--                         src="{{Storage::url('designs/'.$item->design->design_image_front)}}"--}}
                {{--                         style="width: {{$item->product->site_front_width}}%; height: {{$item->product->site_front_height}}%; top: {{$item->product->site_front_top}}%; left: {{$item->product->site_front_left}}%;position: absolute;">--}}

                {{--                </a>--}}
                <a href="#">
                    <img
                        style="background-color: {{$item->design->main_color_code}}"
                        src="{{Storage::url('products/'.$item->design->back_image)}}">
                    @if($item->design->design_image_back)
                        <img class="img-fluid pad" alt="design"
                             src="{{Storage::url('designs/'.$item->design->design_image_back)}}"
                             style="width: {{$item->product->site_back_width}}%; height: {{$item->product->site_back_height}}%; top: {{$item->product->site_back_top}}%; left: {{$item->product->site_back_left}}%;position: absolute;">
                    @endif

                    {{--                        <img src="{{ Storage::url('designs/'.$item->design_back_image) }}" class="img-sm float-none">--}}
                </a>
            </div>
        </figure>
    </td>
    <td class="col-2">
        {{ $item->price }} <span class="text-muted"> {{__('site.SAR')}} </span>
    </td>
    {{--    <td class="col-2">--}}
    {{--        <div class="price-wrap">--}}
    {{--            <input type="text" class='form-control' value='{{ $item->price }}' wire:model='price'>--}}
    {{--        </div>--}}
    {{--    </td>--}}
    <td class="col-2">
        <select class="form-control" wire:model='quantity'>
            @for ($i = 1; $i < 20 ; $i++)
                <option value='{{ $i }}' {{ $item->quantity == $i ? 'selected="selected"' : '' }} >{{ $i }}</option>
            @endfor
        </select>
    </td>
    {{--    <td class="col-2">--}}
    {{--        <div class="price-wrap">--}}
    {{--            {{ ($item->variation?->product->marketer_price * $item->quantity ) + (($item->price - $item->variation?->product->getPrice()) * $item->quantity )  }}--}}
    {{--        </div>--}}
    {{--    </td>--}}
    <td class="text-right col-1">
        {{--        <a href="#" class="btn btn-primary" style="min-width: 45px !important; font-size: 14px !important;">--}}
        {{--            <i class="fa fa-heart"></i>--}}
        {{--        </a>--}}
        <a href="#" wire:click='removeItem({{ $item->id }})' class="text-danger"
           style="min-width: 45px !important; font-size: 27px !important;margin-top: -3px; margin-bottom: 0.5rem; float: left">
            <i class="fa fa-trash"></i> </a>
        {{--        @livewire('site.add-product-to-wishlist' , ['product' => $item?->product])--}}

    </td>
</tr>

<div class="row">
    <main class="col-md-9">
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
                    <th scope="col" class="text-right" width="200"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
                    @livewire('site.cart-item' , ['item' => $item ] ,  $item->id )
                @endforeach
                </tbody>
            </table>

            <div class="card-body border-top">
                {{--          {{ route('checkout.index') }}--}}
                @if(count($items) > 0)
                    <a href="{{ route('checkout.index') }}"
                       class="btn btn-primary float-md-right"> {{__('site.add_order')}} <i
                            class="fa fa-chevron-left"></i> </a>
                @endif
                <a href="{{ url('/') }}" class="btn btn-light"> <i
                        class="fa fa-chevron-right"></i> {{__('site.continue_shopping')}} </a>
            </div>
        </div> <!-- card.// -->


    </main> <!-- col.// -->
    <aside class="col-md-3">
        <div class="card mb-3">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label> {{__('site.are_you_have_discount_code')}} </label>
                        <div class="input-group">
                            <input type="text" class="form-control" wire:model='coupon'
                                   placeholder="{{__('site.discount_code')}}">
                            <span class="input-group-append">
                                <button class="btn btn-primary"
                                        wire:click='checkCoupon()'> {{__('site.submit')}} </button>
                              </span>
                        </div>
                    </div>
                </form>
            </div> <!-- card-body.// -->
        </div>  <!-- card .// -->
        <div class="card">
            <div class="card-body">
                <dl class="dlist-align">
                    <dt style="width:143px !important;"> {{__('site.sub_total')}} :</dt>
                    <dd class="text-right">{{ $this->sub_total }} <span class='text-muted'> {{__('site.SAR')}}</span>
                    </dd>
                </dl>
{{--                <dl class="dlist-align">--}}
{{--                    <dt style="width:143px !important;">{{__('site.profit')}} :</dt>--}}
{{--                    <dd class="text-right">{{ $this->marketer_bounse }} <span--}}
{{--                            class='text-muted'> {{__('site.SAR')}}</span></dd>--}}
{{--                </dl>--}}
                <dl class="dlist-align">
                    <dt style="width:143px !important;">{{__('site.shipping_price')}} :</dt>
                    <dd class="text-right text-muted"> 0 <span class='text-muted'> {{__('site.SAR')}}</span></dd>
                </dl>
                <dl class="dlist-align">
                    <dt style="width:143px !important;">{{__('site.discount')}} :</dt>
                    <dd class="text-right text-danger"> -{{$this->discount}} <span
                            class='text-danger'> {{__('site.SAR')}}</span></dd>
                </dl>
                <dl class="dlist-align">
                    <dt style="width:143px !important;"> {{__('site.total')}} :</dt>
                    <dd class="text-right h5"><strong>{{ $this->total }} </strong> <span
                            class='text-muted'> {{__('site.SAR')}} </span></dd>
                </dl>
            </div> <!-- card-body.// -->
        </div>  <!-- card .// -->
    </aside> <!-- col.// -->
</div>

<div>
    <div class="mb-3"> 
        @if ($product->hasDiscount())
        <var class=" h4"> سعر المنتج : {{ $product->price_after_discount }} جنيه  </var> 
        <span class="text-muted old-price"> <del>{{ $product->price }}</del> جنيه</span> 
        @else
        <var class=" h4"> سعر المنتج : {{ $product->price }} جنيه  </var> 
        @endif
    </div> 
    <dl class="row">
        <dt class="col-sm-3 "> الربح من اجمالي السعر : </dt>
        <dd class="col-sm-9 h4" style='color:#53cc05' > {{ $product->marketer_price }} جنيه </dd>   
        <dt class="col-sm-3 "> عدد نقاط الجائزه : </dt>
        <dd class="col-sm-9 h5"> {{ $product->points }} نقطه </dd>         
    </dl>
    <hr>

    <div class="row">
        <div class="col-md-6">
            <h6 style='color: #6B14BE' >سعر البيع الموصي به من شركة تاجر</h6>
            <li class='list-unstyled' style='color: #6B14BE' >الحد الأدني :  <span> {{ $product->min_price }} ج.م</span> <span class="until">حتي </span> أقصي 
                <span >{{ $product->max_price }} ج.م</span>
            </li>
        </div>
        <div class="col-md-6">
            <h6 style='color: #6B14BE' >الأرباح بناءا علي معدلاتنا الموصي بها</h6>
            <li class='list-unstyled' style='color: #6B14BE' >
                <span  > {{ $product->marketer_price + ($product->min_price - $product->price  ) }} ج.م</span>
                <span class="until"> حتي </span>
                <span   >{{ $product->marketer_price + ($product->max_price - $product->price ) }} ج.م</span> 
            </li>
        </div>
    </div>




    <div class="form  mt-4">
        @if ($initialVariation)
        @livewire('site.product-dropdown' ,  ['variations' => $initialVariation ] )
        @endif
        <br>
        <div class="form-group col-md flex-grow-0">
            <div class="input-group mb-3 input-spinner">
                <div class="input-group-prepend">
                    <button class="btn btn-light" wire:click='increasQuantity()' type="button" id="button-plus"> + </button>
                </div>
                <input type="text" class="form-control" value="{{ $quantity }}">
                <div class="input-group-append">
                    <button class="btn btn-light" wire:click='dcreasQuantity()' type="button" id="button-minus"> &minus; </button>
                </div>
            </div>
        </div> 
        <div class="form-group col-md">

            @if ($finalVariant || !$hasVariant )
            <a wire:click='add_to_cart()' href='#' class="btn btn-primary"> 
                <i class="fas fa-shopping-cart"></i> <span class="text"> اضف الى السله </span> 
            </a>
            @endif

            @if ($isInMyWishList)
            <a href="#" wire:click='add_to_wishlist({{ $product->id }})' class="btn btn-light">
                <i class="fas fa-trash"></i> <span class="text"> حذف من قائمه الامنيات </span> 
            </a>
            @else
            <a href="#" wire:click='add_to_wishlist({{ $product->id }})' class="btn btn-light">
                <i class="fas fa-heart"></i> <span class="text"> إضف الى قائمه الامنيات </span> 
            </a>
            @endif
        </div> 
    </div> 
</div>
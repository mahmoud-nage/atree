<div>
    @foreach ($wishlist_products as $wishlist_product)
        <div class="card">
            <div class="card-body">
                <div class="square-img">
                    <img src="{{ Storage::url('products/'.$wishlist_product->product?->front_image) }}">
                </div>
                <div class="d-inline-flex flex-column flex-fill">
                    <div class="category-top">
                        <h4 class="card-title"> {{ $wishlist_product->product?->name }} </h4>
                        <h4 class="card-title"> {{ $wishlist_product->product?->price }} @lang('site.SAR') <label
                                class="AddToWishlist">
                                @livewire('site.add-product-to-wishlist' , ['product' => $wishlist_product->product ] )
                            </label></h4>
                    </div>
                    <div class="category-bottom">
                        <div>
                            <p class="card-text">
                                {!! $wishlist_product->product?->description !!}
                            </p>
                            {{--            <div class="tag-btns-container">--}}
                            {{--              <a href="#" class="btn tag-btn"> Tag link </a>--}}
                            {{--              <a href="#" class="btn tag-btn"> Tag link </a>--}}
                            {{--              <a href="#" class="btn tag-btn"> Tag link </a>--}}
                            {{--              <a href="#" class="btn tag-btn"> Tag link </a>--}}
                            {{--              <a href="#" class="btn tag-btn"> Tag link </a>--}}
                            {{--              <a href="#" class="btn tag-btn"> Tag link </a>--}}
                            {{--            </div>--}}
                        </div>
                        <div class="buttons-container">
                            <a href="{{ $wishlist_product->product?->url() }}"
                               class=" btn btn-primary"> @lang('site.Customize') </a>
                            <a href="#" class=" btn btn-primary" data-toggle="modal"
                               data-target="#exampleModal{{ $wishlist_product->id }}"> @lang('site.delete') </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal{{ $wishlist_product->id }}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header"> @lang('site.Confirmation') </div>
                    <div class="modal-body">
                        @lang('site.Are you sure you want to delete') ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal"> @lang('site.No') </button>
                        <button type="button" class="btn btn-primary"
                                wire:click="removeFromWishList({{ $wishlist_product->product?->id }})"
                                data-dismiss="modal"> @lang('site.Yes') </button>
                    </div>
                </div>
            </div>
        </div>

    @endforeach


</div>



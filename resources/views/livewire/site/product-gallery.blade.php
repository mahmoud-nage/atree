<article class="gallery-wrap"> 
    <div class="img-big-wrap">
        <div> <a href="#"><img src="{{ $image }}"></a></div>
    </div> 
    <div class="thumbs-wrap">
        <a href="#" class="item-thumb"> <img src="{{ Storage::url('products/'.$product->image) }}"></a>
        @foreach ($product->images as $product_image)
        <a href="#" class="item-thumb"> <img src="{{ Storage::url('products/'.$product_image->image) }}"></a>
        @endforeach
    </div>
</article> 
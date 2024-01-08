<div class="col-md-4">
    <div href="{{ $product->url() }}" class="card card-sm card-product-grid">
        <a href="{{ $product->url() }}" class="img-wrap"> 
         @if ($product->hasDiscount())
         <b class="badge badge-danger mr-1"> @lang('site.discount') {{ $product->discount_percentage }} % </b>
         @endif            
         <img src="{{ Storage::url('products/'.$product->image) }}"> 
     </a>
     <figcaption class="info-wrap">
        <a href="{{ $product->url() }}" class="title">{{ $product->name }}</a>
        <div class="price-wrap">
           @if ($product->hasDiscount())
           <span class="price"> {{ $product->price_after_discount }}  جنيه </span>
           <del class="price-old"> {{ $product->price }}  جنيه </del>
           @else
           <span class="price"> {{ $product->price }} جنيه </span>
           @endif
       </div> 
   </figcaption>
</div>
</div> 
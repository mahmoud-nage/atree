@if ($isInMyWishList)
<a href="#" wire:click='add_to_wishlist({{ $product->id }})' class="btn btn-light">
  <i class="fas fa-trash"></i> <span class="text"> حذف من قائمه الامنيات </span> 
</a>
@else
<a href="#" wire:click='add_to_wishlist({{ $product->id }})' class="btn btn-light">
  <i class="fas fa-heart"></i> <span class="text"> إضف الى قائمه الامنيات </span> 
</a>
@endif

<div>
    <label class="AddToWishlist"> <input wire:model='is_in_wishlist' type="checkbox" />  
        @if ($is_in_wishlist)
        <i class="fas fa-heart"></i>
        @else
        <i class="fa fa-heart"></i>
        @endif
    </label>
</div>

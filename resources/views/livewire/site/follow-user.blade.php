<button wire:click='follow()' class="btn btn-primary"> 
    @if ($is_in_my_follwe_list)
    @lang('site.UnFollow') 
    @else
    @lang('site.Follow') 

    @endif
</button>
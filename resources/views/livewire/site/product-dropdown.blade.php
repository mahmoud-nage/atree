<div>
    <div class="form-group col-md-6">
        <label>  @lang('site.'.$variations->first()?->type) </label>
        <select wire:model='selectedVariation' id="inputState" class="form-control">
            <option> من فضلك اختار @lang('site.'.$variations->first()?->type) </option>
            @foreach ($variations as $variation)
            <option value='{{ $variation->id }}' > {{ $variation->title }} -- {{ $variation->stockCount() }} </option>
            @endforeach
        </select>
    </div>

    @if ($this->selectedVariationModel?->children->count())
    @livewire('site.product-dropdown' , ['variations' => $this->selectedVariationModel?->children  , key(Str::uuid()->toString()) ] )
    @endif


</div>

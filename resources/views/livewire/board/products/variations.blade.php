<div>
    
    <button class="btn btn-primary mb-2"  data-toggle="modal" data-target="#modal_form_horizontal" >
        إضافه متغير جديد
    </button>

    <div class='card card-body' >
        @foreach ($variations as $variant)
        @livewire('board.products.variations.parent-variation' , ['variant' => $variant ] ,key($variant->id) )
        @endforeach

    </div>
    @livewire('board.products.variations.add-parent-variant' , ['product' => $product ] )

</div>
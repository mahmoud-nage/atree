<li class='row ml-2' >
    <div class="col-md-2">
        <div class="form-group">
            <label class="col-form-label"> الباركود </label>
            <input type="color" class="form-control @error('color') is-invalid @enderror" wire:model='color' >
            @error('color')
            <p  class='text-danger' >  {{ $message }} </p>
            @enderror
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label class="col-form-label"> الاسم </label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model='title'  >
            @error('title')
            <p  class='text-danger' >  {{ $message }} </p>
            @enderror
        </div>
    </div>


    <div class="col-md-2">
        <div class="form-group">
            <label class="col-form-label"> البار كود </label>
            <input type="text" class="form-control @error('barcode') is-invalid @enderror" wire:model='barcode' >
            @error('barcode')
            <p  class='text-danger' >  {{ $message }} </p>
            @enderror
        </div>
    </div>


    <div class="col-md-2">
        <div class="form-group">
            <label class="col-form-label"> السعر </label>
            <input type="text" class="form-control @error('price') is-invalid @enderror" wire:model='price' >
            @error('price')
            <p  class='text-danger' >  {{ $message }} </p>
            @enderror
        </div>
    </div>


    <div class="col-md-2">
        <div class="form-group">
            <label class="col-form-label"> خصائص </label> <br>
            <button title='الغاء' wire:click='deleteVariant()' class="btn btn-outline-danger delete_color_row  border-2 ml-2"><i class="icon-trash"></i></button>
        </div>                                      
    </div>
</li>
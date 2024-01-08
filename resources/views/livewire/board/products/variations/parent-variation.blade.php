<div class="row main_row"  >
   

    <div class="col-md-3">
        <div class="form-group">
            <label class="col-form-label"> اللون </label>
            <select  wire:model='color_id' class='select form-control' id="">
                @foreach ($colors as $color)
                    <option value="{{ $color->id }}"> {{ $color->name }} </option>
                @endforeach
            </select>
            @error('types')
            <p class='text-danger' >  {{ $message }} </p>
            @enderror
        </div>
    </div>


     <div class="col-md-3">
        <div class="form-group">
            <label class="col-form-label"> المقاس </label>
            <select  wire:model='size_id' class='select form-control' id="">
                @foreach ($sizes as $size)
                    <option value="{{ $size->id }}"> {{ $size->name }} </option>
                @endforeach
            </select>
            @error('types')
            <p class='text-danger' >  {{ $message }} </p>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label class="col-form-label"> الكميه </label>
            <input type="text" class="form-control @error('quantity') is-invalid @enderror" wire:model='quantity' value="{{ old('quantity') }}" >
            @error('price')
            <p  class='text-danger' >  {{ $message }} </p>
            @enderror
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label class="col-form-label"> خصائص </label> <br>
            <button title='الغاء'  wire:click='deleteVariant()' class="btn btn-outline-danger delete_main_row  border-2 ml-2"><i class="icon-trash"></i></button>
        </div>                                      
    </div>

</div>

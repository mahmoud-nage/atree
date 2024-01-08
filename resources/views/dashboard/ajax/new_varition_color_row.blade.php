<li class='row ml-2' >

    <div class="col-md-2">
        <div class="form-group">
            <label class="col-form-label"> البار كود </label>
            <input type="text" class="form-control @error('color_barcode.*') is-invalid @enderror" name="color_barcode[{{ $main_row_number }}][]" value="{{ old('color_barcode.*') }}" >
            @error('color_barcode.*')
            <p  class='text-danger' >  {{ $message }} </p>
            @enderror
        </div>
    </div>


    <div class="col-md-2">
        <div class="form-group">
            <label class="col-form-label"> الاسم </label>
            <input type="text" class="form-control @error('color_names.*') is-invalid @enderror" name="color_names[{{ $main_row_number }}][]" value="{{ old('color_names.*') }}" >
            @error('color_names.*')
            <p  class='text-danger' >  {{ $message }} </p>
            @enderror
        </div>
    </div>




    <div class="col-md-2">
        <div class="form-group">
            <label class="col-form-label"> الباركود </label>
            <input type="color" class="form-control @error('colors.*') is-invalid @enderror" name="colors[{{ $main_row_number }}][]" value="{{ old('colors.*') }}" >
            @error('colors.*')
            <p  class='text-danger' >  {{ $message }} </p>
            @enderror
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label class="col-form-label"> السعر </label>
            <input type="text" class="form-control @error('color_prices.*') is-invalid @enderror" name="color_prices[{{ $main_row_number }}][]" value="{{ old('color_prices.*') }}" >
            @error('color_prices.*')
            <p  class='text-danger' >  {{ $message }} </p>
            @enderror
        </div>
    </div>


    <div class="col-md-2">
        <div class="form-group">
            <label class="col-form-label"> صور اللون </label>
            <input type="file" multiple class="form-control @error('color_images.*') is-invalid @enderror" name="color_images[{{ $main_row_number }}][]" value="{{ old('color_images.*') }}" >
            @error('color_images.*')
            <p  class='text-danger' >  {{ $message }} </p>
            @enderror
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label class="col-form-label"> خصائص </label> <br>
            <button title='الغاء' class="btn btn-outline-danger delete_color_row  border-2 ml-2"><i class="icon-trash"></i></button>
        </div>                                      
    </div>
</li>
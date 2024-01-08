<div class="row main_row"  >

    <div class="col-md-3">
        <div class="form-group">
            <label class="col-form-label"> اللون </label>
            <select name="colors[]" required class='select form-control' id="">
                @foreach ($colors as $color)
                <option value="{{ $color->id }}"> {{ $color->name }} </option>
                @endforeach
            </select>
            @error('colors.*')
            <p class='text-danger' >  {{ $message }} </p>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label class="col-form-label"> المقاس </label>
            <select name="sizes[]" required class='select form-control' id="">
                @foreach ($sizes as $size)
                <option value="{{ $size->id }}"> {{ $size->name }} </option>
                @endforeach
            </select>
            @error('sizes.*')
            <p class='text-danger' >  {{ $message }} </p>
            @enderror
        </div>
    </div>


    <div class="col-md-3">
        <div class="form-group">
            <label class="col-form-label"> الكميه المتاحه </label>
            <input type="number" required class="form-control @error('quantity.*') is-invalid @enderror" name="quantity[]" value="{{ old('quantity.*') }}" >
            @error('quantity.*')
            <p  class='text-danger' >  {{ $message }} </p>
            @enderror
        </div>
    </div>


    <div class="col-md-3">
        <div class="form-group">
            <label class="col-form-label"> خصائص </label> <br>
            <button title='الغاء' class="btn btn-outline-danger delete_main_row  border-2 ml-2"><i class="icon-trash"></i></button>
        </div>                                      
    </div>

    <div class="child-row col-md-12"  >
        <ul class='' >

        </ul>
    </div>

</div>
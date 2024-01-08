<div>
    <div id="modal_form_horizontal" class="modal fade" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> إضافه لون ال المنتج </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form  class="form-horizontal" wire:submit.prevent="save" >
                    <div class="modal-body">

                        <div class="form-group row">
                            <label class="col-form-label"> اللون </label>
                            <select  wire:model='color_id' class='select form-control' id="">
                                <option value=""></option>
                                @foreach ($colors as $color)
                                <option value="{{ $color->id }}"> {{ $color->name }} </option>
                                @endforeach
                            </select>
                            @error('types')
                            <p class='text-danger' >  {{ $message }} </p>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label"> المقاس </label>
                            <select  wire:model='size_id' class='select form-control' id="">
                                <option value=""></option>
                                
                                @foreach ($sizes as $size)
                                <option value="{{ $size->id }}"> {{ $size->name }} </option>
                                @endforeach
                            </select>
                            @error('types')
                            <p class='text-danger' >  {{ $message }} </p>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label"> الكميه </label>
                            <input type="text" class="form-control @error('quantity') is-invalid @enderror" wire:model='quantity' value="{{ old('quantity') }}" >
                            @error('price')
                            <p  class='text-danger' >  {{ $message }} </p>
                            @enderror
                        </div>



                    </div>

                    <div class="modal-footer">
                        <button type="button" class="dismiss_modal btn btn-link" data-dismiss="modal"> الغاء </button>
                        <button type="submit" class="btn btn-primary"> إضافه </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



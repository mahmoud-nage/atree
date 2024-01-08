<div>
    <div id="modal_form_horizontal" class="modal fade" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> إضافه لون ال المنتج </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form  class="form-horizontal" wire:submit.prevent="save" >
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3"> اللون </label>
                            <div class="col-sm-9">
                                <input type="color" wire:model='color' placeholder="اللون" class="form-control @error('color') is-invalid @enderror ">
                                @error('color')
                                <p class='text-danger'> {{ $message }} </p>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-sm-3"> الاسم </label>
                            <div class="col-sm-9">
                                <input type="text" wire:model='title' placeholder="الاسم" class="form-control @error('title') is-invalid @enderror ">
                                @error('title')
                                <p class='text-danger'> {{ $message }} </p>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-sm-3"> باركود </label>
                            <div class="col-sm-9">
                                <input type="text" wire:model='barcode' placeholder="باركود" class="form-control @error('barcode') is-invalid @enderror ">
                                @error('barcode')
                                <p class='text-danger'> {{ $message }} </p>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-sm-3"> السعر </label>
                            <div class="col-sm-9">
                                <input type="text" wire:model='price' placeholder="السعر" class="form-control @error('price') is-invalid @enderror ">
                                @error('price')
                                <p class='text-danger'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3"> الصور </label>
                            <div class="col-sm-9">
                                <input type="file" multiple wire:model='images' placeholder="الصور" class="form-control @error('images') is-invalid @enderror ">
                                @error('images')
                                <p class='text-danger'> {{ $message }} </p>
                                @enderror
                            </div>
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




<div>
    @for ($i = 0; $i <5; $i++)
    <div class="row" data-number={{ $i }} >
        <div class="col-md-2">
            <div class='mb-2' >
                <div class="form-group">
                    <label class="col-form-label"> اللون </label>
                    <input type="text" class="form-control @error('name.*') is-invalid @enderror" name="name[]" value="{{ old('name.*') }}" >
                    @error('name.*')
                    <p  class='text-danger' >  {{ $message }} </p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div  class='mb-2' >
                <div class="form-group">
                    <label class="col-form-label"> المقاس </label>
                    <select name="sizes[]" class="form-control" id="">
                        @foreach ($sizes as $size)
                        <option value="{{ $size->id }}"> {{ $size->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class='mb-2' >
                <div class="form-group">
                    <label class="col-form-label"> السعر </label>
                    <input type="text" class="form-control @error('price.*') is-invalid @enderror" name="price[]" value="{{ old('price.*') }}" >
                    @error('price.*')
                    <p  class='text-danger' >  {{ $message }} </p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class='mb-2' >
                <div class="form-group">
                    <label class="col-form-label"> البار كود </label>
                    <input type="text" class="form-control @error('barcode.*') is-invalid @enderror" name="barcode[]" value="{{ old('barcode.*') }}" >
                    @error('barcode.*')
                    <p  class='text-danger' >  {{ $message }} </p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class='mb-2' >
                <div class="form-group">
                    <label class="col-form-label"> الصوره </label>
                    <input type="file" class="form-control @error('image.*') is-invalid @enderror" name="image[]" value="{{ old('image.*') }}" >
                    @error('image.*')
                    <p  class='text-danger' >  {{ $message }} </p>
                    @enderror
                </div>
            </div>
        </div>



        <div class="col-md-2 mt-4">
            <div class="form-group ">
                <label  class="col-form-label">  </label>
                {{-- @if ($deletable)
                <a class=' btn btn-danger btn-sm' wire:click.prevent='deleteRow({{ $i }})' > حذف </a>
                @endif
                @if ($isParent)
                <a class=' btn btn-primary btn-sm' > فرعى </a>
                @endif --}}
            </div>
        </div>
    </div>
    @endfor
</div>


@section('scripts')

<script>
    $(function() {
        Livewire.on('deleteRowNumber', compnonatNumber => {

            $(document).find('.row').find('*[data-number="'+ compnonatNumber +'"]').remove();

        } );




    });
</script>
@endsection
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title my-2"> @lang('site.Your Address') </h3>
    </div>
    <div class="card-body p-3 my-Addresses">
        <div class="row">
            <div class="col-md-{{$this->size}}">
                <div class="card addAddress" data-toggle="modal" data-target="#addAdressPopup">
                    <div class="card-body">
                        <i class="fa fa-plus"></i>
                        <div class="addAddressText"> @lang('site.Add new Address') </div>
                    </div>
                </div>
            </div>
            <!--Add Adress Modal -->
            <div class="modal fade" id="addAdressPopup" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class="form-horizontal" wire:submit.prevent="save" >
                                <div class="form-group ">
                                    <label for="inputCountry" class="col-md-12 form-label"> @lang('site.Country') </label>
                                    <div class="col-md-12">
                                        <select wire:model='country_id' class='form-control' id="">
                                            <option value=""></option>
                                            @foreach ($this->countries as $country)
                                            <option value="{{ $country->id }}"> {{ $country->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                        <p class='text-danger'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="inputGovernorate" class="col-md-12 form-label"> @lang('site.Governorate') </label>
                                    <div class="col-md-12">
                                        <select wire:model='governorate_id'  class='form-control' id="">
                                            <option value=""></option>
                                            @foreach ($this->governorates as $governorate)
                                            <option value="{{ $governorate->id }}"> {{ $governorate->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('governorate_id')
                                        <p class='text-danger'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="inputCity" class="col-md-12 form-label"> @lang('site.City') </label>
                                    <div class="col-md-12">
                                        <select wire:model='city_id' class='form-control' id="">
                                            <option value=""></option>
                                            @foreach ($this->cities as $city)
                                            <option value="{{ $city->id }}"> {{ $city->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                        <p class='text-danger'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ApartmentNumber" class="col-md-12 form-label"> @lang('site.District') </label>
                                    <div class="col-md-12">
                                        <input type="text" wire:model='district' class="form-control" id="ApartmentNumber" placeholder="">
                                        @error('district')
                                        <p class='text-danger'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ApartmentNumber"  class="col-md-12 form-label"> @lang('site.Building Number') </label>
                                    <div class="col-md-12">
                                        <input type="text" wire:model='building_number' class="form-control" id="ApartmentNumber" placeholder="">
                                        @error('building_number')
                                        <p class='text-danger'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Region" class="col-md-12 form-label"> @lang('site.Street Name') </label>
                                    <div class="col-md-12">
                                        <input type="text" wire:model='street_name'  class="form-control" id="Region" placeholder="Region">
                                        @error('street_name')
                                        <p class='text-danger'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mt-2 mb-0">
                                    <div class="text-center col-md-12">
                                        <button type="submit" class="btn btn-primary"> @lang('site.Add') </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($addresses as $address)
            <div class="col-md-{{$this->size}}">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> {{ $address->country?->name }} </h5>
                        <h6 class="card-subtitle mb-2 text-muted"> {{ $address->building_number }} -  {{ $address->street_name }} - {{ $address->district }}   </h6>
                        <h6 class="card-subtitle mb-2 text-muted"> {{ $address->city?->name }} </h6>
                        <h6 class="card-subtitle mb-2 text-muted"> {{ $address->governorate?->name }} </h6>
                        <h6 class="card-subtitle mb-2 text-muted">{{ Auth::user()->phone }} </h6>
                        <button data-item_id='{{ $address->id }}' type="button" class="delete_address btn card-link text-primary p-0"> @lang('site.Remove') </button>
                        <button wire:click='makeDefault({{ $address->id }})' type="button" class="btn card-link text-primary p-0"> @lang('site.Set as defaulte') </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).on('click', 'button.delete_address', function(event) {
        event.preventDefault();
        var item_id = $(this).attr('data-item_id');
        Swal.fire({
            title: "@lang('site.Are you sure?')",
            text: "@lang('site.You won\'t be able to revert this!')",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "@lang('site.Yes Delete')" ,
            cancelButtonText: "@lang('site.No')" ,
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('deleteItem' , item_id );
            }
        })
    });

    Livewire.on('addressAdded', () => {
        $('#addAdressPopup').modal('hide');
    })
</script>
@endsection

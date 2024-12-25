<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title my-2"> @lang('site.My Banks') </h3>
    </div>
    <div class="card-body p-3 my-Banks">
        <div class="row">
            <div class="col-md-3">
                <div class="card addAddress" data-toggle="modal" data-target="#addBankPopup">
                    <div class="card-body">
                        <i class="fa fa-plus"></i>
                        <div class="addAddressText"> @lang('site.Add new Bank') </div>
                    </div>
                </div>
            </div>
            <!--Add Adress Modal -->
            <div class="modal fade" id="addBankPopup" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class="form-horizontal" wire:submit.prevent="save" >
                                <div class="form-group row">
                                    <label for="name" class="col-md-12 form-label"> @lang('site.Name') </label>
                                    <div class="col-md-12">
                                        <input type="text" wire:model='name' class="form-control" id="name" placeholder="">
                                        @error('name')
                                        <p class='text-danger'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bank_name" class="col-md-12 form-label"> @lang('site.Bank Name') </label>
                                    <div class="col-md-12">
                                        <input type="text" wire:model='bank_name' class="form-control" id="bank_name" placeholder="">
                                        @error('bank_name')
                                        <p class='text-danger'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="account_number"  class="col-md-12 form-label"> @lang('site.account_number') </label>
                                    <div class="col-md-12">
                                        <input type="text" wire:model='account_number' class="form-control" id="account_number" placeholder="">
                                        @error('account_number')
                                        <p class='text-danger'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="iban" class="col-md-12 form-label"> @lang('site.iban') </label>
                                    <div class="col-md-12">
                                        <input type="text" wire:model='iban'  class="form-control" id="iban" placeholder="iban">
                                        @error('iban')
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
            @foreach ($banks as $bank)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> {{ $bank->name }} </h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $bank->bank_name }} </h6>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $bank->account_number }} </h6>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $bank->iban }} </h6>
                        <button data-item_id='{{ $bank->id }}' type="button" class="delete_bank btn card-link text-primary p-0"> @lang('site.Remove') </button>
{{--                        <button wire:click='makeDefault({{ $bank->id }})' type="button" class="btn card-link text-primary p-0"> @lang('site.Set as defaulte') </button>--}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).on('click', 'button.delete_bank', function(event) {
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
        $('#addBankPopup').modal('hide');
    })
</script>
@endsection

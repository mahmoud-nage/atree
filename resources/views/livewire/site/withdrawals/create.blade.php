<div>
    <form action="{{ route('site.withdrawals.store') }}" method='POST' >
        @csrf



        <div class="form-group">
            <label class="custom-control custom-radio custom-control-inline">
                <input class="custom-control-input"  wire:model='type'  type="radio" name="payment_method" value="1" {{ old('payment_method') == 1 ? 'checked' : '' }} >
                <span class="custom-control-label"> محفظه الكتورنيه </span>
            </label>
            <label class="custom-control custom-radio custom-control-inline">
                <input class="custom-control-input"  wire:model='type' type="radio" name="payment_method" value="2" {{ old('payment_method') == 1 ? 'checked' : '' }} >
                <span class="custom-control-label"> تحويل بنكى </span>
            </label>
        </div>


        @if ($type == 1 )

        <div class="col-md-12">
            <div class="form-group">
                <label for=""> رقم المحفظه الاكتورنيه  </label>
                <input type="text" class='form-control' name="phone" value="{{ Auth::user()->phone }}" >
            </div>
        </div>

        @endif

        @if ($type == 2 )

        <div class="col-md-12">
            <div class="form-group">
                <label for=""> اسم البنك  <span class='text-danger'> * </span> </label>
                <input type="text" class='form-control' name="bank_name" value="{{ old('bank_name') }}" >
                @error('bank_name')
                <p class="text-danger" > {{ $message }} </p>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for=""> اسم صاحب الحساب<span class='text-danger'> * </span>  </label>
                <input type="text" class='form-control' name="name" value="{{ old('name') }}" >
                 @error('name')
                <p class="text-danger" > {{ $message }} </p>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for=""> رقم الحساب <span class='text-danger'> * </span>  </label>
                <input type="text" class='form-control' name="account_number" value="{{ old('account_number') }}" >
                 @error('account_number')
                <p class="text-danger" > {{ $message }} </p>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for=""> Iban  </label>
                <input type="text" class='form-control' name="iban" value="{{ old('iban') }}" >
                 @error('iban')
                <p class="text-danger" > {{ $message }} </p>
                @enderror
            </div>
        </div>

        @endif

        
        @if ($type)
        <div class="card-footer">
            <button class="btn btn-primary"> تقديم الطلب </button> 
        </div>
        @endif
    </form>
</div>

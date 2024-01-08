<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title my-2"> @lang('site.Change Password') </h3>
    </div>
    <div class="card-body">
        <form class="form-horizontal"  wire:submit.prevent="save()" >
            <div class="form-group row">
                <label for="OldPassword" class="col-sm-2 col-form-label"> @lang('site.Old Password') </label>
                <div class="col-sm-10">
                    <input type="password" wire:model='old_password' class="form-control" id="OldPassword" placeholder="@lang('site.Old Password')">
                    @error('old_password')
                    <p class="text-danger"> {{ $message }} </p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="NewPassword" class="col-sm-2 col-form-label"> @lang('site.New Password') </label>
                <div class="col-sm-10">
                    <input type="password" wire:model='password' class="form-control" id="NewPassword" placeholder="@lang('site.New Password')">
                    @error('password')
                    <p class="text-danger"> {{ $message }} </p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="CNewPassword" class="col-sm-2 col-form-label"> @lang('site.Confirm New Password') </label>
                <div class="col-sm-10">
                    <input type="password" wire:model='password_confirmation' class="form-control" id="CNewPassword" placeholder="@lang('site.Confirm New Password')">
                    @error('password_confirmation')
                    <p class="text-danger"> {{ $message }} </p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" > @lang('site.edit') </button>
                </div>
            </div>
        </form>
    </div>
</div>
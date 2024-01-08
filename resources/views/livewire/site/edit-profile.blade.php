
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title my-2"> @lang('site.Edit Profile') </h3>
    </div>
    <div class="card-body">

        <form class="row" wire:submit.prevent="save()" >
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputName" class=" col-form-label"> @lang('site.First Name') </label>
                    <div class="col-sm-12 p-0">
                        <input type="text" wire:model='first_name' class="form-control" id="inputName" placeholder="Name">
                        @error('first_name')
                        <p class="text-danger"> {{ $message }} </p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputName2" class="col-form-label"> @lang('site.Last Name') </label>
                    <div class="col-sm-12 p-0">
                        <input type="text" wire:model='last_name' class="form-control" id="inputName2" placeholder="Name">
                        @error('last_name')
                        <p class="text-danger"> {{ $message }} </p>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputEmail" class="col-form-label"> @lang('site.Email') </label>
                    <div class="col-sm-12 p-0">
                        <input type="email" wire:model='email' class="form-control" id="inputEmail" placeholder="Email">
                        @error('email')
                        <p class="text-danger"> {{ $message }} </p>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputPhone" class="col-form-label"> @lang('site.Phone') </label>
                    <div class="col-sm-12 p-0">
                        <input type="text" wire:model='phone' class="form-control" id="inputPhone" placeholder="Phone">
                        @error('phone')
                        <p class="text-danger"> {{ $message }} </p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputExperience" class="col-form-label"> @lang('site.Bio') </label>
                    <div class="col-sm-12 p-0">
                        <textarea class="form-control" wire:model='bio' id="inputExperience" placeholder=" @lang('site.Bio') "></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputName" class=" col-form-label"> @lang('site.Username') </label>
                    <div class="col-sm-12 p-0">
                        <input type="text" wire:model='username' class="form-control" id="inputName" placeholder="Name">
                        @error('username')
                        <p class="text-danger"> {{ $message }} </p>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="form-group col-md-12">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary"> @lang('site.Edit') </button>
                </div>
            </div>


        </form>
    </div>
</div>


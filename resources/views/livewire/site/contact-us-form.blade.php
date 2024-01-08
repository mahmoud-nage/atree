<div class="col-6">
    <form wire:submit.prevent="save">
        <div class="form-group">
            <label for="inputName"> @lang('site.Name') </label>
            <input type="text" wire:model='name' id="inputName" class="form-control" />
            @error('name')
            <p class='text-danger'> {{ $message }} </p>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputEmail"> @lang('site.Phone') </label>
            <input type="number" wire:model='phone' id="inputPhone" class="form-control" />
            @error('phone')
            <p class='text-danger'> {{ $message }} </p>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputSubject"> @lang('site.Subject') </label>
            <input type="text" id="inputSubject" wire:model='subject' class="form-control" />
            @error('subject')
            <p class='text-danger'> {{ $message }} </p>
            @enderror
        </div>            
        <div class="form-group">
            <label for="inputEmail"> @lang('site.Email') </label>
            <input type="email" wire:model='email' id="inputEmail" class="form-control" />
            @error('email')
            <p class='text-danger'> {{ $message }} </p>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputMessage"> @lang('site.Message') </label>
            <textarea id="inputMessage" wire:model='message' class="form-control" rows="4"></textarea>
            @error('message')
            <p class='text-danger'> {{ $message }} </p>
            @enderror
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="@lang('site.Send message')">
        </div>
    </form>
</div>
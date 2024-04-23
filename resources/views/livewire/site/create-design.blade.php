<div class="card card-primary bio-content">
    <div class="card-header">
        <div>
{{--            <p class="card-title text-lg font-weight-bold mb-0">@lang('site.create')</p>--}}
            <p class="font-weight-normal mb-0">@lang('site.Your Owen Design') </p>
        </div>

    </div>
    <div class="card-body">
        @forelse($records as $record)
            <div class="card card-widget">
                <div class="card-header">
                    <div class="user-block">
                        <img class="img-circle" src="{{ Storage::url('users/'.$record->user->image) ?? '' }}"
                             alt="User Image">
                        <span class="username"><a
                                href="{{$record->user->url() ?? ''}}">{{$record->user->name() ?? ''}}</a></span>
                        <span class="description">@ {{$record->user->username ?? ''}}</span>
                        <span class=" @if($record->is_active) text-success @else text-danger @endif">@if($record->is_active) {{__('site.active')}} @else {{__('site.deactive')}} @endif</span>
                    </div>
                    <!-- /.user-block -->
                    <div class="card-tools">
                        <span class="text-muted p-4">
{{--                            <button data-item_id='{{ $record->id }}' type="button"--}}
{{--                                    class="delete_address btn card-link text-danger p-0"--}}
{{--                                    style="min-width: auto !important;font-size: 1.5rem;"> <i class="fa fa-trash"></i> </button>--}}
                            <button data-item_id='{{ $record->id }}' type="button" data-toggle="modal"
                                    data-target="#addAddressPopup{{$record->id}}"
                                    class="btn card-link text-info p-0"
                                    style="min-width: auto !important;font-size: 1.5rem;"> <i
                                    class="fa fa-pen-square"></i> </button>
                        </span>
                    </div>
                    <div class="ml-auto">
                        {{--            <a class="btn circle-btn fa fa-plus" data-toggle="modal" data-target="#addAddressPopup"></a>--}}
                        <div class="row">
                            <!--Add Adress Modal -->
                            <div class="modal fade" id="addAddressPopup{{$record->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form class="form-horizontal" method="post" action="{{route('designs.update', $record->id)}}">
                                                @csrf
                                                <div class="form-group ">
                                                    <label for="product_id"
                                                           class="col-md-12 form-label"> @lang('site.products') </label>
                                                    <div class="col-md-12">
                                                        <select class='form-control' id="product_id" name="product_id[]" multiple>
                                                            <option value="">@lang('site.Products')</option>
                                                            @foreach ($this->products as $product)
                                                                <option value="{{ $product->id }}" @foreach($record->products as $pro) @if($product->id == $pro->id) selected @endif @endforeach> {{ $product->name }} </option>
                                                            @endforeach
                                                        </select>
                                                        @error('product_id')
                                                        <p class='text-danger'> {{ $message }} </p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="description"
                                                           class="col-md-12 form-label"> @lang('site.description') </label>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" value="{{$record->description}}"
                                                               id="description" name="description" placeholder="@lang('site.description')">
                                                        @error('description')
                                                        <p class='text-danger'> {{ $message }} </p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="description"
                                                           class="col-md-6 form-label"> @lang('site.status') </label>
                                                    <div class="col-md-6">
                                                        <input type="checkbox" class="form-control" @if($record->is_active) checked @endif
                                                               id="is_active" name="is_active" placeholder="@lang('site.is_active')">
                                                        @error('description')
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
                        </div>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="#" class="text-center post-image-container">
                        <img class="img-fluid pad" src="{{Storage::url('designs/'.$record->image)}}" alt="Photo">
                    </a>
                    <p>{{$record->description}}</p>
                    <div class="tag-btns-container">
                        <ul>
                            @foreach($record->products as $product)
                                <a href="{{ $product->url() }}" class="btn tag-btn"> {{$product->name}} </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-primary" role="alert">
                @lang('site.no_records')
            </div>
        @endforelse

    </div>
</div>

@section('scripts')
    <script>
        $(document).on('click', 'button.delete_address', function (event) {
            event.preventDefault();
            var item_id = $(this).attr('data-item_id');

            Swal.fire({
                title: "@lang('site.Are you sure?')",
                text: "@lang('site.You won\'t be able to revert this!')",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "@lang('site.Yes Delete')",
                cancelButtonText: "@lang('site.No')",
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteItem', item_id);
                }
            })
        });
        Livewire.on('addressAdded', () => {
            $('#addAddressPopup').modal('hide');
        })
    </script>
@endsection

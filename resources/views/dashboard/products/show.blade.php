@extends('dashboard.layouts.master')

@section('page_title')
    {{ trans('products.show_product_details') }}
@endsection

@section('page_header')
    <a href="{{ route('dashboard.products.index') }}" class="breadcrumb-item"><i
            class="icon-ampersand  mr-2"></i> @lang('products.products')</a>
    <span class="breadcrumb-item active"> @lang('products.show_product_details') </span>

@endsection
@section('page_content')
    <div class="row">
        <div class="col-lg-12">
            @include('dashboard.layouts.messages')
            <ul class="nav nav-tabs nav-tabs-solid nav-tabs-solid-custom bg-primary nav-justified">
                <li class="nav-item"><a href="#colored-justified-tab1" class="nav-link active"
                                        data-toggle="tab"> {{__('products.product_details')}} </a></li>
                <li class="nav-item"><a href="#colored-justified-tab3" class="nav-link"
                                        data-toggle="tab"> {{__('products.product_photos')}} </a></li>
                <li class="nav-item"><a href="#colored-justified-tab2" class="nav-link"
                                        data-toggle="tab"> {{__('products.variants')}} </a></li>
                <li class="nav-item"><a href="#colored-justified-tab5" class="nav-link"
                                        data-toggle="tab"> {{__('products.design_sizes')}} </a></li>
                <li class="nav-item"><a href="#colored-justified-tab4" class="nav-link"
                                        data-toggle="tab"> {{__('products.statistics')}} </a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="colored-justified-tab1">
                    <div class="card">
                        <table class="table table-condensed  table-bordered table-hover">
                            <tbody>
                            <tr>
                                <th> @lang('products.created') </th>
                                <td> {{ $product->created_at->toDateTimeString() }} <span
                                        class='text-muted'>{{ $product->created_at->diffForHumans() }} </span></td>
                            </tr>
                            <tr>
                                <th> @lang('products.status') </th>
                                <td>
                                    @switch($product->active)
                                        @case(1)
                                            <span class='badge badge-success'> @lang('products.active') </span>
                                            @break
                                        @case(0)
                                            <span class='badge badge-danger'> @lang('products.inactive') </span>
                                            @break
                                    @endswitch
                                </td>
                            </tr>
                            <tr>
                                <th> @lang('products.name_ar') </th>
                                <td> {{ $product->getTranslation('name' , 'ar') }} </td>
                            </tr>
                            <tr>
                                <th> @lang('products.name_en') </th>
                                <td> {{ $product->getTranslation('name' , 'en') }} </td>
                            </tr>

                            <tr>
                                <th> @lang('products.description_ar') </th>
                                <td> {!! $product->getTranslation('description' , 'ar') !!} </td>
                            </tr>
                            <tr>
                                <th> @lang('products.description_en') </th>
                                <td> {!! $product->getTranslation('description' , 'en') !!} </td>
                            </tr>
                            <tr>
                                <th> سعر المنتج ى حاله الطباعه فى وجه واحد</th>
                                <td> {{ $product->price }} <span class='text-muted'> جنيه </span></td>
                            </tr>

                            <tr>
                                <th> سعر المنتج فى حاله الطباعه على الوجهين</th>
                                <td> {{ $product->price_full_design }} <span class='text-muted'> جنيه </span></td>
                            </tr>

                            <tr>
                                <th> عدد diamonds</th>
                                <td> {{  $product->diamonds }} <span class='text-muted'> نقطه </span></td>
                            </tr>
                            <tr>
                                <th> @lang('products.added_by') </th>
                                <td>
                                    <a href="{{ route('dashboard.admins.show' , ['admin' => $product->user_id]) }}"> {{ optional($product->user)->name }} </a>
                                </td>
                            </tr>


                            <tr>
                                <th> تقيم المنتج</th>
                                <td> {{ $product->rate }} </td>
                            </tr>

                            <tr>
                                <th> صوره المنتج الرئيسيه</th>
                                <td><a href="{{ Storage::url('products/'.$product->image) }}"> <img
                                            class='rounded img-preview' data-popup="lightbox" data-gallery="gallery1"
                                            src="{{ Storage::url('products/'.$product->image) }}" alt=""> </a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="colored-justified-tab2">
                    @livewire('board.products.variations' , ['product' => $product ] )
                </div>

                <div class="tab-pane fade" id="colored-justified-tab3">
                    @livewire('board.products.images' , ['product' => $product ] )
                </div>

                <div class="tab-pane fade" id="colored-justified-tab4">
                    <div class="card card-body">
                        <div class="row text-center">
                            <div class="col-3">
                                <p><i class="icon-cart2 icon-2x d-inline-block text-info"></i></p>
                                <h5 class="font-weight-semibold mb-0">{{ $product->sales_count }} <span
                                        class="text-muted"> عمليه شراء </span></h5>
                                <span class="text-muted font-size-sm">عدد مرات البيع</span>
                            </div>

                            <div class="col-3">
                                <p><i class="icon-eye icon-2x d-inline-block text-success"></i></p>
                                <h5 class="font-weight-semibold mb-0"> {{ $product->views_count }} <span
                                        class="text-muted"> مره </span></h5>
                                <span class="text-muted font-size-sm">عدد مرات المشاهده</span>
                            </div>
                            <div class="col-3">
                                <p><i class="icon-cash3 icon-2x d-inline-block text-success"></i></p>
                                <h5 class="font-weight-semibold mb-0"> {{ $product->total_sales }} <span
                                        class="text-muted"> جنيه </span></h5>
                                <span class="text-muted font-size-sm">اجمالى مبيعات المنتج</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="colored-justified-tab5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <form action="{{ route('dashboard.products.store_design_sizes') }}"
                                      method='POST'>
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="solid-justified-tab5">
                                                <fieldset class="mb-3">
                                                    <div>
                                                        <h3 class=''> {{__('products.site_design_sizes')}}  </h3>
                                                    </div>
                                                    <div class="form-group row">
                                                        {{--                                                    // site back--}}
                                                        <div class="col-md-3">
                                                            <div class='mb-2'>
                                                                <label
                                                                    class="col-form-label"> {{__('products.site_back_width')}} </label>
                                                                <input type="text"
                                                                       class="form-control @error('site_back_width') is-invalid @enderror"
                                                                       name="site_back_width"
                                                                       value="{{ $product->site_back_width ?: old('site_back_width') }}">
                                                                @error('site_back_width')
                                                                <p class='text-danger'>  {{ $message }} </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='mb-2'>
                                                                <label
                                                                    class="col-form-label"> {{__('products.site_back_height')}} </label>
                                                                <input type="text"
                                                                       class="form-control @error('site_back_height') is-invalid @enderror"
                                                                       name="site_back_height"
                                                                       value="{{ $product->site_back_height ?: old('site_back_height') }}">
                                                                @error('site_back_height')
                                                                <p class='text-danger'>  {{ $message }} </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='mb-2'>
                                                                <label
                                                                    class="col-form-label"> {{__('products.site_back_left')}} </label>
                                                                <input type="text"
                                                                       class="form-control @error('site_back_left') is-invalid @enderror"
                                                                       name="site_back_left"
                                                                       value="{{ $product->site_back_left ?: old('site_back_left') }}">
                                                                @error('site_back_left')
                                                                <p class='text-danger'>  {{ $message }} </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='mb-2'>
                                                                <label
                                                                    class="col-form-label"> {{__('products.site_back_top')}} </label>
                                                                <input type="text"
                                                                       class="form-control @error('site_back_top') is-invalid @enderror"
                                                                       name="site_back_top"
                                                                       value="{{ $product->site_back_top ?: old('site_back_top') }}">
                                                                @error('site_back_top')
                                                                <p class='text-danger'>  {{ $message }} </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        {{--                                                    // site front--}}
                                                        <div class="col-md-3">
                                                            <div class='mb-2'>
                                                                <label
                                                                    class="col-form-label"> {{__('products.site_front_width')}} </label>
                                                                <input type="text"
                                                                       class="form-control @error('site_front_width') is-invalid @enderror"
                                                                       name="site_front_width"
                                                                       value="{{ $product->site_front_width ?: old('site_front_width') }}">
                                                                @error('site_front_width')
                                                                <p class='text-danger'>  {{ $message }} </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='mb-2'>
                                                                <label
                                                                    class="col-form-label"> {{__('products.site_front_height')}} </label>
                                                                <input type="text"
                                                                       class="form-control @error('site_front_height') is-invalid @enderror"
                                                                       name="site_front_height"
                                                                       value="{{ $product->site_front_height ?: old('site_front_height') }}">
                                                                @error('site_front_height')
                                                                <p class='text-danger'>  {{ $message }} </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='mb-2'>
                                                                <label
                                                                    class="col-form-label"> {{__('products.site_front_left')}} </label>
                                                                <input type="text"
                                                                       class="form-control @error('site_front_left') is-invalid @enderror"
                                                                       name="site_front_left"
                                                                       value="{{ $product->site_front_left ?: old('site_front_left') }}">
                                                                @error('site_front_left')
                                                                <p class='text-danger'>  {{ $message }} </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class='mb-2'>
                                                                <label
                                                                    class="col-form-label"> {{__('products.site_front_top')}} </label>
                                                                <input type="text"
                                                                       class="form-control @error('site_front_top') is-invalid @enderror"
                                                                       name="site_front_top"
                                                                       value="{{ $product->site_front_top ?: old('site_front_top') }}">
                                                                @error('site_front_top')
                                                                <p class='text-danger'>  {{ $message }} </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                                    <div>
                                                        <h3 class=''> {{__('products.mobile_design_sizes')}}  </h3>
                                                    </div>
                                                    <div class="form-group row">
                                                        {{--                                                    // mobile back--}}
                                                        <div class="col-md-2">
                                                            <div class='mb-2'>
                                                                <label
                                                                    class="col-form-label"> {{__('products.mobile_back_image_width')}} </label>
                                                                <input type="text"
                                                                       class="form-control @error('mobile_back_image_width') is-invalid @enderror"
                                                                       name="mobile_back_image_width"
                                                                       value="{{ $product->mobile_back_image_width ?: old('mobile_back_image_width') }}">
                                                                @error('mobile_back_image_width')
                                                                <p class='text-danger'>  {{ $message }} </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class='mb-2'>
                                                                <label
                                                                    class="col-form-label"> {{__('products.mobile_back_image_height')}} </label>
                                                                <input type="text"
                                                                       class="form-control @error('mobile_back_image_height') is-invalid @enderror"
                                                                       name="mobile_back_image_height"
                                                                       value="{{ $product->mobile_back_image_height ?: old('mobile_back_image_height') }}">
                                                                @error('mobile_back_image_height')
                                                                <p class='text-danger'>  {{ $message }} </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class='mb-2'>
                                                                <label
                                                                    class="col-form-label"> {{__('products.mobile_back_width')}} </label>
                                                                <input type="text"
                                                                       class="form-control @error('mobile_back_width') is-invalid @enderror"
                                                                       name="mobile_back_width"
                                                                       value="{{ $product->mobile_back_width ?: old('mobile_back_width') }}">
                                                                @error('mobile_back_width')
                                                                <p class='text-danger'>  {{ $message }} </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class='mb-2'>
                                                                <label
                                                                    class="col-form-label"> {{__('products.mobile_back_height')}} </label>
                                                                <input type="text"
                                                                       class="form-control @error('mobile_back_height') is-invalid @enderror"
                                                                       name="mobile_back_height"
                                                                       value="{{ $product->mobile_back_height ?: old('mobile_back_height') }}">
                                                                @error('mobile_back_height')
                                                                <p class='text-danger'>  {{ $message }} </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class='mb-2'>
                                                                <label
                                                                    class="col-form-label"> {{__('products.mobile_back_left')}} </label>
                                                                <input type="text"
                                                                       class="form-control @error('mobile_back_left') is-invalid @enderror"
                                                                       name="mobile_back_left"
                                                                       value="{{ $product->mobile_back_left ?: old('mobile_back_left') }}">
                                                                @error('mobile_back_left')
                                                                <p class='text-danger'>  {{ $message }} </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class='mb-2'>
                                                                <label
                                                                    class="col-form-label"> {{__('products.mobile_back_top')}} </label>
                                                                <input type="text"
                                                                       class="form-control @error('mobile_back_top') is-invalid @enderror"
                                                                       name="mobile_back_top"
                                                                       value="{{ $product->mobile_back_top ?: old('mobile_back_top') }}">
                                                                @error('mobile_back_top')
                                                                <p class='text-danger'>  {{ $message }} </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        {{--                                                    // mobile front--}}
                                                        <div class="col-md-2">
                                                            <div class='mb-2'>
                                                                <label
                                                                    class="col-form-label"> {{__('products.mobile_front_image_width')}} </label>
                                                                <input type="text"
                                                                       class="form-control @error('mobile_front_image_width') is-invalid @enderror"
                                                                       name="mobile_front_image_width"
                                                                       value="{{ $product->mobile_front_image_width ?: old('mobile_front_image_width') }}">
                                                                @error('mobile_front_image_width')
                                                                <p class='text-danger'>  {{ $message }} </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class='mb-2'>
                                                                <label
                                                                    class="col-form-label"> {{__('products.mobile_front_image_height')}} </label>
                                                                <input type="text"
                                                                       class="form-control @error('mobile_front_image_height') is-invalid @enderror"
                                                                       name="mobile_front_image_height"
                                                                       value="{{ $product->mobile_front_image_height ?: old('mobile_front_image_height') }}">
                                                                @error('mobile_front_image_height')
                                                                <p class='text-danger'>  {{ $message }} </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class='mb-2'>
                                                                <label
                                                                    class="col-form-label"> {{__('products.mobile_front_width')}} </label>
                                                                <input type="text"
                                                                       class="form-control @error('mobile_front_width') is-invalid @enderror"
                                                                       name="mobile_front_width"
                                                                       value="{{ $product->mobile_front_width ?: old('mobile_front_width') }}">
                                                                @error('mobile_front_width')
                                                                <p class='text-danger'>  {{ $message }} </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class='mb-2'>
                                                                <label
                                                                    class="col-form-label"> {{__('products.mobile_front_height')}} </label>
                                                                <input type="text"
                                                                       class="form-control @error('mobile_front_height') is-invalid @enderror"
                                                                       name="mobile_front_height"
                                                                       value="{{ $product->mobile_front_height ?: old('mobile_front_height') }}">
                                                                @error('mobile_front_height')
                                                                <p class='text-danger'>  {{ $message }} </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class='mb-2'>
                                                                <label
                                                                    class="col-form-label"> {{__('products.mobile_front_left')}} </label>
                                                                <input type="text"
                                                                       class="form-control @error('mobile_front_left') is-invalid @enderror"
                                                                       name="mobile_front_left"
                                                                       value="{{ $product->mobile_front_left ?: old('mobile_front_left') }}">
                                                                @error('mobile_front_left')
                                                                <p class='text-danger'>  {{ $message }} </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class='mb-2'>
                                                                <label
                                                                    class="col-form-label"> {{__('products.mobile_front_top')}} </label>
                                                                <input type="text"
                                                                       class="form-control @error('mobile_front_top') is-invalid @enderror"
                                                                       name="mobile_front_top"
                                                                       value="{{ $product->mobile_front_top ?: old('mobile_front_top') }}">
                                                                @error('mobile_front_top')
                                                                <p class='text-danger'>  {{ $message }} </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-white ">
                                        <button type="submit"
                                                class="btn btn-primary mr-2 mt-sm-0 w-100 w-sm-auto"
                                                style="float: left;"> @lang('dashboard.edit') </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('dashboard_assets/global_assets/js/plugins/media/glightbox.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/global_assets/js/demo_pages/gallery.js') }}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function () {

            Livewire.on('open_add_modal', () => {
                $('div#modal_form_horizontal').modal().show();
            });

            Livewire.on('close_add_modal', () => {
                $('button.dismiss_modal').trigger('click');
            });


            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Livewire.on('itemDeleted', postId => {
                Toast.fire({
                    icon: 'success',
                    title: 'تم حذف الصوره بنجاح'
                })
            })


            $(document).on('click', 'a.delete_item', function (event) {
                event.preventDefault();
                var id = $(this).attr('data-item_id');
                Swal.fire({
                    title: '@lang('dashboard.are_you_sure_to_delete')',
                    text: "@lang('dashboard.delete_notice')",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '@lang('dashboard.yes')',
                    cancelButtonText: '@lang('dashboard.cancel')'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('deleteItem', id)
                    }
                })
            });
        });
    </script>
@endsection

@extends('dashboard.layouts.master')

@section('page_title')
    {{ trans('products.add_new_product') }}
@endsection

@section('page_header')
    <a href="{{ route('dashboard.products.index') }}" class="breadcrumb-item"><i
            class="icon-ampersand  mr-2"></i> @lang('products.products')</a>
    <span class="breadcrumb-item active"> @lang('products.add_new_product') </span>
@endsection

@section('page_content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header bg-primary text-white header-elements-sm-inline">
                    <h5 class="card-title"> @lang('products.add_new_product') </h5>
                    <div class="header-elements">
                        <div class="d-flex justify-content-between">
                            <div class="list-icons ml-3">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('dashboard.products.store') }}" method='POST' enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="solid-justified-tab1">
                                <fieldset class="mb-3">
                                    <div class="form-group row">

                                        {{--									<div class="col-md-3">--}}
                                        {{--										<div  class='mb-2' >--}}
                                        {{--											<label class="col-form-label"> الدوله </label>--}}
                                        {{--											<select class='form-control' name="category_id" id="">--}}
                                        {{--												@foreach ($countries as $country)--}}
                                        {{--												<option value="{{ $country->id }}"> {{ $country->name }} </option>--}}
                                        {{--												@endforeach--}}
                                        {{--											</select>--}}
                                        {{--											@error('category_id')--}}
                                        {{--											<p  class='text-danger' >  {{ $message }} </p>--}}
                                        {{--											@enderror--}}
                                        {{--										</div>--}}
                                        {{--									</div>--}}

                                        <div class="col-md-4">
                                            <div class='mb-2'>
                                                <label
                                                    class="col-form-label"> @lang('products.categories') @endlang </label>
                                                <select class='form-control @error('category_id') is-invalid @enderror '
                                                        name="category_id" id="">
                                                    <option value=""> @lang('products.select_category') </option>
                                                    @foreach ($categories as $category)
                                                        <option
                                                            value="{{ $category->id }}"> {{ $category->name }} </option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <p class='text-danger'>  {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class='mb-2'>
                                                <label class="col-form-label"> @lang('products.name_ar') </label>
                                                <input type="text"
                                                       class="form-control @error('name_ar') is-invalid @enderror"
                                                       name="name_ar" value="{{ old('name_ar') }}">
                                                @error('name_ar')
                                                <p class='text-danger'>  {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class='mb-2'>
                                                <label class="col-form-label"> @lang('products.name_en') </label>
                                                <input type="text"
                                                       class="form-control @error('name_en') is-invalid @enderror"
                                                       name="name_en" value="{{ old('name_en') }}">
                                                @error('name_en')
                                                <p class='text-danger'>  {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class='mb-2'>
                                                <label class="col-form-label">  @lang('products.price') </label>
                                                <input type="number"
                                                       class="form-control @error('price') is-invalid @enderror"
                                                       name="price" value="{{ old('price') }}">
                                                @error('price')
                                                <p class='text-danger'>  {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class='mb-2'>
                                                <label
                                                    class="col-form-label"> @lang('products.price_full_design')  </label>
                                                <input type="number"
                                                       class="form-control @error('price_full_design') is-invalid @enderror"
                                                       name="price_full_design" value="{{ old('price_full_design') }}">
                                                @error('price_full_design')
                                                <p class='text-danger'>  {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class='mb-2'>
                                                <label class="col-form-label"> @lang('products.diamonds') </label>
                                                <input type="text" name="diamonds"
                                                       class="form-control @error('diamonds') is-invalid @enderror ">
                                                @error('diamonds')
                                                <p class='text-danger'>  {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class='mb-2'>
                                                <label class="col-form-label"> @lang('products.description_ar') </label>
                                                <textarea name="description_ar" class="form-control"
                                                          rows="3"> {{ old('description_ar') }} </textarea>
                                                @error('description_ar')
                                                <p class='text-danger'>  {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class='mb-2'>
                                                <label class="col-form-label"> @lang('products.description_en') </label>
                                                <textarea name="description_en" class="form-control"
                                                          rows="3"> {{ old('description_en') }} </textarea>
                                                @error('description_en')
                                                <p class='text-danger'>  {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class='mb-2'>
                                                <label
                                                    class="col-form-label"> @lang('categories.show_in_home_page') </label>
                                                <div class="custom-control custom-switch mb-2">
                                                    <input type="checkbox" name="show_in_home_page"
                                                           class="custom-control-input" id='show_in_home_page'>
                                                    <label class="custom-control-label"
                                                           for="show_in_home_page"> @lang('slides.active') </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class='mb-2'>
                                                <label class="col-form-label"> @lang('categories.active') </label>
                                                <div class="custom-control custom-switch mb-2">
                                                    <input type="checkbox" name="active" class="custom-control-input"
                                                           id='active'>
                                                    <label class="custom-control-label"
                                                           for="active"> @lang('slides.active') </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="mb-3">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <div class='mb-2'>
                                                <label class="col-form-label"> @lang('products.front_image')  </label>
                                                <input type="file" name="front_image"
                                                       class="form-control @error('front_image') is-invalid @enderror ">
                                                @error('front_image')
                                                <p class='text-danger'>  {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class='mb-2'>
                                                <label class="col-form-label"> @lang('products.back_image')  </label>
                                                <input type="file" name="back_image"
                                                       class="form-control @error('back_image') is-invalid @enderror ">
                                                @error('back_image')
                                                <p class='text-danger'>  {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class='mb-2'>
                                                <label class="col-form-label"> @lang('products.images') </label>
                                                <input type="file" name="images[]" multiple='multiple'
                                                       class="form-control @error('images') is-invalid @enderror ">
                                                @error('images')
                                                <p class='text-danger'>  {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class='mb-2'>
                                                <label class="col-form-label"> @lang('products.mobile_back_image')  </label>
                                                <input type="file" name="mobile_back_image"
                                                       class="form-control @error('mobile_back_image') is-invalid @enderror ">
                                                @error('mobile_back_image')
                                                <p class='text-danger'>  {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class='mb-2'>
                                                <label class="col-form-label"> @lang('products.mobile_back_tint')  </label>
                                                <input type="file" name="mobile_back_tint"
                                                       class="form-control @error('mobile_back_tint') is-invalid @enderror ">
                                                @error('mobile_back_tint')
                                                <p class='text-danger'>  {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class='mb-2'>
                                                <label class="col-form-label"> @lang('products.mobile_back_shadow')  </label>
                                                <input type="file" name="mobile_back_shadow"
                                                       class="form-control @error('mobile_back_shadow') is-invalid @enderror ">
                                                @error('mobile_back_shadow')
                                                <p class='text-danger'>  {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class='mb-2'>
                                                <label class="col-form-label"> @lang('products.mobile_front_image')  </label>
                                                <input type="file" name="mobile_front_image"
                                                       class="form-control @error('mobile_front_image') is-invalid @enderror ">
                                                @error('mobile_front_image')
                                                <p class='text-danger'>  {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class='mb-2'>
                                                <label class="col-form-label"> @lang('products.mobile_front_tint')  </label>
                                                <input type="file" name="mobile_front_tint"
                                                       class="form-control @error('mobile_front_tint') is-invalid @enderror ">
                                                @error('mobile_front_tint')
                                                <p class='text-danger'>  {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class='mb-2'>
                                                <label class="col-form-label"> @lang('products.mobile_front_shadow')  </label>
                                                <input type="file" name="mobile_front_shadow"
                                                       class="form-control @error('mobile_front_shadow') is-invalid @enderror ">
                                                @error('mobile_front_shadow')
                                                <p class='text-danger'>  {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                {{--							<fieldset>--}}

                                {{--								<div>--}}
                                {{--									<button class='btn btn-success add_new_row '> إضافه جديد  </button>--}}
                                {{--								</div>--}}

                                {{--								--}}
                                {{--								<div class="main_rows">--}}

                                {{--									<div class="row main_row"  >--}}

                                {{--										<div class="col-md-3">--}}
                                {{--											<div class="form-group">--}}
                                {{--												<label class="col-form-label"> اللون </label>--}}
                                {{--												<select name="colors[]" class='select form-control' required id="">--}}
                                {{--													@foreach ($colors as $color)--}}
                                {{--														<option value="{{ $color->id }}"> {{ $color->name }} </option>--}}
                                {{--													@endforeach--}}
                                {{--												</select>--}}
                                {{--												@error('colors.*')--}}
                                {{--												<p class='text-danger' >  {{ $message }} </p>--}}
                                {{--												@enderror--}}
                                {{--											</div>--}}
                                {{--										</div>--}}

                                {{--										<div class="col-md-3">--}}
                                {{--											<div class="form-group">--}}
                                {{--												<label class="col-form-label"> المقاس </label>--}}
                                {{--												<select name="sizes[]" required class='select form-control' id="">--}}
                                {{--													@foreach ($sizes as $size)--}}
                                {{--														<option value="{{ $size->id }}"> {{ $size->name }} </option>--}}
                                {{--													@endforeach--}}
                                {{--												</select>--}}
                                {{--												@error('sizes.*')--}}
                                {{--												<p class='text-danger' >  {{ $message }} </p>--}}
                                {{--												@enderror--}}
                                {{--											</div>--}}
                                {{--										</div>--}}


                                {{--										<div class="col-md-3">--}}
                                {{--											<div class="form-group">--}}
                                {{--												<label class="col-form-label"> الكميه المتاحه </label>--}}
                                {{--												<input type="number" required class="form-control @error('quantity.*') is-invalid @enderror" name="quantity[]" value="{{ old('quantity.*') }}" >--}}
                                {{--												@error('quantity.*')--}}
                                {{--												<p  class='text-danger' >  {{ $message }} </p>--}}
                                {{--												@enderror--}}
                                {{--											</div>--}}
                                {{--										</div>--}}


                                {{--										<div class="col-md-3">--}}
                                {{--											<div class="form-group">--}}
                                {{--												<label class="col-form-label"> خصائص </label> <br>--}}
                                {{--												<button title='الغاء' class="btn btn-outline-danger delete_main_row  border-2 ml-2"><i class="icon-trash"></i></button>--}}
                                {{--											</div>										--}}
                                {{--										</div>--}}
                                {{--									</div>--}}
                                {{--								--}}
                                {{--								</div>--}}
                                {{--							</fieldset>--}}


                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white ">
                        <a href="{{ route('dashboard.products.index') }}"
                           class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
                        <button type="submit" name='add' class="btn btn-primary mr-2 mt-sm-0 w-100 w-sm-auto"
                                style="float: left;"> @lang('dashboard.add') </button>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(function () {


            $(document).on('click', 'button.delete_main_row', function (event) {
                event.preventDefault();
                var rows_count = $(document).find('div.main_row').length;
                if (rows_count > 1) {
                    $(this).parent().parent().parent().remove();
                } else {
                    alert('يجب اضافه متغير واحد على الاقل');
                }
            });

            $(document).on('click', 'button.delete_color_row', function (event) {
                event.preventDefault();
                $(this).parent().parent().parent().remove();
            });


            $('button.add_new_row').on('click', function (event) {
                event.preventDefault();
                rows_count = $(document).find('div.main_row').length;
                console.log(rows_count);
                $.ajax({
                    url: '{{ route('dashboard.get_new_varition_main_row') }}',
                    type: 'POST',
                    dataType: 'html',
                    data: {_token: "{{ csrf_token() }}", 'rows_count': rows_count},
                })
                    .done(function (data) {
                        $(document).find('div.main_rows').find('div.main_row').last().after(data);
                    })
            });

        });
    </script>

@endsection

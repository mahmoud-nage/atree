@extends('dashboard.layouts.master')

@section('page_title')
    {{ trans('products.edit_product') }}
@endsection

@section('page_header')
    <a href="{{ route('dashboard.products.index') }}" class="breadcrumb-item"><i
            class="icon-ampersand  mr-2"></i> @lang('products.products')</a>
    <span class="breadcrumb-item active"> {{ trans('products.edit_product') }} </span>
@endsection

@section('page_content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header bg-primary text-white header-elements-sm-inline">
                    <h5 class="card-title"> {{ trans('products.edit_product') }} </h5>
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
                <form action="{{ route('dashboard.products.update'  , $product ) }}" method='POST'
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="solid-justified-tab1">
                                <fieldset class="mb-3">
                                    <div class="form-group row">


                                        {{--									<div class="col-md-3">--}}
                                        {{--										<div  class='mb-2' >--}}
                                        {{--											<label class="col-form-label"> الدوله </label>--}}
                                        {{--											<select class='form-control' name="country_id" id="">--}}
                                        {{--												@foreach ($countries as $country)--}}
                                        {{--												<option value="{{ $country->id }}"{{ $country->id == $product->country_id ? 'selected="selected"' : '' }} > {{ $country->name }} </option>--}}
                                        {{--												@endforeach--}}
                                        {{--											</select>--}}
                                        {{--											@error('image')--}}
                                        {{--											<p  class='text-danger' >  {{ $message }} </p>--}}
                                        {{--											@enderror--}}
                                        {{--										</div>--}}
                                        {{--									</div>--}}


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
                                                <label
                                                    class="col-form-label"> @lang('products.categories') @endlang </label>
                                                <select class='form-control @error('category_id') is-invalid @enderror '
                                                        name="category_id" id="">
                                                    <option value=""> @lang('products.select_category') </option>
                                                    @foreach ($categories as $category)
                                                        <option
                                                            value="{{ $category->id }}"{{ $category->id == $product->category_id ? 'selected="selected"' : '' }} > {{ $category->name }} </option>
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
                                                       name="name_ar"
                                                       value="{{ $product->getTranslation('name' , 'ar') }}">
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
                                                       name="name_en"
                                                       value="{{ $product->getTranslation('name' , 'en') }}">
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
                                                       name="price" value="{{ $product->price }}">
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
                                                       name="price_full_design"
                                                       value="{{ $product->price_full_design }}">
                                                @error('price_full_design')
                                                <p class='text-danger'>  {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class='mb-2'>
                                                <label class="col-form-label"> @lang('products.diamonds') </label>
                                                <input type="text" name="diamonds" value='{{ $product->diamonds }}'
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
                                                          rows="3"> {{ $product->getTranslation('description' , 'ar' ) }} </textarea>
                                                @error('description_ar')
                                                <p class='text-danger'>  {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class='mb-2'>
                                                <label class="col-form-label"> @lang('products.description_en') </label>
                                                <textarea name="description_en" class="form-control"
                                                          rows="3"> {{ $product->getTranslation('description' , 'en' ) }} </textarea>
                                                @error('description_en')
                                                <p class='text-danger'>  {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class='mb-2'>
                                                <label
                                                    class="col-form-label">  @lang('categories.show_in_home_page') </label>
                                                <div class="custom-control custom-switch mb-2">
                                                    <input type="checkbox" name="show_in_home_page"
                                                           class="custom-control-input"
                                                           id='show_in_home_page' {{ $product->show_in_home_page == 1 ? 'checked' : '' }} >
                                                    <label class="custom-control-label"
                                                           for="show_in_home_page"> @lang('slides.active') </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class='mb-2'>
                                                <label class="col-form-label">  @lang('categories.active') </label>
                                                <div class="custom-control custom-switch mb-2">
                                                    <input type="checkbox" name="active" class="custom-control-input"
                                                           id='active' {{ $product->active == 1 ? 'checked' : '' }} >
                                                    <label class="custom-control-label"
                                                           for="active"> @lang('slides.active') </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6">
                                            <hr>
                                            <div class='mb-2'>
                                                <label class="col-form-label">
                                                    @lang('products.front_image')
                                                </label>
                                                <img class='img-preview img-responsive'
                                                     src="{{ Storage::url('products/'.$product->front_image) }}" alt="">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <hr>
                                            <div class='mb-2'>
                                                <label class="col-form-label">
                                                    @lang('products.back_image')
                                                </label>
                                                <img class='img-preview img-responsive'
                                                     src="{{ Storage::url('products/'.$product->back_image) }}" alt="">
                                            </div>
                                        </div>


                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white ">
                        <a href="{{ route('dashboard.products.index') }}"
                           class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
                        <button type="submit" name='add' class="btn btn-primary mr-2 mt-sm-0 w-100 w-sm-auto"
                                style="float: left;"> @lang('products.edit')
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')


@endsection

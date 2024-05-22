<div class='row'>
    @foreach($records as $record)
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-img-actions m-1">
                    <img class="card-img img-fluid"  style="background-color: {{$record->main_color_code}}" src="{{ Storage::url('designs/'.$record->design_image_front) }}" alt="">
                    <div class="card-img-actions-overlay card-img">
                        <a href="{{ Storage::url('designs/'.$record->design_image_front) }}" class="btn btn-outline-white border-2 btn-icon rounded-pill" data-popup="lightbox" data-gallery="gallery1">
                            <i class="icon-plus3"></i>
                        </a>

{{--                        <a href="#" class="btn btn-outline-white border-2 btn-icon rounded-pill ml-2">--}}
{{--                            <i class="icon-link"></i>--}}
{{--                        </a>--}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

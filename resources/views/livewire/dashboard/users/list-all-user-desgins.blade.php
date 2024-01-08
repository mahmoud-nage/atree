<div class='row' >
    @for ($i = 0; $i < 6 ; $i++)
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-img-actions m-1">
                <img class="card-img img-fluid" src="{{ asset('dashboard_assets/global_assets/images/placeholders/placeholder.jpg') }}" alt="">
                <div class="card-img-actions-overlay card-img">
                    <a href="{{ asset('dashboard_assets/global_assets/images/placeholders/placeholder.jpg') }}" class="btn btn-outline-white border-2 btn-icon rounded-pill" data-popup="lightbox" data-gallery="gallery1">
                        <i class="icon-plus3"></i>
                    </a>

                    <a href="#" class="btn btn-outline-white border-2 btn-icon rounded-pill ml-2">
                        <i class="icon-link"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endfor
</div>

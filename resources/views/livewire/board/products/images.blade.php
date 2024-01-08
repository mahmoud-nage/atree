<div class="row">
    @foreach ($this->images as $image)
    <div class="col-xl-2 col-sm-6">
        <div class="card">
            <div class="card-img-actions mx-1 mt-1">
                <img class="card-img img-fluid" src="{{ Storage::url('products/'.$image->image) }}" alt="">
                <div class="card-img-actions-overlay card-img">
                    <a href="{{ Storage::url('products/'.$image->image) }}" class="btn btn-outline-white border-2 btn-icon rounded-pill" data-popup="lightbox" data-gallery="gallery1">
                        <i class="icon-zoomin3"></i>
                    </a>
                    <a   data-item_id='{{ $image->id }}' class=" delete_item btn btn-outline-white border-2 btn-icon rounded-pill ml-2">
                        <i class="icon-trash"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>


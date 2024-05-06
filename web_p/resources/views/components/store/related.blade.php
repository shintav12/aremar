<div class="row my-5">
    @foreach ($related as $item)
    <div class="col-md-3 col-6 mb-2">
        <a href="{{url('store').'/'.$slug.'/'.$item->slug}}" class="product-container mb-3">
            <div class="product-image-container">
                <div class="product-image">
                    <div class="product-image-overlay">
                        <div class="options-overlay">
                            <div class="option">
                                <a href="{{url('store').'/'.$slug.'/'.$item->slug}}">
                                    <i class="fas fa-search"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <img class="img-fluid alt-image" src="{{config('app.IMAGE_URL').$item->alt_path}}" />
                    <img class="img-fluid main-image" src="{{config('app.IMAGE_URL').$item->path}}" />
                </div>
            </div>
            <div class="product-info">
                <span class="product-name">{{$item->name}}</span>
                <div class="product-secondary-info">
                    <span class="product-prize">S/.{{$item->price}}</span>
                    <span class="product-colors"></span>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

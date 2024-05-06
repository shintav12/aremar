<div class="container my-5 pt-5">
    <div class="row">
        <div class="section-title col-12">Lorem ipsum dolor + vendido</div>
        <div class="section-subtitle col-12">Lorem ipsum dolor adi</div>
    </div>
    <div class="row">
        <div class="product-container-wrapper">
        @foreach($productos as $oferta)
        <div class="product-item-wrapper">
            <a href="" class="product-container mb-3">
                <div class="product-image-container">
                    <div class="product-image">
                    <div class="product-image-overlay">
                        <div class="options-overlay">

                        <div class="option">
                            <a>
                            <i class="fas fa-cart-plus"></i>
                            </a>
                        </div>
                        <div class="option">
                        <a href="{{url('store/asdasd').'/'.$oferta->slug}}">
                            <i class="fas fa-search"></i>
                            </a>
                        </div>
                        </div>
                    </div>
                    <img class="img-fluid alt-image" src="{{config('app.IMAGE_URL').$oferta->alt_path}}" />
                    <img class="img-fluid main-image" src="{{config('app.IMAGE_URL').$oferta->path}}" />
                    </div>
                </div>
                <div class="product-info">
                    <span class="product-name">{{$oferta->name}}</span>
                    <div class="product-secondary-info">
                    <span class="product-prize">S/.{{$oferta->price}}</span>
                    </div>
                </div>
            </a>
        </div>
        @endforeach

        </div>

    </div>
    </div>
<div class="container my-5 pt-5">
<div class="row">
    <div class="section-title col-12">Lorem ipsum dolor sit lo ofertas</div>
    <div class="section-subtitle col-12">Lorem ipsum dolor adi</div>
</div>
<div class="row">
    <div id="ofertas" class="product-container-wrapper">
    @foreach($ofertas as $oferta)
    <div class="product-item-wrapper">
        <a href="" class="product-container mb-3">
            <div class="product-image-container">
                <div class="product-image">
                <div class="product-image-overlay">
                    <div class="options-overlay">

                    <div class="option">
                        <a>
                        <i class="fas fa-cart-plus"></i>
                        </a>
                    </div>
                    <div class="option">
                    <a href="{{url('store/asdasd').'/'.$oferta->producto['slug']}}">
                        <i class="fas fa-search"></i>
                        </a>
                    </div>
                    </div>
                </div>
                <img class="img-fluid alt-image" src="{{config('app.IMAGE_URL').$oferta->producto['alt_path']}}" />
                <img class="img-fluid main-image" src="{{config('app.IMAGE_URL').$oferta->producto['path']}}" />
                </div>
            </div>
            <div class="product-info">
                <span class="product-name">{{$oferta->producto['name']}}</span>
                <div class="product-secondary-info">
                <span class="product-colors mr-2" style="text-decoration: line-through;">S/.{{$oferta->producto['price']}}</span>
                <span class="product-prize">S/.{{$oferta->price}}</span>

                </div>
            </div>
        </a>
    </div>
    @endforeach
    </div>

</div>
</div>
<div class="container my-5 pt-5">
<div class="row">
    <div class="section-title col-12">Lorem ipsum dolor sit destacados</div>
    <div class="section-subtitle col-12">Lorem ipsum dolor adi</div>
</div>
<div class="row">
    <div class="product-container-wrapper">
    @foreach($productos as $oferta)
    <div class="product-item-wrapper">
        <a href="" class="product-container mb-3">
            <div class="product-image-container">
                <div class="product-image">
                <div class="product-image-overlay">
                    <div class="options-overlay">

                    <div class="option">
                        <a>
                        <i class="fas fa-cart-plus"></i>
                        </a>
                    </div>
                    <div class="option">
                    <a href="{{url('store/asdasd').'/'.$oferta->slug}}">
                        <i class="fas fa-search"></i>
                        </a>
                    </div>
                    </div>
                </div>
                <img class="img-fluid alt-image" src="{{config('app.IMAGE_URL').$oferta->alt_path}}" />
                <img class="img-fluid main-image" src="{{config('app.IMAGE_URL').$oferta->path}}" />
                </div>
            </div>
            <div class="product-info">
                <span class="product-name">{{$oferta->name}}</span>
                <div class="product-secondary-info">
                <span class="product-prize">S/.{{$oferta->price}}</span>
                </div>
            </div>
        </a>
    </div>
    @endforeach

    </div>

</div>
</div>

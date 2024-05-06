<div class="container mt-4 pt-4">
    <div class="row">
        @foreach($ofertas_header as $ofertas)
        <div class="col-md-4 mb-4 mb-md-0">
            <div class="offer-container">
                <div class="offer-image">
                    <img class="img-fluid" src="{{config('app.IMAGE_URL').$ofertas->path}}">
                </div>
                <div class="offer-content">
                <span class="offer-name">{{$ofertas->name}}</span><br/>
                    <span class="offer-price">Desde S/ {{$ofertas->price}}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

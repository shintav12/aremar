@extends('template.intern')

@section('css')
<link href="{{asset("plugin/sweetalert2/sweetalert2.css")}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

<style>
    p {
	 text-align: justify;
	 color: #666;
    }

 .title-section {
	 display: flex;
	 justify-content: center;
	 align-items: center;
	 flex-direction: column;
}
 .primary-title {
	 margin: 15px 0px;
	 color: #b3a0a2;
	 font-size: 2.5rem;
	 font-weight: 500;
}
 .secondary-title {
	 color: #808080;
	 font-size: 1.2rem;
}
 hr {
	 border-top: 2px solid #b3a0a2;
}
 .product-title-container {
	 color: #b3a0a2;
	 font-size: 2rem;
	 display: flex;
	 align-items: center;
	 margin-bottom: 15px;
}
 .product-title-container h1 {
	 margin: 0;
}
 .product-shordescription {
	 line-height: 1.5;
	 color: #666;
	 font-size: 1.3rem;
}
 .input-container {
	 display: flex;
	 justify-content: flex-start;
	 align-items: center;
	 margin-right: 15px;
	 font-size: 1.2rem;
}
 .input-container label {
	 color: #666;
	 font-weight: 500;
}
 label {
	 margin: 0;
}
 .product-sizes {
	 display: flex;
	 justify-content: flex-start;
}
 .custom-radio {
	 margin-right: 8px;
}
 .product-section-title {
	 font-size: 1.5rem;
	 font-weight: 500;
	 margin: 15px 0px;
	 color: #b3a0a2;
}
 .product-prize {
	 font-size: 2rem;
	 font-weight: 500;
	 margin: 35px 0px;
	 color: #666;
}
 .btn-primary {
	 color: white;
	 background-color: #b3a0a2;
	 border-color: #b3a0a2;
	 text-transform: uppercase;
	 padding: 8px 12px;
	 font-weight: 500;
}
 @media (max-width: 425px) {
	 .product-sizes {
		 display: flex;
		 justify-content: flex-start;
		 flex-direction: column;
	}
}

.slider-container{
    display: flex;
    height: 500px;
}
.swiper-container {
  width: 100%;
  height: 100%;
  margin-left: auto;
  margin-right: auto;
}
.swiper-slide {
  background-size: cover;
  background-position: center;
}
.gallery-thumbs {
  height: 100%;
  width: 20%;
  box-sizing: border-box;
}
.gallery-thumbs .swiper-slide {
  height: 100%;
  opacity: 0.4;
}
.gallery-thumbs .swiper-slide-thumb-active {
  opacity: 1;
}
</style>
@endsection

@section('js')
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="{{asset("plugin/sweetalert2/sweetalert2.js")}}" type="text/javascript"></script>
<script>
var galleryThumbs = new Swiper('.gallery-thumbs', {
      spaceBetween: 10,
      slidesPerView: 4,
      direction: 'vertical',
      freeMode: true,
      watchSlidesVisibility: true,
      watchSlidesProgress: true,
    });
    var galleryTop = new Swiper('.gallery-top', {
      spaceBetween: 10,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      thumbs: {
        swiper: galleryThumbs
      }
    });

    function addProduct(data){
        $('#cart-wrapper').append('<div id="'+ data.uuid +'" class="cart-wrapper-item">'
        + '        <div class="cart-image">'
        + '            <img src="{{config('app.IMAGE_URL')}}' + data.path + '" class="img-fluid" alt="">'
        + '        </div>'
        + '        <div class="cart-info ml-2">'
        + '            <div class="item-name">'
        + '                '+ data.name +''
        + '                <a data-id="'+  data.uuid +'" class="removeCart" style="cursor: pointer; padding: 0px">&times;</a>'
        + '            </div>'
        + '            <div class="item-metal">'
        + '                M / '+ data.metal_name + ''
        + '            </div>'
        + '            <div class="item-price">'
        + '                S/. '+ data.price +''
        + '            </div>'
        + '        </div>'
        + '    </div>');
    }

    $('#form').validate({
        ignore: '.ignore, .select2-input',
        focusInvalid: false,
        rules: {

        },
        messages: {
        },
        errorPlacement: function errorPlacement(error, element) {
            var $parent = $(element).parents('.form-group');
            if ($parent.find('.jquery-validation-error').length) {
                return;
            }
            $parent.append(error.addClass('jquery-validation-error small form-text invalid-feedback'));
        },
        highlight: function(element) {
            var $el = $(element);
            var $parent = $el.parents('.form-group');
            $el.addClass('is-invalid');
            if ($el.hasClass('select2-hidden-accessible') || $el.attr('data-role') === 'tagsinput') {
                $el.parent().addClass('is-invalid');
            }
        },
        unhighlight: function(element) {
            $(element).parents('.form-group').find('.is-invalid').removeClass('is-invalid');
        },submitHandler: function (form) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('add_cart') }}",
                data: new FormData($("#form")[0]),
                contentType: false,
                processData: false,
                beforeSend: function () {
                    swal({
                        title: 'Cargando...',
                        timer: 10000,
                        showCancelButton: false,
                        showConfirmButton: false,
                        onOpen: function () {
                            swal.showLoading()
                        }
                    });
                },
                success: function (data) {
                    var error = data.error;
                    if (error == 0) {

                        var sum = 0;
                        var cart = data.cart;
                        $('#cart-wrapper').html('');
                        for (const item of Object.entries(cart)) {
                            sum = sum + item[1].price;
                            addProduct(item[1]);
                        }
                        $("#sum").html('');
                        $("#sum").html('S./' + sum);
                        $(".actions-cart-container").show();
                        swal.close();
                        toastr.success('Se agrego producto al carrito');
                    } else {
                        swal.close();
                        toastr.error('Hubo un problema');
                    }
                }, error: function () {
                    swal.close();
                    toastr.error('Hubo un problema');
                }
            });
        }
    });


</script>
@endsection

@section('body')
<div>
    @include('components.store.breadcrumbs')
    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-6 col-12">
          <div class="slider-container">
                <div class="swiper-container gallery-thumbs" style="    margin-right: 10px;">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" style="background-image:url({{config('app.IMAGE_URL').$product->path}})">
                        </div>
                        <div class="swiper-slide" style="background-image:url({{config('app.IMAGE_URL').$product->alt_path}})">
                        </div>
                        @foreach ($images as $item)
                        <div class="swiper-slide" style="background-image:url({{config('app.IMAGE_URL').$item->path}})">
                        </div>
                        @endforeach

                    </div>
                </div>
                <div class="swiper-container gallery-top" >
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" style="background-image:url({{config('app.IMAGE_URL').$product->path}})">
                        </div>
                        <div class="swiper-slide" style="background-image:url({{config('app.IMAGE_URL').$product->alt_path}})">
                        </div>
                        @foreach ($images as $item)
                        <div class="swiper-slide" style="background-image:url({{config('app.IMAGE_URL').$item->path}})">
                        </div>
                        @endforeach
                    </div>
                </div>
          </div>
        </div>
        <div class="col-lg-6 col-12">
            <form id="form">
          <div class="product-container-info">
            <div class="product-title-container">
            <h1 class="product-title">{{$product->name}}</h1>
            </div>
            <div class="product-content-info">
              <p
                class="product-shordescription"
              >{{$product->short_description}}</p>
              <div class="product-section-title">Metales</div>

                  {{ csrf_field() }}
                <input type="text" hidden name="id" value="{{$product->id}}">
                <div class="product-sizes">
                    <?php $metals_array = explode(',', $product->metals);
                    ?>
                      @foreach ($metals as $key => $value)
                      <?php $count = 0;?>
                        @if(in_array(" ".$value->id." ",$metals_array))
                        <div class="input-container">
                            <input type="radio"  value="{{$value->id}}" {{$count == 0 ? "checked" :""}} class="custom-radio" name="metal" />
                            <span for class="custom-radio-label">{{$value->name}}</span>
                        </div>
                        <?php $count++;?>
                        @endif
                      @endforeach
                  </div>

              <div class="product-prize">S/.{{$product->price}}</div>
              <div class="product-action-container">
                <button class="btn btn-primary">
                  <i class="fas fa-shopping-bag mr-2"></i>Agregar al Carrito
                </button>
              </div>
            </div>
          </div>
        </form>
        </div>
        <div class="col-12 mt-5">
          <hr style="" />
          <p class="pt-4">
            {{$product->description}}
          </p>
        </div>
      </div>
      <hr style="" />
      <div class="col-12">
        <div class="title-section">
          <div class="primary-title">
            Relacionados
          </div>
          <div class="secondary-title">
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonu
          </div>
        </div>
      </div>
      <div class="my-5 pb-5">
        @include('components.store.related')
      </div>
    </div>
  </div>
@endsection

@extends('template.intern')
@section('css')
    <link href="{{asset("store.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("plugin/sweetalert2/sweetalert2.css")}}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
<script src="{{asset("plugin/sweetalert2/sweetalert2.js")}}" type="text/javascript"></script>
<script>
    $("body").on("click",".option-cart",function(){
        toastr.success('Se agrego producto al carrito');
        let val = $(this).data('id');
    });

    $("body").on("change","#order_id",function(){
        let val = $(this).val();
        document.getElementById("order_id_input").setAttribute('value',val);
    });

    function resultProducts(data){
        $("#products_store_container").html('');
        data.forEach(element => {
            $("#products_store_container").append(
                '<div class="col-md-3 col-6 mb-2">'
                +'    <a href="" class="product-container mb-3">'
                +'        <div class="product-image-container">'
                +'            <div class="product-image">'
                +'            <div class="product-image-overlay">'
                +'                <div class="options-overlay">'
                +'                <div class="option">'
                +'                <a href="{{url('store').'/'.$slug}}' + '/' + element.slug + '">'
                +'                    <i class="fas fa-search"></i>'
                +'                    </a>'
                +'                </div>'
                +'                </div>'
                +'            </div>'
                +'            <img class="img-fluid alt-image" src="{{config('app.IMAGE_URL')}}' + element.alt_path + '" />'
                +'            <img class="img-fluid main-image" src="{{config('app.IMAGE_URL')}}' + element.path + '" />'
                +'            </div>'
                +'        </div>'
                +'        <div class="product-info">'
                +'        <span class="product-name">'+ element.name + '</span>'
                +'            <div class="product-secondary-info">'
                +'            <span class="product-prize">S/.'+ element.price + '</span>'
                +'            <span class="product-colors"></span>'
                +'            </div>'
                +'        </div>'
                +'    </a>'
                +'</div>');
        });
    }

    $('#filters').validate({
        ignore: '.ignore, .select2-input',
        focusInvalid: false,
        rules: {
            'name': {
                required: true,
            },
            'last_name': {
                required: false
            },
            'email': {
                required: true,
            },
            'password': {
                required: true,
            }
        },
        messages: {
            name: "Campo invalido",
            last_name: "Campo invalido",
            email: "Campo invalido",
            password: "Campo invalido",
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
                url: "{{ route('filter') }}",
                data: new FormData($("#filters")[0]),
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
                        resultProducts(data.products);
                        swal.close();
                    } else {
                        swal.close();
                        swal(
                            'Oops...',
                            data.message,
                            'error'
                        );
                    }
                }, error: function () {
                    swal.close();
                    swal(
                        'Oops...',
                        'Algo ocurrió!',
                        'error'
                    );
                }
            });
        }
    });
</script>
@endsection

@section('body')
    @include('components.layout.header')
    <div class="container my-5">
        <div class="row">
          <div class="col-lg-3 d-none d-lg-flex">
            @include('components.store.filter')
          </div>
          <div class="col-lg-9">
            <div class="row mb-3">
              <div class="col-12">
                <div class="sorting-filters-container d-flex align-items-center">
                    <div onclick="toggleMenuFilter()" style="cursor: pointer" class="responsive-filter-container d-flex d-lg-none mr-3">
                        <i class="fas fa-sliders-h mr-3"></i> Filtros
                    </div>
                    <div style="width: 20%" class="sorting-filter-container">
                        <select name="order_id" id="order_id" class="form-control">
                            <option id="1" value="1">Alfabetico</option>
                            <option id="2" value="2">$ Mayor a Menor</option>
                            <option id="3" value="3">$ Menor a Mayor</option>
                        </select>
                    </div>
                </div>
              </div>
            </div>
            <div class="row mb-5" id="products_store_container">
                @foreach ($products as $item)
                <div class="col-md-3 col-6 mb-2">
                    <a href="" class="product-container mb-3">
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
          </div>
        </div>
      </div>
@endsection

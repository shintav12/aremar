@extends('template.intern')

@section('css')
<style>
    .orders-headers-wrapper{
        display: flex;
        flex-direction: row;
        justify-content: space-between
    }

    .order-header{
        text-align: center;
        color: #808080;
        font-weight: 600;
        font-size: 1.3rem;
        width: 30%;
    }

    .order-detail{
        text-align: center;
        width: 30%;
        justify-content: center;
        display: flex;
        flex-direction: column;
    }

    .product-item{
        text-align: left;
    }
    .status{
        color:#b3a0a2;
        font-weight: 600;
    }
    .product-item{
        color: #808080;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .total{
        margin-top: 10px;
        font-weight: 600;
        color: #808080;
        font-size: 1.1rem;
        text-align: left
    }
</style>
@endsection

@section('js')
<script>
      $('#form').validate({
        ignore: '.ignore, .select2-input',
        focusInvalid: false,
        rules: {
            'newpassword': {
                required: true,
            },
            'password': {
                required: false
            }
        },
        messages: {
            email: "Campo invalido",
            password: "Campo invalido"
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
                url: "{{ route('signin') }}",
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
                        window.location = "{{ url('/')}}";
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
<div>
    @include('components.store.breadcrumbs')
    <div class="container my-5">
      <div class="row mb-4">
        <div class="col-12">
          <div class="page-title">Tu Cuenta <small><a style="font-size: 15px; color: #b3a0a2; text-decoration:underline" href="{{url('logout')}}">(Cerrar Sesión)</a></small></div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-md-6 col-12">
          <div class="card-profile w-100">
            <div class="card-profile-title">Detalles del Perfil</div>
            <div class="card-profile-content">
            <div class="name">{{$user->name .' '. $user->last_name}}</div>
            <div class="mail">{{$user->email}}</div>
            </div>
            <div class="card-profile-options">
              <a href="{{url('/profile/change-password')}}" class="option">Restablecer Contrase&ntilde;a</a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="card-profile w-100">
            <div class="card-profile-title">Direccion de Envios</div>
            <div class="card-profile-content">
            <div class="name">{{$user->address}}, {{$user->interior}} - {{$user->distrito['nombre']}}</div>
              <div class="mail">{{$user->departamento['nombre']}}, {{$user->postal_code}}</div>
            </div>
            <div class="card-profile-options">
                <a href="{{url('/profile/change-address')}}" class="option">Cambiar direcci&oacute;n de env&iacute;o</a>
              </div>
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-12">
          <div class="card-profile w-100">
            <div class="card-profile-title">Historial de Pedidos</div>
            <div class="card-profile-content">
                @if(isset($orders))
                    @if(count($orders) > 0)
                        <div class="orders-headers-wrapper">
                            <div class="order-header" style="width: 40%">
                                Detalle del pedido
                            </div>
                            <div class="order-header">
                                Dirección de Entrega
                            </div>
                            <div class="order-header">
                                Estado
                            </div>
                        </div>

                        @foreach ($orders as $item)
                            <hr>
                            <div class="orders-headers-wrapper">
                                <div class="order-detail" style="width: 40%">
                                    @foreach ($item->detail as $product)
                                        <div class="product-item">
                                            {{$product->name.' - M/ '.$product->metal_name}}
                                        </div>
                                    @endforeach
                                    <div class="total">
                                        {{'Total S/. '.$item->monto_total}}
                                    </div>
                                </div>

                                <div class="order-detail">
                                    <div class="product-item">
                                        {{ $item->departamento['nombre'].', '.$item->provincia['nombre'].', '.$item->distrito['nombre']}}
                                    </div>
                                    <div class="total m-0">
                                        {{$item->address.', '.$item->interior.' - '.$item->postal_code}}
                                    </div>
                                </div>
                                <div class="order-detail status">
                                    <?php
                                        switch ($item->delivered_status) {
                                            case 0:
                                                echo 'Pedido Recibido';
                                                break;
                                            case 1:
                                                echo 'Preparando Pedido';
                                                break;
                                            case 2:
                                                echo 'Pedido en Camino';
                                                break;
                                            case 3:
                                                echo 'Finalizado';
                                                break;
                                            default:
                                                break;
                                        }
                                    ?>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="mail">No has hecho pedidos aun</div>
                    @endif
                @else
                    <div class="mail">No has hecho pedidos aun</div>
                @endif

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

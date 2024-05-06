@extends('template.free')
@section('css')
<link href="{{asset("plugin/sweetalert2/sweetalert2.css")}}" rel="stylesheet" type="text/css" />
<style>
    .container {
         position: relative;
    }
     .header_image {
         display: block;
         width: 100%;
    }
     .content_container {
         height: 90%;
    }
     .header-container-parent {
         padding: 0px 10%;
    }
     .content {
         float: left;
         position: absolute;
         left: 0px;
         top: 0px;
         z-index: 2;
         height: 100%;
         padding: 5px;
         color: #fff;
         font-weight: 500;
    }
     .pre_crumb {
         color: white;
    }
     .breadcrumb {
         display: flex;
         flex-wrap: wrap;
         padding: 0.75rem 0rem;
         margin-bottom: 1rem;
         list-style: none;
         background-color: transparent;
         border-radius: 0.25rem;
    }
     .title_container {
         display: flex;
         text-align: left;
         height: 100%;
         justify-content: space-around;
         flex-direction: column;
    }
     .centered-div {
         display: flex;
         justify-content: flex-start;
         flex-direction: column;
    }
     .primary_tile {
         color: white;
         font-size: 3.8rem;
         line-height: 80px;
         font-weight: 500;
         padding-right: 30%;
    }
     .secondary_title {
         font-size: 1.4rem;
         color: white;
    }
     .btn-custom {
         margin-top: 15px;
         background-color: white;
         color: #b3a0a2;
         width: 150px;
         padding: 0.3rem 1.5rem !important;
         font-size: 1.5rem;
         font-weight: 500;
    }
     .btn-custom .btn-custom:hover {
         color: white;
         background-color: #b3a0a2;
    }
     @media (max-width: 1024px) {
         .primary_tile {
             font-size: 1.9rem;
             line-height: 1.5;
             padding-right: 25%;
             margin-bottom: 15px;
        }
         .header-container-parent {
             padding: 0px;
        }
         .secondary_title {
             font-size: 1.3rem;
             margin: 1rem 0px !important;
        }
         .btn-custom {
             padding: 0.3rem 1.6rem !important;
             font-size: 1.2rem;
        }
    }
     @media (max-width: 768px) {
         .content_container {
             height: 100%;
        }
         .primary_tile {
             font-size: 1.7rem;
             line-height: 1.5;
        }
         .secondary_title {
             font-size: 1rem;
             margin: 0.5rem 0px !important;
        }
         .breadcrumb_container {
             display: none;
        }
         .btn-custom {
             font-size: 0.9rem;
             padding: 1rem 2rem;
        }
         .header-container-parent {
             padding: 0px;
        }
    }
     @media (max-width: 425px) {
         .header_image {
             display: block;
             width: 100%;
        }
         .header-container-parent {
             padding: 0px;
        }
         .secondary_title {
             font-size: 0.7rem;
             margin: 0.6rem 0px !important;
        }
         .primary_tile {
             font-size: 1rem;
             line-height: 1.2;
        }
         .btn-custom {
             padding: 0.1rem 0.8rem !important;
             font-size: 1rem;
        }
    }
     @media (max-width: 375px) {
         .secondary_title {
             font-size: 0.6rem;
             margin: 0.4rem 0px !important;
        }
         .header-container-parent {
             padding: 0px;
        }
         .primary_tile {
             font-size: 0.9rem;
             padding-right: 25%;
             line-height: 1;
        }
         .btn-custom {
             padding: 0rem 0.5rem !important;
             font-size: 0.8rem !important;
        }
    }
     @media (max-width: 320px) {
         .secondary_title {
             font-size: 0.6rem;
             margin: 0.4rem 0px !important;
        }
         .header-container-parent {
             padding: 0px;
        }
         .primary_tile {
             font-size: 0.9rem;
             padding-right: 15%;
             line-height: 1;
        }
    }
    </style>
@endsection

@section('js')
<script src="{{asset("plugin/sweetalert2/sweetalert2.js")}}" type="text/javascript"></script>
<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
<script>


    $(document).ready(function(){
        window.Mercadopago.setPublishableKey("{{config('app.mercado_pago_public_key')}}");
        window.Mercadopago.getIdentificationTypes();
        document.getElementById('cardNumber').addEventListener('change', guessPaymentMethod);

function guessPaymentMethod(event) {
   let cardnumber = document.getElementById("cardNumber").value;
   if (cardnumber.length >= 6) {
       let bin = cardnumber.substring(0,6);
       window.Mercadopago.getPaymentMethod({
           "bin": bin
       }, setPaymentMethod);
   }
}

function setPaymentMethod(status, response) {
   if (status == 200) {
       let paymentMethod = response[0];
       document.getElementById('paymentMethodId').value = paymentMethod.id;

       getIssuers(paymentMethod.id);
   } else {
       alert(`payment method info error: ${response}`);
   }
}
function getIssuers(paymentMethodId) {
   window.Mercadopago.getIssuers(
       paymentMethodId,
       setIssuers
   );
}

function getInstallments(paymentMethodId, transactionAmount, issuerId){
   window.Mercadopago.getInstallments({
       "payment_method_id": paymentMethodId,
       "amount": parseFloat(transactionAmount),
       "issuer_id": parseInt(issuerId)
   }, setInstallments);
}

function setInstallments(status, response){
   if (status == 200) {
       document.getElementById('installments').options.length = 0;
       response[0].payer_costs.forEach( payerCost => {
           let opt = document.createElement('option');
           opt.text = payerCost.recommended_message;
           opt.value = payerCost.installments;
           document.getElementById('installments').appendChild(opt);
       });
   } else {
       alert(`installments method info error: ${response}`);
   }
}

function setIssuers(status, response) {
   if (status == 200) {
       let issuerSelect = document.getElementById('issuer');
       response.forEach( issuer => {
           let opt = document.createElement('option');
           opt.text = issuer.name;
           opt.value = issuer.id;
           issuerSelect.appendChild(opt);
       });

       getInstallments(
           document.getElementById('paymentMethodId').value,
           document.getElementById('transactionAmount').value,
           issuerSelect.value
       );
   } else {
       alert(`issuers method info error: ${response}`);
   }
}

    function getCardToken(event){
        let $form = document.getElementById('paymentForm');
        window.Mercadopago.createToken($form, setCardTokenAndPay);
        return false;
    }

    function setCardTokenAndPay(status, response) {
        let form = document.getElementById('paymentForm');
        if (status == 200 || status == 201) {
            let card = document.getElementById('ttk');
            card.setAttribute('value', response.id);
            return true;
        } else {
            alert("Verify filled data!\n"+JSON.stringify(response, null, 4));
            return false;
        }
    }

   $('#paymentForm').validate({
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
        },submitHandler:function (form) {
            swal({
                        title: 'Cargando...',
                        timer: 30000,
                        showCancelButton: false,
                        showConfirmButton: false,
                        onOpen: function () {
                            swal.showLoading()
                        }
                    });
            getCardToken();
                    setTimeout(() => {
                        let values = new FormData($("#paymentForm")[0]);
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('checkout_process') }}",
                data: values,
                contentType: false,
                processData: false,
                beforeSend: function () {


                },
                success: function (data) {
                    var error = data.error;
                    if (error == 0) {

                        swal(
                            'Pago Exitoso',
                            data.message,
                            'success'
                        );
                        window.location.href = "{{url('')}}";
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
                    }, 10000);

        }
    });

    });

    $('#departamentos').change(function(){
        $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ url('ubigeo/provincias') }}/"+$(this).val(),
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

                        updateSelects("provincias", data.provincias);
                        updateSelects("distritos", data.distritos);
                        swal.close();

                    } else {
                        swal.close();
                        swal(
                            'Oops...',
                            data.message,
                            'error'
                        );
                    }
                },
                error: function () {
                    swal.close();
                    swal(
                        'Oops...',
                        'Algo ocurrió!',
                        'error'
                    );
                }
        });
    })

    $('#provincias').change(function(){
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{ url('ubigeo/distritos') }}/"+$(this).val(),
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
                    updateSelects("distritos", data.distritos);
                    swal.close();

                } else {
                    swal.close();
                    swal(
                        'Oops...',
                        data.message,
                        'error'
                    );
                }
            },
            error: function () {
                swal.close();
                swal(
                    'Oops...',
                    'Algo ocurrió!',
                    'error'
                );
            }
        });
    })

    function updateSelects(id, data){
        let select = $("#" + id);

        select.html('');
        data.forEach(element => {
            select.append('<option value="'+element.ubigeo+'">'+element.nombre+'</option>');
        });
    }
</script>
@endsection

@section('body')
<div class="container my-5 py-5">
    <form id="paymentForm" class="row">
        <input type="text" hidden name="token" id="ttk" value="">
        <div class="row">
            <div class="col-md-7 h-100">
                <div class="row">
                    <div class="col-12">
                        <div class="logo-checkout">
                            <label><strong>Informacíon de Contacto</strong></label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" value="{{$user->email}}" name="email" placeholder="Correo" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label><strong>Direccion de Envío</strong></label>
                        </div>
                        <div class="form-group">
                            <input type="text" value="{{$user->name}}" name="shipment_name" placeholder="Nombres" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" value="{{$user->last_name}}" name="shipment_last_name" placeholder="Apellidos" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" value="{{$user->address}}" name="shipment_address" placeholder="Direccion" class="form-control">
                        </div>
                        <div class="form-group">
                            <select id="departamentos" class="form-control">
                                @foreach ($departamentos as $item)
                                    <option <?php if($item->ubigeo == $dep) echo 'selected'?> style="text-transform: capitalize" value="{{$item->ubigeo}}">{{$item->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select id="provincias" class="form-control">
                                @foreach ($provincias as $item)
                                    <option style="text-transform: capitalize" <?php if($item->ubigeo == $prov) echo 'selected'?> value="{{$item->ubigeo}}">{{$item->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select id="distritos" name="ubigeo" class="form-control">
                                @foreach ($distritos as $item)
                                    <option <?php if($item->ubigeo == $ubigeo) echo 'selected'?> style="text-transform: capitalize" value="{{$item->ubigeo}}">{{$item->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" value="{{$user->interior}}" name="shipment_interior" placeholder="Piso/Interior" class="form-control">
                            </div>
                            <div class="col-6">
                                <input type="text" value="{{$user->postal_code}}" name="shipment_postal_code" placeholder="Codigo Postal" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">

                        {{ csrf_field() }}
                        <div class="col-12">
                            <div class="form-group">
                                <label><strong>Información de Pago</strong></label>
                            </div>
                            <div class="form-group">
                                <select id="docType" class="form-control" name="docType" data-checkout="docType" type="text"></select>
                            </div>
                            <div class="form-group">
                                <input id="docNumber" class="form-control" placeholder="Número de Documento" name="docNumber" data-checkout="docNumber" type="text"/>
                            </div>
                            <div class="form-group">
                                <input id="cardholderName" placeholder="Titular de la tarjeta" class="form-control" data-checkout="cardholderName" type="text">
                            </div>
                            <div class="row form-group">
                                <div class="col-12">
                                    <label for="">Fecha de vencimiento</label>
                                </div>

                                <div class="col-6">
                                    <input type="text" class="form-control" placeholder="MM" id="cardExpirationMonth" data-checkout="cardExpirationMonth"
                                    onselectstart="return false" onpaste="return false"
                                    oncopy="return false" oncut="return false"
                                    ondrag="return false" ondrop="return false" autocomplete=off>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" placeholder="YY" id="cardExpirationYear" data-checkout="cardExpirationYear"
                                    onselectstart="return false" onpaste="return false"
                                    oncopy="return false" oncut="return false"
                                    ondrag="return false" ondrop="return false" autocomplete=off>
                                </div>
                            </div>
                            <div class="form-group">
                                <input placeholder="Número de la tarjeta" class="form-control" type="text" id="cardNumber" data-checkout="cardNumber"
                                onselectstart="return false" onpaste="return false"
                                oncopy="return false" oncut="return false"
                                ondrag="return false" ondrop="return false" autocomplete=off>
                            </div>
                            <div class="form-group">
                                <input id="securityCode" class="form-control" placeholder="CVV" data-checkout="securityCode" type="text"
                                onselectstart="return false" onpaste="return false"
                                oncopy="return false" oncut="return false"
                                ondrag="return false" ondrop="return false" autocomplete=off>
                            </div>
                            <div id="issuerInput">
                                <select hidden id="issuer" class="form-control" name="issuer" data-checkout="issuer"></select>
                            </div>
                            <input type="hidden" name="transactionAmount" id="transactionAmount" value="<?php
                            $subtotal = 0;
                            foreach ($products as $value) {
                                $subtotal  = $subtotal + $value->price;
                            }
                            echo $subtotal;
                            ?>" />
                            <input type="hidden" name="paymentMethodId" id="paymentMethodId" />
                            <select hidden type="text" class="form-control" id="installments" name="installments"></select>
                            <div class="filter-action">
                                <button style="    border-color: #b3a0a2;"  type="submit" class="btn btn-custom">Pagar</button>
                            </div>
                        </div>

                </div>
            </div>
            <div class="col-md-5 h-100">
                <div id="cart-wrapper" class="cart-wrapper">
                    @if(isset($products) && count($products) > 0)
                        @foreach ($products as $item)
                        <div id="{{$item->uuid}}" class="cart-wrapper-item" style="align-items: center">
                            <div class="cart-image">
                                <img src="{{config('app.IMAGE_URL').$item->path}}" class="img-fluid" alt="">
                            </div>
                            <div class="cart-info ml-2">
                                <div class="item-name">
                                    {{$item->name}}
                                </div>
                                <div class="item-metal">
                                    M / {{$item->metal_name}}
                                </div>

                            </div>
                            <div class="item-price " style="width: 20%; text-align:right">
                                S/. {{$item->price}}
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
                <hr>
                <div class="item-price" style="display: flex; justify-content:space-between;margin:15px">
                    <span>Subtotal</span> <span><?php
                        if(isset($products)){
                            $subtotal = 0;
                            foreach ($products as $value) {
                                $subtotal  = $subtotal + $value->price;
                            }
                            echo 'S/.'.$subtotal;
                        }
                        else{
                            echo 0;
                        }
                    ?></span>
                </div>
                <hr>
                <div class="finaltotal">
                    <div class="subtotal">
                        Total
                    </div>
                    <div id="sum" class="sum">
                        <?php
                            if(isset($products)){
                                $subtotal = 0;
                                foreach ($products as $value) {
                                    $subtotal  = $subtotal + $value->price;
                                }
                                echo 'S/.'.$subtotal;
                            }
                            else{
                                echo 0;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

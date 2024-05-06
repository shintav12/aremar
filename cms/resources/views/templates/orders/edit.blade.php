@extends('layout.master')
@section('css')
<link href="{{asset("assets/global/css/plugins.min.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/global/plugins/ladda/ladda-themeless.min.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/file-input/css/fileinput.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset("assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css")}}" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
<script src="{{ asset("assets/global/plugins/jquery.blockui.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/ladda/spin.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/ladda/ladda.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/scripts/util.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/jquery-validation/js/jquery.validate.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/jquery-validation/js/localization/messages_es.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/scripts/validate.js?v=1")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js")}}" charset="UTF-8" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/file-input/js/fileinput.js') }}" type="text/javascript"></script>
@php  $model = $data["model"]; @endphp
    <script>
        $(document).ready(function(){
            $("#image").fileinput({
            allowedFileExtensions: ["png","jpg"],
            maxFileSize : 100000,
            uploadAsync: false,
            showUpload: false,
            showRemove: false,
            maxImageHeight: 200,
            minImageHeight: 200,
            maxImageWidth: 830,
            minImageWidth: 830,
            language: 'es',
            @if(strlen($model->path) > 0)
                initialPreviewAsData: true,
                initialPreview: [
                    "{{ config("app.IMAGE_URL").$model->path.'?v='.strtotime($model->updated_at) }}",
                ],
            @endif
        });
            <?php
            $date = date("d/m/Y");
        ?>

        $('.date').datepicker({
            autoclose: 'true',
            language: 'es'
        });
        let ajax = function(e){
            let ladda = Ladda.create(document.querySelector('#submit-button'));
            let data = [];
            let values = new FormData(e);
            $.ajax({
                url: $(e).attr("action"),
                type: $(e).attr("method"),
                data: values,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    ladda.start();
                    waitBlockUI("#web-block");
                },
                error: function(json){
                    if(json.status === 422){
                        var errors = json.responseJSON;
                        $.each(errors['errors'], function (key, value) {
                            $('#'+key+'-error').html(value);
                        });
                    }
                },
                success: function (data) {
                    if (data['code'] === 0) {
                        swal({
                            type: 'success',
                            title: "{{ config("constants.sweet_alert.success.title") }}",
                            text: "{{ config('constants.sweet_alert.success.message') }}",
                            showCloseButton: true,
                            cancelButtonText: "{{ config('constants.sweet_alert.button.cancel') }}"
                        }).then(function () {
                            window.location = "{{ route($routes['list']) }}";
                        });
                    } else {
                        swal({
                            type: 'error',
                            title: "{{ config("constants.sweet_alert.error.title") }}",
                            text: data['error'],
                            showCloseButton: true,
                            cancelButtonText: "{{ config('constants.sweet_alert.button.cancel') }}"
                        });
                    }
                },
                complete: function () {
                    setTimeout(function () {
                        ladda.stop();
                        stopBlockUI("#web-block");
                    }, 2000);
                }
            })
        };

        startValidate("#form-web",{
            title: {
                required: true,
            },
        },ajax);
        });
    </script>
@endsection
@section('body')
    <h1 class="page-title"> {{ $title }}
        <small>{{ $sub_title }}</small>
    </h1>
    <div class="row">
        <div class="col-xs-12">
            <div id="web-block" class="tabbable-line boxless tabbable-reversed">
                <ul class="nav nav-tabs" id="language_tab">
                    <li >
                        <a class="tab_header" href="#tab_0" data-toggle="tab">Información</a>
                    </li>
                </ul>
                <form autocomplete="off" role="form" id="form-web" action="{{ route($routes['update'],['id'=>$id]) }}" novalidate="novalidate" method="post">
                    <div class="tab-content">
                        {{ csrf_field() }}
                        <div class="tab-pane active" id="tab_0">
                            <div class="form-body">
                                <div class="col-xs-12" style="padding: 20px">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input readonly type="text"  class="form-control" name="name"  value="{{$model->description}}" placeholder="Ingrese el campo" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Comprador</label>
                                        <input readonly type="text"  class="form-control" name="name"  value="{{$model->name . ' ' . $model->last_name}}" placeholder="Ingrese el campo" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Codigo Postal</label>
                                        <input readonly type="text"  class="form-control" name="name"  value="{{$model->postal_code}}" placeholder="Ingrese el campo" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Localidad</label>
                                        <input readonly type="text"  class="form-control" name="name"  value="{{$address}}" placeholder="Ingrese el campo" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Direccion</label>
                                        <input readonly type="text"  class="form-control" name="name"  value="{{$model->address}}" placeholder="Ingrese el campo" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Piso/Interior</label>
                                        <input readonly type="text"  class="form-control" name="name"  value="{{$model->interior}}" placeholder="Ingrese el campo" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tipo de Documento</label>
                                        <input readonly type="text"  class="form-control" name="name"  value="{{$model->document_type}}" placeholder="Ingrese el campo" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Número de documento</label>
                                        <input readonly type="text"  class="form-control" name="name"  value="{{$model->document_number}}" placeholder="Ingrese el campo" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Monto Total</label>
                                        <input readonly type="text"  class="form-control" name="name"  value="{{$model->monto_total}}" placeholder="Ingrese el campo" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Resultado del pago</label>
                                        <input readonly type="text"  class="form-control" name="name"  value="{{json_decode($model->payment_response)->status}}" placeholder="Ingrese el campo" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Estado de entrega</label>
                                        <select name="delivered_status" class="form-control">
                                            <option  <?php if(0 == $model->delivered_status) echo 'selected'?> value="0">Pedido Recibido</option>
                                            <option  <?php if(1 == $model->delivered_status) echo 'selected'?> value="1">Preparando Pedido</option>
                                            <option  <?php if(2 == $model->delivered_status) echo 'selected'?> value="2">Delivery en camino</option>
                                            <option  <?php if(3 == $model->delivered_status) echo 'selected'?> value="3">Recepcion Confirmada</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Detalle de la orden</label>
                                        <div class="row">
                                            @foreach($data['order_details'] as $detail)
                                                <div class="col-md-6 form-group" style="width: 50% !important">
                                                    <div class="product_name">
                                                        <strong>Nombre del Producto:</strong> {{$detail->name}}
                                                    </div>
                                                    <div class="product_name">
                                                        <strong>Metal:</strong> {{$detail->metal_name}}
                                                    </div>
                                                    <div class="product_name">
                                                        <strong>Coleccion:</strong> {{$detail->collection_name}}
                                                    </div>
                                                    <div class="product_name">
                                                        <strong>Precio:</strong> {{$detail->price}}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row" style="padding: 50px 0;">
                                <div class="col-xs-12">
                                    <div class="col-md-3 col-md-9">
                                        <button id="submit-button" type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-left" data-spinner-color="#333">
                                            <span class="ladda-label">Guardar</span>
                                        </button>
                                        <a type="button" href="{{ route($routes['list']) }}" class="btn default">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

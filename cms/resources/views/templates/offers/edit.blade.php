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
            maxImageHeight: 292,
            minImageHeight: 292,
            maxImageWidth: 440,
            minImageWidth: 440,
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
                                        <input type="text" value="{{$model->name}}" class="form-control" name="name"  placeholder="Ingrese el campo" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Imagen (440 * 292, png,jpg)</label>
                                        <input type="file" name="path" id="image">
                                    </div>
                                    <div class="form-group">
                                      <label>Producto</label>
                                      <select name="product_id" id="" class="form-control">
                                          @foreach ($data['products'] as $item)
                                            <option <?php if($item->id === $model->product_id) echo 'selected'?> value="{{$item->id}}">{{$item->name}} - {{$item->price}}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Fecha de Finalizacion</label>
                                        <div class="input-group date">
                                            <input type="text" class="form-control" name="final_date" value="{{ date('d/m/Y',strtotime($model->final_date))}}">
                                            <div class="input-group-addon cal_button">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Ofertas (%)</label>
                                        <input type="number" value="{{$model->price}}" class="form-control" name="price"  placeholder="Ingrese el campo" required>
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

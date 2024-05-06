@extends('layout.master')
@section('css')
<link href="{{asset("assets/global/css/plugins.min.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/global/plugins/ladda/ladda-themeless.min.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/file-input/css/fileinput.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
<script src="{{ asset("assets/global/plugins/jquery.blockui.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/ladda/spin.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/ladda/ladda.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/scripts/util.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/jquery-validation/js/jquery.validate.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/jquery-validation/js/localization/messages_es.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/scripts/validate.js?v=1")}}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/file-input/js/fileinput.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function(){
            $("#image").fileinput({
            allowedFileExtensions: ["jpg","png"],
            maxFileSize : 100000,
            uploadAsync: false,
            showUpload: false,
            showRemove: false,
            maxImageHeight: 700,
            minImageHeight: 400,
            maxImageWidth: 1920,
            minImageWidth: 1920,
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
                    <li class="active">
                        <a class="tab_header" href="#tab_0" data-toggle="tab">Información</a>
                    </li>
                </ul>
                <form autocomplete="off" role="form" id="form-web" action="{{ route($routes['store']) }}" novalidate="novalidate" method="post">
                    <div class="tab-content">
                        {{ csrf_field() }}
                        <div class="tab-pane active" id="tab_0">
                            <div class="form-body">
                                <div class="col-xs-12" style="padding: 20px">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text"  class="form-control" name="name"  placeholder="Ingrese el campo" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Titulo</label>
                                        <input type="text"  class="form-control" name="title"  placeholder="Ingrese el campo" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Texto Boton</label>
                                        <input type="text"  class="form-control" name="btn_text"  placeholder="Ingrese el campo">
                                    </div>
                                    <div class="form-group">
                                        <label>Link Boton</label>
                                        <input type="text"  class="form-control" name="btn_link"  placeholder="Ingrese el campo">
                                    </div>
                                    <div class="form-group">
                                        <label>Subtitulo</label>
                                        <input type="text"  class="form-control" name="subtitle" placeholder="Ingrese el campo" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Imagen 1920x700 ó 1920x400 </label>
                                        <input type="file" name="path" id="image">
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

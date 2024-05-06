@extends('layout.master')
@section('css')
<link href="{{asset("assets/global/css/plugins.min.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/global/plugins/ladda/ladda-themeless.min.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/global/plugins/file-input/css/fileinput.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
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
<script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>

@php
    $model = $data["model"];
@endphp
    <script>
        $(document).ready(function(){
            $("#path_metas").fileinput({
                allowedFileExtensions: ["jpg","png"],
                maxFileSize : 100000,
                uploadAsync: false,
                showUpload: false,
                showRemove: false,
                maxImageHeight: 630,
                minImageHeight: 630,
                maxImageWidth: 1200,
                minImageWidth: 1200,
                language: 'es',
                @if(strlen($model->path) > 0)
                    initialPreviewAsData: true,
                    initialPreview: [
                        "{{ config("app.cloudfront").$model->path.'?v='.strtotime($model->updated_at) }}",
                    ],
                @endif
            });

        let ajax = function(e){
            let ladda = Ladda.create(document.querySelector('#submit-button'));
            let data = [];
            let values = new FormData(e);
            if ( $(".kv-fileinput-error.file-error-message").is(":visible") ){
                swal({
                    type: 'error',
                    title: "Oops...",
                    text: 'Por favor, suba la imagen en el tamaño indicado',
                    showCloseButton: true,
                    cancelButtonText: "{{ config('constants.sweet_alert.button.cancel') }}"
                });
            } else {
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
            }
        };

        startValidate("#form-web",{

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
                        <a class="tab_header" href="#tab_0" data-toggle="tab">SEO</a>
                    </li>
                </ul>
                <form autocomplete="off" role="form" id="form-web" action="{{route('user_updated_metas',['id'=>$id]) }}" novalidate="novalidate" method="post">
                    <div class="tab-content">
                        {{ csrf_field() }}
                        <div class="tab-pane active" id="tab_0">
                            <div class="form-body">
                                <div class="col-xs-12" style="padding: 20px">
                                    <div class="col-xs-12" style="padding: 20px">
                                        <div class="form-group">
                                            <label>Imagen Compartir (1200 * 630, jpg,png)</label>
                                            <input type="file" name="path_metas" id="path_metas">
                                        </div>
                                        <div class="form-group">
                                            <label>Meta index</label>
                                            &nbsp;&nbsp;
                                            <input type="checkbox" name="meta_index" {{$model->meta_index == 1 ? "checked" :""}}  class="make-switch switch" id="meta_index" data-on-text="&nbsp;Si&nbsp;" data-off-text="&nbsp;No&nbsp;" data-size="small">
                                        </div>
                                        <div class="form-group">
                                            <label>Meta follow</label>
                                            &nbsp;
                                            <input type="checkbox" name="meta_follow" {{$model->meta_follow == 1 ? "checked" :""}}  class="make-switch switch" id="meta_follow" data-on-text="&nbsp;Si&nbsp;" data-off-text="&nbsp;No&nbsp;" data-size="small">
                                        </div>
                                        <div class="form-group">
                                            <label>Título</label>
                                            <input type="text" maxlength="200" value="{{$model->meta_title}}"
                                            class="form-control" name="meta_title" placeholder="Ingrese el campo">
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <input type="text" maxlength="200" value="{{$model->meta_description}}"
                                            class="form-control" name="meta_description" placeholder="Ingrese el campo">
                                        </div>
                                        <div class="form-group">
                                            <label>Keywords</label>
                                            <input type="text" maxlength="200" value="{{$model->meta_keywords}}"
                                            class="form-control" name="meta_keywords" placeholder="Ingrese el campo">
                                        </div>
                                        <div class="form-group">
                                            <label>Título Facebook</label>
                                            <input type="text" maxlength="200" value="{{$model->fb_title}}"
                                            class="form-control" name="fb_title" placeholder="Ingrese el campo">
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción Facebook </label>
                                            <input type="text" maxlength="200" value="{{$model->fb_description}}"
                                            class="form-control" name="fb_description" placeholder="Ingrese el campo">
                                        </div>
                                        <div class="form-group">
                                            <label>Título Twitter</label>
                                            <input type="text" maxlength="200" value="{{$model->tw_title}}"
                                            class="form-control" name="tw_title" placeholder="Ingrese el campo">
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción Twitter</label>
                                            <input type="text" maxlength="200" value="{{$model->tw_description}}"
                                            class="form-control" name="tw_description" placeholder="Ingrese el campo">
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

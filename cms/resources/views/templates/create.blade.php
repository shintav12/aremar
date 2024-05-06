@extends('layout.master')

@section('css')
    <link href="{{asset("assets/global/plugins/datatables/datatables.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/global/css/plugins.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/global/plugins/ladda/ladda-themeless.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/global/plugins/file-input/css/fileinput.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css")}}" rel="stylesheet" type="text/css" />
    <style>
        .help-block{
            display: table-row;
        }
    </style>
@endsection

@section('scripts')
    <script src="{{ asset("assets/global/scripts/datatable.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/datatables/datatables.min.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/jquery.blockui.min.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/ladda/spin.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/ladda/ladda.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/scripts/util.js") }}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/file-input/js/fileinput.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/jquery-validation/js/jquery.validate.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/jquery-validation/js/localization/messages_es.js") }}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/scripts/validate.js") }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $(".date-picker").datepicker({
                rtl: App.isRTL(),
                orientation: "right",
                autoclose: true,
                language: 'es',
            });
            $("#input-image").fileinput({
                allowedFileExtensions: ["jpg","png"],
                uploadAsync: false,
                showUpload: false,
                showRemove: false,
                maxImageHeight: 258,
                minImageHeight: 258,
                maxImageWidth:  360,
                minImageWidth: 360,
                initialPreviewAsData: true,
                language: 'es',
            });
        });

        let ajax = function(e){
            let values = new FormData(e);
            let ladda = Ladda.create(document.querySelector('#submit-button'));
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
            description: {
                required: true,
            },
        },ajax);

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
                        <a class="tab_header" href="#tab_0" data-toggle="tab"> Información General </a>
                    </li>
                </ul>
                <form autocomplete="off" role="form" id="form-web" action="{{ route($routes['store']) }}" novalidate="novalidate" method="post">
                    <div class="tab-content">
                        {{ csrf_field() }}
                        <div class="tab-pane active" id="tab_0">
                            <div class="form-body">
                                <div class="col-xs-12" style="padding: 20px">
                                      <?php foreach ($columns_types as $key => $value) {
                                        ?>
                                        <div class="form-group">
                                             <?php if($key != "position"){?>
                                            <label>{{ ucfirst($key) }}</label>
                                            <?php $type = "text";
                                                if($key == "password"){
                                                    $type = "password";
                                                }
                                                if(count($options)>0 && array_key_exists($key,  $options)){
                                                    $choices = $options[$key];
                                                    $type = $choices["type"];
                                                    if($type == "select"){
                                                        ?>
                                                        <select class="form-control" name="{{ $key }}" id="{{ $key }}">
                                                            <?php   foreach ($choices["data"] as $key => $value) {
                                                                ?>
                                                                <option value="<?php echo $value->id ?>" <?php echo isset($data["model"]) && $data["model"]->{$key} == $value->id ? "selected" : "" ?> ><?php echo $value->name ?></option>
                                                                <?php
                                                            } ?>
                                                        </select>
                                                        <?php
                                                    }
                                                ?>
                                                <?php
                                                }else{
                                             ?>
                                            

                                             
                                            <input type="{{ $type }}" value="<?php echo isset($data["model"]) && $data["model"]->{$key} && $key != "password" ? $data["model"]->{$key} : '' ?>" class="form-control" name="{{ $key }}"  placeholder="Ingrese el campo" <?php echo $key != "password" ? "required" : "" ?>>
                                        
                                        <?php
                                            }
                                            ?>
                                            </div>
                                            <?php
                                    }} ?>
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
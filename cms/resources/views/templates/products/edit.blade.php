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
@php  $model = $data["model"]; @endphp
    <script>
        $(document).ready(function(){
        $("#image").fileinput({
            allowedFileExtensions: ["jpg","png"],
            maxFileSize : 100000,
            uploadAsync: false,
            showUpload: false,
            showRemove: false,
            language: 'es',
            @if(strlen($model->path) > 0)
                initialPreviewAsData: true,
                initialPreview: [
                    "{{ config("app.IMAGE_URL").$model->path.'?v='.strtotime($model->updated_at) }}",
                ],
            @endif
        });
        $("#altimage").fileinput({
            allowedFileExtensions: ["jpg","png"],
            maxFileSize : 100000,
            uploadAsync: false,
            showUpload: false,
            showRemove: false,
            language: 'es',
            @if(strlen($model->alt_path) > 0)
                initialPreviewAsData: true,
                initialPreview: [
                    "{{ config("app.IMAGE_URL").$model->alt_path.'?v='.strtotime($model->updated_at) }}",
                ],
            @endif
        });

        <?php foreach( $data['images'] as $key => $value )  { ?>

            $("#extraproduct_{{$key}}").fileinput({
                allowedFileExtensions: ["jpg","png"],
                maxFileSize : 100000,
                uploadAsync: false,
                showUpload: false,
                showRemove: false,
                overwriteInitial: true,
                language: 'es',
                @if( strlen($value->path) != 0 )
                    initialPreviewAsData: true,
                    initialPreview: [
                        "{{ config("app.IMAGE_URL").$value->path.'?v='.strtotime($value->updated_at) }}",
                    ],
                @endif
            });

         <?php } ?>

         $("body").on("click",".btn_remove",function(){
            $(this).parent().parent().parent().parent().remove();
            //al eliminar un input, renombramos los ids para cada input para slider
            let s_item = $(this).parent().parent().find(".slider_item").attr("id");
            let length_product = $("#accounts").children().length;
            s_item = s_item.split("_");
            let s_begin = Number(s_item[1]);
            for ( let i = s_begin; i < length_product; i++ ) {
                s_aux = i+1;
                $("#extraproduct_"+String(s_aux)).attr("id","extraproduct_"+String(i));
            }

            // count_slider--;
            // if (count_slider < 10) {
            //     $("#insert_button_container").show();
            // }
        });

        $("#add_image").click(function(){

            let content = '<div class="container_image">'+
            '<div class="form-group">'+
            '<input type="hidden" name="image_id[]" value="0">'+
            '<div class="row">'+
            '<div class="col-sm-8"><input type="file" class="input-fixed form-control product_image" id="extraproduct_{id}" name="extraproduct[]"></div>'+
            '<div class="col-sm-4"><button type="button" name="remove"  class="btn btn-danger btn_remove"><i class="fa fa-trash fa-lg"></i></button></div>'+
            '</div>'+
            '<label>Alt</label>'+
            '<textarea  name="alt[]" class="form-control"></textarea>'+
            '</div>'+
            '</div>';
            let total = $("#image_product").children().length;
            $("#image_product").append(content.replace("{id}",total));

            $(".product_image").fileinput({
                allowedFileExtensions: ["jpg","png"],
                maxFileSize : 100000,
                uploadAsync: false,
                showUpload: false,
                showRemove: false,

                overwriteInitial: true,
                language: 'es',
            });

            // count_slider++;
            // if (count_slider == 10) {
            //     $("#insert_button_container").hide();
            // }

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
                    <li>
                        <a class="tab_header" href="#tab_2" data-toggle="tab">Imagenes</a>
                    </li>
                    <li>
                        <a class="tab_header" href="#tab_3" data-toggle="tab">Secciones</a>
                    </li>
                    <li>
                        <a class="tab_header" href="#tab_4" data-toggle="tab">Metales</a>
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
                                        <input type="text"  class="form-control" name="name"  value="{{$model->name}}" placeholder="Ingrese el campo" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Categoria</label>
                                        <select name="category_id" class="form-control">
                                            @foreach ($data['categories'] as $item)
                                                <option  <?php if($item->id == $model->category_id) echo 'selected'?> value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Colección</label>
                                        <select name="collection_id" class="form-control">
                                            @foreach ($data['collections'] as $item)
                                                <option  <?php if($item->id == $model->collection_id) echo 'selected'?> value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Precio</label>
                                        <input type="number"  class="form-control" name="price" value="{{$model->price}}" placeholder="Ingrese el campo" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Descripcion Corta</label>
                                        <input type="text"  class="form-control" name="short_description" value="{{$model->short_description}}" placeholder="Ingrese el campo" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Descripcion</label>
                                        <input type="text"  class="form-control" name="description" value="{{$model->description}}" placeholder="Ingrese el campo" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Imagen 325x401</label>
                                        <input type="file" name="path" id="image">
                                    </div>
                                    <div class="form-group">
                                        <label>Imagen Alternativa 325x401</label>
                                        <input type="file" name="alt_path" id="altimage">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <div class="form-body">
                                <div class="col-xs-12" style="padding: 20px">
                                    <div class="form-group" id="image_slider_container" style="padding-top: 10px;">
                                        <h2 class="page-title">Imágenes para Producto</h2>
                                        <div id="insert_button_container">
                                            <label style="padding-right: 10px;">Insertar imágenes para el producto (325x401, jpg - png)</label>
                                            <button type="button" name="add_image" id="add_image" class="btn btn-primary mt-ladda-btn ladda-button" >
                                                <i class="fa fa-plus-square fa-sm"></i>&nbsp Agregar
                                            </button>
                                        </div>
                                        <div id="image_product" style="padding: 10px 0;">
                                            @foreach( $data['images'] as $key => $value )
                                            <div class="container_image">
                                                <div class="form-group">
                                                    <input type="hidden" name="image_id[]" value="{{$value->id}}">
                                                    <div class="row">
                                                        <div class="col-xs-8">
                                                            <input type="file" class="input-fixed form-control" id="extraproduct_{{$key}}" name="extraproduct[]">
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <button data-id="{{ $value->id }}" type="button" name="remove"  class="btn btn-danger btn_remove"><i class="fa fa-trash fa-lg"></i></button>
                                                        </div>
                                                    </div>
                                                    <label>Alt</label>
                                                    <textarea  name="alt[]" class="form-control">{{$value->alt}}</textarea>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <div class="form-body">
                                <div class="col-xs-12" style="padding: 20px">
                                    <div class="form-body">
                                        <div class="col-xs-12" style="padding: 20px">
                                            <?php $section_array = explode(',', $model->sections);
                                        ?>
                                            @foreach($data['sections'] as $section)
                                            <div class="form-group">
                                                <label>{{$section->name}}</label>
                                                &nbsp;&nbsp;
                                                <input type="checkbox" {{in_array(" ".$section->id." ",$section_array) ? "checked" :""}} name="sections_{{$section->id}}"  class="make-switch switch" id="meta_index" data-on-text="&nbsp;Si&nbsp;" data-off-text="&nbsp;No&nbsp;" data-size="small">
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_4">
                            <div class="form-body">
                                <div class="col-xs-12" style="padding: 20px">
                                    <?php $metals_array = explode(',', $model->metals);
                                        ?>
                                    @foreach($data['metals'] as $metal)
                                    <div class="form-group">
                                        <label>{{$metal->name}}</label>
                                        &nbsp;&nbsp;

                                        <input type="checkbox" {{in_array(" ".$metal->id." ",$metals_array) ? "checked" :""}} name="metals_{{$metal->id}}"  class="make-switch switch" id="meta_index" data-on-text="&nbsp;Si&nbsp;" data-off-text="&nbsp;No&nbsp;" data-size="small">
                                    </div>
                                    @endforeach
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

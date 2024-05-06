@extends('layout.master')
@section('css')
    <link href="{{asset("assets/global/plugins/datatables/datatables.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/global/css/plugins.min.css")}}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        thead{
            background: grey; 
            color: white;
        }
    </style>
@endsection

@section('scripts')
    <script src="{{ asset("assets/global/scripts/datatable.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/datatables/datatables.min.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/scripts/util.js") }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            let dataTable = $('#dt_web').DataTable({
                "ajax": {
                    url: "{{ route($routes['datatable']) }}",
                },
                "columns": [
                <?php 
                    $index = -1;
                    foreach ($columns as $key => $value) {
                        $index = $value == "status" ? $key : $index;
                  ?>
                    {data: '<?php echo $value ?>', name: '<?php echo $value ?>', title: '<?php echo $value == "id" ? "#" : $value ?>'},

                  <?php  
                } ?>
                    {title: 'Acciones'},
                    
                ],
                "columnDefs": [
                    {
                        "searchable": false,
                        "targets": [0]
                    }
                ],
                "aoColumnDefs": [
                    <?php if($index != -1){
                        ?>
                        {
                            "aTargets": [<?php echo $index ?>],
                            "mData": null,
                            "mRender": function (data, type, full) {
                                if(full.status  === '1'){
                                    return '<input type="checkbox" checked data-id="'+ full.id + '"  class="make-switch switch"  data-on-text="&nbsp;ACTIVO&nbsp;" data-off-text="&nbsp;INACTIVO&nbsp;" data-size="normal">';
                                }else{
                                    return '<input type="checkbox"  data-id="'+ full.id + '" class="make-switch switch" data-on-text="&nbsp;ACTIVO&nbsp;" data-off-text="&nbsp;INACTIVO&nbsp;" data-size="normal">';
                                }
                            }
                        },
                        <?php
                    } ?>
                    {
                        "aTargets": [<?php echo count($columns) ?>],
                        "mData": null,
                        "mRender": function (data, type, full) {
                            return '<a href="{{ route($routes["edit"]) }}/'+data.id+'" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp;Editar</a>';
                        }
                    }
                ],
                "fnDrawCallback": function( oSettings ) {
                    $('.switch').bootstrapSwitch(
                        {
                            'size': 'mini',
                            'onSwitchChange': function(event, state){
                                $.ajax({
                                    type: "POST",
                                    dataType: "JSON",
                                    url: "{{ route($routes['status']) }}",
                                    headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                                    data: {
                                        id: $(this).data('id'),
                                        status: $(this).is(':checked') ? 1 : 0,
                                    },
                                    beforeSend: function (){
                                        waitSweetAlert();
                                    },
                                    success: function (data) {
                                        dataTable.ajax.reload();
                                        swal.close();
                                    }
                                });
                            },
                            'AnotherName':'AnotherValue'
                        }
                    );
                },
                "processing": true,
                "serverSide": true,
                "order" : [[0,"asc"]],
                "language": {
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "zeroRecords": "No se encontraron registros",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar: ",
                    "sLoadingRecords": "Cargando...",
                    "processing":"Procesando...",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                },
            });
        })
    </script>
@endsection
@section('body')
    <h1 class="page-title"> {{ $title }}
        <small>{{ $sub_title }}</small>
    </h1>
    <div class="row">
        <div class="col-xs-12">
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <?php if($allow_creation){ ?>
                    <a href="{{ route($routes["create"]) }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i>&nbsp;Nuevo</a>
                    <div class="tools"> </div>
                    <?php } ?>
                </div>
                <div class="portlet-body">
                    <div class="table-container" style="margin-top: 30px;">
                        {{ csrf_field() }}
                        <table class="table table-striped table-bordered table-hover" id="dt_web">
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

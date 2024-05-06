@extends('layout.master')
@section('css')
    <link href="{{asset("assets/global/plugins/datatables/datatables.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/global/css/plugins.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/global/plugins/sweetalert2/sweetalert2.css")}}" rel="stylesheet" type="text/css" />

@endsection

@section('scripts')
    <script src="{{ asset("assets/global/scripts/datatable.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/datatables/datatables.min.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/scripts/util.js") }}" type="text/javascript"></script>
    <script src="{{asset("assets/global/plugins/sweetalert2/sweetalert2.js")}}" type="text/javascript"></script>

    <script>
        $(document).ready(function(){
            let dataTable = $('#dt_web').DataTable({
                "ajax": {
                    url: "{{ route($routes['datatable']) }}",
                },
                "columns": [
                    {data: 'id', name: 'id', title: '#', width: "10px"},
                    {data: 'name', name: 'name', title: 'Tipo'},
                    {data: 'created', name: 'created', title: 'F.Creación'},
                    {data: 'updated', name: 'updated', title: 'F.Actualización'},
                    {title: 'Acciones'},
                ],
                "columnDefs": [
                    {
                        "searchable": false,
                        "targets": [0,3]
                    }
                ],
                "aoColumnDefs": [
                    {
                        "aTargets": [4],
                        "mData": null,
                        "mRender": function (data, type, full) {
                            return '<a title="Editar" href="{{ route($routes["edit"]) }}/'+data.id+'" class="btn btn-primary"><i class="fa fa-edit"></i></a>'
                        }
                    }
                ],
                "fnDrawCallback": function (oSettings) {
                    $(".delete").click(function(e){
                        var id = $(this).data('id');
                        e.preventDefault();
                        swal({
                          title: "¿Está seguro?",
                          text: "Una vez eliminado los datos no se recuperarán",
                          type: "warning",
                          showCancelButton  : true,
                          confirmButtonClass: "btn-danger",
                          confirmButtonText : "Confirmar",
                          cancelButtonText : "Cancelar",
                          confirmButtonColor : "#E32212"

                        })
                        .then((willDelete) => {
                          if (willDelete) {
                                swal.close();
                                $.ajax({
                                    type: "POST",
                                    dataType: "JSON",
                                    url: "{{ route($routes['delete']) }}",
                                    headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                                    data: {
                                        id: id,
                                    },
                                    beforeSend: function (){
                                        open = false;
                                        swal({
                                            title: 'Cargando...',
                                            text: '',
                                            showCancelButton: false,
                                            showConfirmButton: false,
                                            onOpen: function () {
                                                swal.showLoading()
                                            }
                                        });
                                    },
                                    success: function (data) {
                                        swal.close();
                                        dataTable.ajax.reload();
                                    }
                                });
                          }
                        })
                        .catch(swal.noop);
                    });
                    $('.switch').bootstrapSwitch(
                        {
                            'size': 'mini',
                            'onSwitchChange': function (event, state) {
                                $.ajax({
                                    type: "POST",
                                    dataType: "JSON",
                                    url: "{{ route($routes['status']) }}",
                                    headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
                                    data: {
                                        id: $(this).data('id'),
                                        status: $(this).is(':checked') ? 1 : 0,
                                    },
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
                                        swal.close();
                                        swal("OK", "La solicitud ha tenido éxito.", "success");
                                        dataTable.ajax.reload();
                                    }
                                });
                            },
                            'AnotherName': 'AnotherValue'
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
            dataTable.on('row-reorder', function (e, diff, edit) {
                let changes = [];
                for(var i=0, ien=diff.length ; i<ien ; i++ ) {
                    changes.push([diff[i].oldData,diff[i].newData])
                }
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route($routes['reorder']) }}",
                    headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val() },
                    beforeSend: function() {
                        swal({
                            title: 'Cargando...',
                            text: '',
                            showCancelButton: false,
                            showConfirmButton: false,
                            onOpen: function () {
                                swal.showLoading()
                            }
                        });
                    },
                    data: {
                        "values" : JSON.stringify(changes)
                    },
                    success: function (data) {
                        swal.close();
                        location.reload(true);
                    },
                    error: function () {
                    }
                });
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
                <div class="portlet-body">
                    <div class="table-container" style="margin-top: 30px;">
                        {{ csrf_field() }}
                        <table class="table table-striped table-bordered table-hover" id="dt_web"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

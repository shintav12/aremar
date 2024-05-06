@extends('template.intern')

@section('css')
<link href="{{asset("plugin/sweetalert2/sweetalert2.css")}}" rel="stylesheet" type="text/css" />
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

    .btn-secondary{
        background-color: white;
        color:#b3a0a2;
        font-size: 1.1rem;
        font-weight: 500;
        text-transform: uppercase;
        border-color: #b3a0a2;
    }

    .btn-secondary:hover{
        border-color: #b3a0a2;
        background-color: #b3a0a2;
        color:white;
    }
</style>
@endsection

@section('js')
<script src="{{asset("plugin/sweetalert2/sweetalert2.js")}}" type="text/javascript"></script>
<script>
     $('#form').validate({
        ignore: '.ignore, .select2-input',
        focusInvalid: false,
        rules: {
            'newpassword': {
                required: true,
            },
            'repeatpassword': {
                required: true
            }
        },
        messages: {
            newpassword: "Campo invalido",
            repeatpassword: "Campo invalido"
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
                url: "{{ route('changePasswordForm') }}",
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
                        swal.close();
                        swal({
                            title: 'Éxito',
                            timer: 3000,
                            text: data.message,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                        setTimeout(function(){
                            window.location = "{{ url('/profile')}}";
                        },2000)

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
    @include('components.store.breadcrumbs')
    <div class="container mt-5">
        <div class="row mb-1">
            <div class="col-12">
                <div class="page-title">Cambiar Contraseña</div>
            </div>
        </div>
    </div>
    <div class="container my-2 mb-5 pb-5">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card-profile">
                    <div class="card-profile-content">
                        <form id="form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="password" name="newpassword" placeholder="Nueva Clave" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="password" name="repeatpassword" placeholder="Repetir Clave" class="form-control">
                            </div>
                            <button id="submit-button" type="submit" class="btn btn-primary w-100">
                                Guardar
                            </button>
                            <a href="{{url('/profile')}}" class="btn btn-secondary mt-2 w-100">
                                Cancelar
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

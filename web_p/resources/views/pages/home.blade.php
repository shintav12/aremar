@extends('template.layout')
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
<script>
    $('#form').validate({
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
        },submitHandler: function (form) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('registernews') }}",
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
                        $('#form')[0].reset();
                        swal(
                            'Registro Exitoso',
                            'Gracias por registrarte a nuestro newsletter',
                            'success'
                        );
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
    @include('components.home.header')
    @include('components.home.offers')
    @include('components.home.products')
    @include('components.home.newsletter')
    @include('components.home.benefits')
@endsection

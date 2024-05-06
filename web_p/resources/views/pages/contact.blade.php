@extends('template.intern')

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
                url: "{{ route('contact') }}",
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
                            'Contacto Exitoso',
                            'Nos Contactaremos contigo a la brevedad posible',
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

@section('css')
<link href="{{asset("plugin/sweetalert2/sweetalert2.css")}}" rel="stylesheet" type="text/css" />
@endsection

@section('body')
<div>
    <div>
      @include('components.layout.header')
    </div>
    <div class="container my-5 py-5">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="section-container">
                    <h1 class="page-title">
                        Informacion de Contacto
                    </h1>
                    <p class="page-description">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.
                    </p>
                    <div class="info-container">
                        <div class="info">
                            <div class="mb-2"><i class="fas fa-phone mr-2"></i><strong> Teléfono:</strong><span class="info-item"> 946 651 539</span>    </div>
                            <div class="mb-2"><i class="fas fa-phone mr-2"></i><strong> Correo:</strong><span class="info-item"> info@joyasaremar.com</span>    </div>
                            <div class="mb-2"><i class="fas fa-phone mr-2"></i><strong> Atencion:</strong><span class="info-item"> 09:00 - 17:00 </span>    </div>
                        </div>
                    </div>
                    <div class="social-container">
                        <span class="mr-3">Siguenos Aqui: </span>
                        <span data-v-4c8f870a="">
                            <a href="https://www.facebook.com/joyas.aremar" target="_blank" class="social-links-contact">
                                <i data-v-4c8f870a="" class="fab fa-facebook-square" aria-hidden="true"></i>
                            </a>
                        </span>
                        <span data-v-4c8f870a="">
                            <a data-v-4c8f870a="" href="https://www.facebook.com/joyas.aremar" target="_blank" class="social-links-contact">
                                <i data-v-4c8f870a="" class="fab fa-facebook-square" aria-hidden="true"></i>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="section-container">
                    <form id="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Nombre" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" placeholder="Correo" class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" placeholder="Mensaje" id="" cols="30" rows="10"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>

@endsection

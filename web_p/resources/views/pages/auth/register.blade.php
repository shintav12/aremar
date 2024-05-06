@extends('template.auth')

@section('js')
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
                url: "{{ route('signup') }}",
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
                        window.location = "{{ url('/')}}";
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
@endsection

@section('body')
<div class="bg">
    <div class="row fullH">
      <div class="centered-content w-100">
        <div class="centered-div">
          <div class="page-headd mb-5 pb-2">
            <div class="logo-login">
                <img src="{{asset('img/logos/logo-login.svg')}}" alt class="img-fluid img-logo" />
            </div>
            <div
              class="logo-text"
            >Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh</div>
          </div>
          <div class="px-4 d-flex justify-content-center">
            <div class="card">
              <div class="card-head">
                <div class="main-text">¿Ya tienes cuenta?</div>
                <div class="secondary-text">ingresa
                    <a href="{{url('login')}}">aqui</a>
                </div>
              </div>
              <div class="ssmm-access">
                <div class="option google"></div>
                <div class="option facebook"></div>
              </div>
              <div class="content-card">
                <form id="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Nombres" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="text" name="last_name" placeholder="Apellidos" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Correo" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input name="password" type="password" placeholder="Clave" class="form-control" />
                    </div>
                    <button id="submit-button" type="submit" class="btn btn-primary w-100">
                        Registrar
                    </button>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

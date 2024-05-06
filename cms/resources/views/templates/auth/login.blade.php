<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" style="height: 100%">
<head>
    <meta charset="utf-8" />
    <title>Admin | Joyas Aremar - Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="{{asset("assets/global/plugins/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/global/plugins/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/global/css/components.min.css")}}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{asset("css/login-4.css")}}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon" />
<body class="login" style="background: url( {{ asset('img/bg.jpg') }} ) no-repeat center; background-size: cover; background-color: black !important;" style="background-color: black">
<div class="logo">
    <a href="#">
        <div class="w-100">
          <img width="350" src={{asset("img/logo-login.svg")}} alt="" />
        </div>
      </a>
  </div>
<div class="content" style="padding-top: 40px; background-color:#b3a0a2;">
    <form autocomplete="off" class="login-form" action="{{ route('login') }}" method="post">
        {{ csrf_field() }}
        @if($errors->has('validation'))
            <div class="alert alert-danger display-show">
                <strong>¡Error!</strong> {{ $errors->first('validation') }}
            </div>
        @endif
        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Usuario</label>
            <div class="input-icon">
                <input class="form-control placeholder-no-fix" type="text" value="{{ old("username") }}" autocomplete="off" placeholder="Usuario" name="username" /> </div>
                @if($errors->has('username'))
                    <span class="help-block">{{ $errors->first('username') }}</span>
                @endif
        </div>
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Contraseña</label>
            <div class="input-icon">
                <input class="form-control placeholder-no-fix" type="password" value="{{ old("password") }}" autocomplete="off" placeholder="Contraseña" name="password" /> </div>
            @if($errors->has('password'))
                <span class="help-block">{{ $errors->first('password') }}</span>
            @endif
        </div>
        @if(Session::has("message"))
            <div class="alert alert-danger">
                {{ Session::get("message") }}
            </div>
        @endif
        <div class="form-actions" style="margin-bottom: 25px">
            <button type="submit" style="background-color:#b3a0a2; border-color: #b3a0a2;" class="btn btn-primary col-xs-12"> INGRESAR </button>
        </div>
    </form>
</div>

<div class="copyright"> <strong>Copyright &copy; {{ date('Y') }} <a style="color:#ffffff;" href="http://www.kanavant.com/" target="_blank">{{ config('app.copyright') }}Kanavant Techonologies</a></strong> All rights reserved. </div>

<script src="{{asset("assets/global/plugins/jquery.min.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/global/plugins/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
</body>

</html>

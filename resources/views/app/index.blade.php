<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <meta name="apple-mobile-web-app-title" content="Delivery Vargas">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="theme-color" content="#ffff" />


  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href=" {{asset("assets/css/style.css") }} ">
  <link rel="stylesheet" href="{{ asset('assets/css/login/style.css') }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                                      
  <link rel="apple-touch-icon" href=" {{ asset("assets/storage/icons/apple-touch-icon.png") }} ">
  <link rel="apple-touch-icon-precomposed" href=" {{ asset("assets/storage/icons/apple-touch-icon.png") }} ">
  <link rel="apple-touch-icon-precomposed apple-touch-icon" href=" {{ asset("assets/storage/icons/apple-touch-icon.png") }} ">

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJQ58JnvpmUStRpQFABxBr1I0gxoH2j4g&libraries=places"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <title>Delivery Vargas</title>
</head>

<body class="hide-content">
  @include("app.loader.loader")
  
  @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
  @endif 
  
  <div class="container container-index">
    <div id="card_sesion" class="card card-sesion">
        <img src="{{ asset('assets/storage/logos/deliveryvargas.png') }}" class="brand-login" alt="logo">
        <div>
            <p class="label-option-1">Iniciar Sesión</p>
        </div>
        <form action=" {{ route('app.login') }} " method='POST' class='form-index'>
            @csrf
            <div class="col-md-12 form-index-child">
                <input class="input-option-1" type="email" id="email" name="email" placeholder="E-mail">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    
                @enderror
            </div>

            <div class="col-md-12 form-index-child">
                <input class="input-option-1" type="password" id="password" name="password" placeholder="Contraseña">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-12 form-index-child">
                <button type="submit" id="log_in" name="log_in" class="button-option-1 m-2">
                    <i class="fas fa-sign-in-alt fa-2x m-2"></i>
                </button>
            </div>

        </form>

        <div class="col-md-12 form-index-child">
            <a href="{{route('google.redirect')}}" class="button-google">
                <i class="fa-brands fa-google"></i> Continuar Con Google
            </a>
        </div>

        <div class="col-md-12 form-index-child">
            <button id="installButton" hidden class="install-button">Instalar App</button>
        </div>

        <div class="col-md-12 form-index-child">
            <a href=" {{route('app.register')}} " id="sing_up_option" class="anchor-option-1">Registrarse</a>
        </div>

        <div class="col-md-12 form-index-child">
            <a href=" {{route('reset.password.index')}} " class="reset-pass anchor-option-1">Recuperar
                Contraseña</a>
        </div>

    </div>
</div>

<div class="div-water-mark">
    <img class='water-mark' src=" {{ asset('assets/storage/logos/suarezresuelve.png') }} " alt="water-mark">
</div>

   <script src="{{ asset("assets/js/loader.js") }} "></script>
   <script src="{{ asset('assets/js/install.js') }}"></script>
</body>
</html>


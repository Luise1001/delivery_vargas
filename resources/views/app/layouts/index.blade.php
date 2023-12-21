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
  @yield("meta")


  <link rel="shortcut icon" href=" {{asset('favicon.ico') }}" type="image/x-icon">
  <link rel="stylesheet" href=" {{asset("assets/css/menu/style.css") }} ">
  <link rel="stylesheet" href=" {{asset("assets/css/style.css") }} ">
  @yield("styles")

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                                      
  <link rel="apple-touch-icon" href=" {{ asset("assets/storage/icons/apple-touch-icon.png") }} ">
  <link rel="apple-touch-icon-precomposed" href=" {{ asset("assets/storage/icons/apple-touch-icon.png") }} ">
  <link rel="apple-touch-icon-precomposed apple-touch-icon" href=" {{ asset("assets/storage/icons/apple-touch-icon.png") }} ">

  @yield("scripts")
  <script src="{{asset('assets/js/readImg.js')}}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJQ58JnvpmUStRpQFABxBr1I0gxoH2j4g&libraries=places"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <title>Delivery Vargas</title>
</head>

<body class="hide-content">
  @include("app.loader.loader")
  @include("app.layouts.menu.menu")
  
  @yield("messages")
  
  @yield("content")

   <script src="{{ asset("assets/js/loader.js") }} "></script>
  @yield("javascripts")
</body>
</html>
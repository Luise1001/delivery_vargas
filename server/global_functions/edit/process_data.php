<?php

function getDistance($addressFrom, $addressTo)
{
    $formattedAddrFrom = str_replace(' ', '+', $addressFrom);
    $formattedAddrTo = str_replace(' ', '+', $addressTo);


    $geocodeFrom = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $formattedAddrFrom . '&sensor=false&key=AIzaSyBJQ58JnvpmUStRpQFABxBr1I0gxoH2j4g');
    $outputFrom = json_decode($geocodeFrom);
    $geocodeTo = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $formattedAddrTo . '&sensor=false&key=AIzaSyBJQ58JnvpmUStRpQFABxBr1I0gxoH2j4g');
    $outputTo = json_decode($geocodeTo);



    $latitudeFrom = $outputFrom->results[0]->geometry->location->lat;
    $longitudeFrom = $outputFrom->results[0]->geometry->location->lng;
    $latitudeTo = $outputTo->results[0]->geometry->location->lat;
    $longitudeTo = $outputTo->results[0]->geometry->location->lng;


    $theta = $longitudeFrom - $longitudeTo;
    $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;


    return ($miles * 1.609344);
}

function ProcessLevel($AdminLevel)
{
   switch ($AdminLevel) {
    case '0':
        $folder = 'clientes';
        return $folder;
        break;
    case '1':
        $folder = 'administradores';
        return $folder;
        break;
    case '2':
        $folder = 'conductores';
        return $folder;
        break;
    case '3':
        $folder = 'comercios';
        return $folder;
        break;
    
    default:
        $folder = 'inicio';
        return $folder;
        break;
   }
}

function ProcessOrderStatus($nro_pedido)
{
    require '../conexion.php';

    $consulta_sql = "SELECT e.Creado, e.Recibido, e.Pagado, e.Retirar, e.Asignado, e.Aceptado, e.Enviado, e.Entregado, e.Anulado
    FROM estatus_pedidos AS e WHERE e.Nro_pedido=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($nro_pedido));
    $resultado = $preparar_sql->fetchAll();

    if ($resultado) {
        $estado = false;
        $progress = false;
        $enlaces = '';
       foreach($resultado as $order)
       {
          if($order['Creado'])
          {
            $estado = 'Creado';
            $progress = 12;
          }
          if($order['Recibido'])
          {
             $estado = 'Recibido';
             $progress = 24;
             $enlaces = 'hidden';
          }
          if($order['Pagado'])
          {
             $estado = 'Pagado';
             $progress = 36;
             $enlaces = 'hidden';
          }
          if($order['Retirar'])
          {
             $estado = 'Por Retirar';
             $progress = 48;
             $enlaces = 'hidden';
          }
          if($order['Asignado'])
          {
             $estado = 'Asignado';
             $progress = 60;
             $enlaces = 'hidden';
          }
          if($order['Aceptado'])
          {
            $estado = 'Aceptado';
            $progress = 72;
            $enlaces = 'hidden';
          }
          if($order['Enviado'])
          {
            $estado = 'Enviado';
            $progress = 84;
            $enlaces = 'hidden';
          }
          if($order['Entregado'])
          {
             $estado = 'Entregado';
             $progress = 100;
             $enlaces = 'hidden';
          }
          if($order['Anulado'])
          {
            $estado = 'Anulado';
            $progress = 100;
            $enlaces = 'hidden';
          }

          $respuesta = 
          [
             'estado'=> $estado,
             'progreso'=> $progress,
             'enlaces'=> $enlaces
          ];

          return $respuesta;
       }
    } else {
        return false;
    }
}

function ProcessWeight($peso)
{
    $unit = 0;

    if ($peso < 1) {
        $unit = 'gr.';
    }

    if ($peso >= 1) {
        $unit = 'kg.';
    }

    return $unit;
}

function ProcessBadge($existencia)
{
    $color = 'bg-success';

    if ($existencia <= 0) {
        $color = 'bg-danger';
    }

    return $color;
}

function MoveProduct($id_producto)
{
    require '../conexion.php';

    $movimiento = CurrentTime();

    $editsql = 'UPDATE productos SET Actualizado=?  WHERE Id=?';
    $editar_sentence = $pdo->prepare($editsql);
    $editar_sentence->execute(array($movimiento, $id_producto));

    return $movimiento;
}

function EmptyPage($contenido)
{
    $respuesta =
        "
    <div class='container-empty'>
    <div class='alert empty-page' role='alert'>
      $contenido
    </div>
    </div>
    ";

    return $respuesta;
}

function GeneratePassword()
{

    $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $combLen = strlen($comb) - 1;

    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $combLen);
        $pass[] = $comb[$n];
    }

    $clave = implode($pass);

    return $clave;
}


function EmailTemplate($titulo, $contenido)
{
    $mensaje =
        '
     <!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<style type="text/css">

body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
img { -ms-interpolation-mode: bicubic; }


img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
table { border-collapse: collapse !important; }
body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }


a[x-apple-data-detectors] 
{
    color: inherit !important;
    text-decoration: none !important;
    font-size: inherit !important;
    font-family: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
}


@media screen and (max-width: 480px) 
{
    .mobile-hide
     {
        display: none !important;
     }
    .mobile-center 
    {
        text-align: center !important;
    }
}


div[style*="margin: 16px 0;"] { margin: 0 !important; }
</style>
</head>
<body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">


<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">

        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
            <tr>
                <td valign="top" style="font-size:0; padding: 35px;" bgcolor="#fce944">

                <div style="display:inline-block;  min-width:100px; vertical-align:top; width:100%;">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                        <tr>
                            <td align="center" valign="top"  class="mobile-center">
                                <img src="https://deliveryvargaslg.com/img/arts/deliveryvargaslogo.png" width="200" height="200" alt="logo">
                                <p style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">a tiempo y seguro!</p>
                            </td>
                        </tr>
                    </table>
                </div>

                </td>
            </tr>
            <tr>
                <td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">

                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>
                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;
                         padding-top: 25px;">
             <br>
                            <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">
                                  ' . $titulo . '
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;
                         padding-top: 10px;">
                            <p style="font-size: 16px; font-weight: 400; line-height: 24px;">
                                ' . $contenido . '
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td align="left" style="padding-top: 20px; color: #777777;">
                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                Si Usted No Realizo esta Solicitud, por favor Comuníquese con los administradores del sistema de inmediato a traves 
                                de los números de teléfonos o las Redes Sociales.
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                </td>
            </tr>

            <tr>
                <td align="center" style="padding: 35px; background-color: #fce944;" bgcolor="#ffffff">

                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>
                        <td align="center">
                            <img src="https://deliveryvargaslg.com/img/arts/icons_01/logos/logo.png" width="80" height="80" style="display: block; border: 0px;"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px; 
                        padding: 5px 0 10px 0;">
                            <p style="font-size: 14px; font-weight: 800; line-height: 18px;">
                            © 2023 Copyright: Desarrollado por Luis Mayora
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;">
                            <p style="font-size: 14px; font-weight: 400; line-height: 20px; color: #777777;">
                            </p>
                        </td>
                    </tr>
                </table>

                </td>
            </tr>
        </table>
        </td>
    </tr>
</table>

</body>
</html>
     ';

    return $mensaje;
}

<?php

function nueva_tarifa()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $respuesta = 
  [
    'titulo' => 'Ups!',
    'cuerpo'=> 'warning',
    'accion'=> 'warning'
  ];

  if($AdminLevel === '1' || $AdminLevel === '4')
  {
     if(isset($_POST['de_km']) && isset($_POST['hasta_km']) && isset($_POST['servicio']) && isset($_POST['precio']))
     {
        $de_km = $_POST['de_km'];
        $hasta_km = $_POST['hasta_km'];
        $servicio = $_POST['servicio'];
        $precio = $_POST['precio'];
        $fecha = CurrentDate();

        $de_km = filter_var($de_km, FILTER_SANITIZE_STRING);
        $hasta_km = filter_var($hasta_km, FILTER_SANITIZE_STRING);
        $servicio = filter_var($servicio, FILTER_SANITIZE_STRING);
        $precio = filter_var($precio, FILTER_SANITIZE_STRING);
        $servicio = ucfirst($servicio);

        if($hasta_km && $servicio && $precio)
        {
          $insert_sql = 'INSERT INTO tarifas (Desde, Hasta, Servicio, Precio, Fecha) VALUES (?,?,?,?,?)';
          $sent = $pdo->prepare($insert_sql);
          if($sent->execute(array($de_km, $hasta_km, $servicio, $precio, $fecha)))
          {
            $respuesta = 
            [
              'titulo' => 'Operación Exitosa',
              'cuerpo'=> '',
              'accion'=> 'success'
            ];
          }
          else
          {
             $respuesta['cuerpo'] = 'Ocurrió Un Problema Durante la Operación';
          }
        }
        else
        {
           $respuesta['cuerpo'] = 'No se Pueden Guardar Datos Vacíos';
        }
     }
  }
  else
  {
     $respuesta['cuerpo'] = 'Usuario No Autorizado Para Esta Operación';
  }

  echo json_encode($respuesta);
}
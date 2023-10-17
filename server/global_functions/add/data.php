<?php

function NewRoute($nro_pedido, $salida, $destino, $url, $tiempo, $distancia)
{
    require '../conexion.php';
    $fecha = CurrentDate();

    $insert_sql = 'INSERT INTO routes (Nro_pedido, Salida, Destino, Url_ruta, Tiempo, Distancia, Fecha) VALUES (?,?,?,?,?,?,?)';
    $sent = $pdo->prepare($insert_sql);
    if($sent->execute(array($nro_pedido, $salida, $destino, $url, $tiempo, $distancia, $fecha)))
    {
       return true;
    }
    else
    {
       return false;
    }
}

function NewPaymentReference($id_cliente, $nro_pedido, $id_comercio, $referencia, $metodo_pago)
{
   require '../conexion.php';
   $fecha = CurrentDate();

   $insert_sql = 'INSERT INTO referencias_pagos (Id_cliente, Nro_pedido, Id_comercio, Referencia, Metodo_pago, Fecha) VALUES (?,?,?,?,?,?)';
   $sent = $pdo->prepare($insert_sql);
   
   if($sent->execute(array($id_cliente, $nro_pedido, $id_comercio, $referencia,$metodo_pago, $fecha)))
   {
      return true;
   }
   else
   {
     return false;
   }
}
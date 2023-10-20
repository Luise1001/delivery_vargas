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

function AddDataBank($tabla, $titular, $tipo_id, $documento, $id_banco, $tipo_cuenta, $cuenta, $id_comercio)
{
   require '../conexion.php';

   $tabla = filter_var($tabla, FILTER_UNSAFE_RAW);
   $titular = filter_var($titular, FILTER_UNSAFE_RAW);
   $tipo_id = filter_var($tipo_id, FILTER_UNSAFE_RAW);
   $documento = filter_var($documento, FILTER_UNSAFE_RAW);
   $id_banco = filter_var($id_banco, FILTER_UNSAFE_RAW);
   $tipo_cuenta = filter_var($tipo_cuenta, FILTER_UNSAFE_RAW);
   $cuenta = filter_var($cuenta, FILTER_UNSAFE_RAW);
   $fecha = CurrentDate();

   if($tabla != 'zelle')
   {
      $insert_sql = "INSERT INTO $tabla (Id_comercio, Tipo_id, Documento, Id_banco, $tipo_cuenta, Fecha) VALUES (?,?,?,?,?,?)";
      $sent = $pdo->prepare($insert_sql);
      if($sent->execute(array($id_comercio, $tipo_id, $documento, $id_banco, $cuenta, $fecha)))
      {
         return true;
      }
      else
      {
         return false;
      }
   }
   else
   {
      $insert_sql = "INSERT INTO $tabla (Id_comercio, Titular, Correo, Fecha) VALUES (?,?,?,?)";
      $sent = $pdo->prepare($insert_sql);
      if($sent->execute(array($id_comercio, $titular, $cuenta, $fecha)))
      {
         return true;
      }
      else
      {
         return false;
      }
   }

}
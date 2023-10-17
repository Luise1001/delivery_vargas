<?php

function UserID($correo)
{
    require '../conexion.php';

    $consulta_sql = "SELECT Id FROM usuarios WHERE Correo=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($correo));
    $resultado = $preparar_sql->fetchAll();
    
    if($resultado)
    {
      $id_usuario = $resultado[0]['Id'];

      return $id_usuario;
    }
    else
    {
      return false;
    }
}

function UserTableID($table, $id)
{
    require '../conexion.php';

    $consulta_sql = "SELECT Id_usuario FROM $table WHERE Id=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id));
    $resultado = $preparar_sql->fetchAll();
    
    if($resultado)
    {
      $id_usuario = $resultado[0]['Id_usuario'];

      return $id_usuario;
    }
    else
    {
      return false;
    }
}

function ClientID($cedula)
{
    require '../conexion.php';

    $consulta_sql = "SELECT Id FROM clientes WHERE Cedula=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($cedula));
    $resultado = $preparar_sql->fetchAll();
    
    if($resultado)
    {
      $id_usuario = $resultado[0]['Id'];

      return $id_usuario;
    }
    else
    {
      return false;
    }
}

function ComercioID($rif)
{
    require '../conexion.php';

    $consulta_sql = "SELECT Id FROM comercios WHERE Rif=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($rif));
    $resultado = $preparar_sql->fetchAll();
    
    if($resultado)
    {
      $id_usuario = $resultado[0]['Id'];

      return $id_usuario;
    }
    else
    {
      return false;
    }
}

function DriverID($cedula)
{
    require '../conexion.php';

    $consulta_sql = "SELECT Id FROM conductores WHERE Cedula=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($cedula));
    $resultado = $preparar_sql->fetchAll();
    
    if($resultado)
    {
      $id_conductor = $resultado[0]['Id'];

      return $id_conductor;
    }
    else
    {
      return false;
    }
}

function FirebaseID($UserID)
{
  require '../conexion.php';

  $consulta_sql = "SELECT Id FROM firebase_users WHERE Id_usuario=?";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute(array($UserID));
  $resultado = $preparar_sql->fetchAll();

  if($resultado)
  {
    $firebase_id = $resultado[0]['Id'];

    return $firebase_id;
  }
  else
  {
    return false;
  }
  
}

function LocationID($UserID)
{
  require '../conexion.php';

  $consulta_sql = "SELECT Id FROM locations WHERE Id_usuario=?";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute(array($UserID));
  $resultado = $preparar_sql->fetchAll();

  if($resultado)
  {
    $location_id = $resultado[0]['Id'];
    return $location_id;
  }
  else
  {
    return false;
  }

}

function StaticLocationID($UserID)
{
  require '../conexion.php';

  $consulta_sql = "SELECT Id FROM static_locations WHERE Id_usuario=?";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute(array($UserID));
  $resultado = $preparar_sql->fetchAll();

  if($resultado)
  {
    $location_id = $resultado[0]['Id'];
    return $location_id;
  }
  else
  {
    return false;
  }
  
}

function MonedaID($moneda)
{
  require '../conexion.php';

  $consulta_sql = "SELECT Id FROM monedas WHERE Moneda=?";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute(array($moneda));
  $resultado = $preparar_sql->fetchAll();

  if($resultado)
  {
    $id_moneda = $resultado[0]['Id'];

    return $id_moneda;
  }
  else
  {
    return false;
  }
}

function CodeID($codigo, $id_comercio)
{
  require '../conexion.php';

  $consulta_sql = "SELECT Id FROM productos WHERE Codigo=? AND Id_comercio=?";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute(array($codigo, $id_comercio));
  $resultado = $preparar_sql->fetchAll();

  if($resultado)
  {
    return true;
  }
  else
  {
    return false;
  }
}

function LastProductAdded($id_comercio)
{
  require '../conexion.php';

  $consulta_sql = "SELECT Id FROM productos WHERE Id_comercio=? ORDER BY Id DESC LIMIT 1";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute(array($id_comercio));
  $resultado = $preparar_sql->fetchAll();

  if($resultado)
  {
    $id = $resultado[0]['Id'];
    return $id;
  }
  else
  {
    return false;
  }
}

function LastPaymentAdded($id_comercio)
{
  require '../conexion.php';

  $sql = "SELECT Id FROM referencias_pagos WHERE Id_comercio=?  ORDER BY Id DESC LIMIT 1";
  $sql_prepare = $pdo->prepare($sql);
  $sql_prepare->execute(array($id_comercio));
  $resultado = $sql_prepare->fetchAll();

  if($resultado)
  {
    $id_pago = $resultado[0]['Id'];

    return $id_pago;
  }
  else
  {
    $id_pago = 0;

    return $id_pago;
  }
}

function RouteID($nro_pedido)
{
  require '../conexion.php';

  $sql = "SELECT Id FROM routes WHERE Nro_pedido=?";
  $sql_prepare = $pdo->prepare($sql);
  $sql_prepare->execute(array($nro_pedido));
  $resultado = $sql_prepare->fetchAll();

  if($resultado)
  {
    $id = $resultado[0]['Id'];

    return $id;
  }
  else
  {
    return false;
  }
}

function DayID($dia)
{
  require '../conexion.php';

  $sql = "SELECT Id FROM dias WHERE Dia=?";
  $sql_prepare = $pdo->prepare($sql);
  $sql_prepare->execute(array($dia));
  $resultado = $sql_prepare->fetchAll();

  if($resultado)
  {
    $id = $resultado[0]['Id'];

    return $id;
  }
  else
  {
    return false;
  }
}
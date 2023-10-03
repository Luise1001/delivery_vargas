<?php

function UserID($correo)
{
    require 'conexion.php';

    $consulta_sql = "SELECT * FROM usuarios WHERE Correo=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($correo));
    $resultado = $preparar_sql->fetchAll();
    
    if($resultado)
    {
      $id_usuario = $resultado[0]['Id'];
    }
    else
    {
      return;
    }

    return $id_usuario;
}

function UserName($id)
{
    require 'conexion.php';

    $consulta_sql = "SELECT * FROM usuarios WHERE Id=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id));
    $resultado = $preparar_sql->fetchAll();
    
    if($resultado)
    {
      $user_name = $resultado[0]['User_name'];
    }
    else
    {
      return;
    }

    return $user_name;
}


function DriverID($cedula)
{
    require 'conexion.php';

    $consulta_sql = "SELECT * FROM conductores WHERE Cedula=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($cedula));
    $resultado = $preparar_sql->fetchAll();
    
    if($resultado)
    {
      $id_conductor = $resultado[0]['Id'];
    }
    else
    {
      return;
    }


    return $id_conductor;
}

function ClientID($cedula)
{
    require 'conexion.php';

    $consulta_sql = "SELECT * FROM clientes WHERE Cedula=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($cedula));
    $resultado = $preparar_sql->fetchAll();
    
    if($resultado)
    {
      $id_cliente = $resultado[0]['Id'];
    }
    else 
    {
      return;
    }
    
    return $id_cliente;
}

function ComercioID($rif)
{
    require 'conexion.php';

    $consulta_sql = "SELECT * FROM comercios WHERE Rif=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($rif));
    $resultado = $preparar_sql->fetchAll();
    
    if($resultado)
    {
      $id_comercio = $resultado[0]['Id'];
    }
    else 
    {
      return;
    }
    
    return $id_comercio;
}

function FirebaseID($id)
{
  require 'conexion.php';

  $consulta_sql = "SELECT * FROM firebase_users WHERE Id_usuario=?";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute(array($id));
  $resultado = $preparar_sql->fetchAll();

  if($resultado)
  {
    $firebase_id = $resultado[0]['Id'];
  }
  else
  {
    return;
  }
  
  return $firebase_id;
}

function LocationID($id_usuario)
{
  require 'conexion.php';

  $consulta_sql = "SELECT * FROM locations WHERE Id_usuario=?";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute(array($id_usuario));
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

function StaticLocationID($id_usuario)
{
  require 'conexion.php';

  $consulta_sql = "SELECT * FROM static_locations WHERE Id_usuario=?";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute(array($id_usuario));
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
  require 'conexion.php';

  $consulta_sql = "SELECT * FROM monedas WHERE Moneda=?";
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
    return;
  }
}

function CodeID($codigo, $id_comercio)
{
  require 'conexion.php';

  $consulta_sql = "SELECT * FROM productos WHERE Codigo=? AND Id_comercio=?";
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
  require 'conexion.php';

  $consulta_sql = "SELECT * FROM productos WHERE Id_comercio=? ORDER BY Id DESC LIMIT 1";
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
  require 'conexion.php';

  $sql = "SELECT * FROM referencias_pagos WHERE Id_comercio=?  ORDER BY Id DESC LIMIT 1";
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
  require 'conexion.php';

  $sql = "SELECT * FROM routes WHERE Nro_pedido=?";
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
  require 'conexion.php';

  $sql = "SELECT * FROM dias WHERE Dia=?";
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
<?php

function AdminList()
{
  require 'conexion.php';

  $consulta_sql = "SELECT * FROM usuarios WHERE Nivel BETWEEN 1 AND 2 ORDER BY Nivel ASC";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute();
  $resultado = $preparar_sql->fetchAll();

  if($resultado)
  {
    return $resultado;
  }
  else
  {
    return false;
  }

}

function PrecioTarifa()
{
  require 'conexion.php';

  $consulta_sql = "SELECT * FROM tarifas WHERE KM=1";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute();
  $resultado = $preparar_sql->fetchAll();

  if($resultado)
  {
    $precio = $resultado[0]['Precio'];
    return $precio;
  }
  else
  {
    return false;
  }

}

function ClientList()
{
   require 'conexion.php';

   $consulta_sql = "SELECT * FROM clientes ORDER BY Fecha DESC";
   $preparar_sql = $pdo->prepare($consulta_sql);
   $preparar_sql->execute();
   $resultado = $preparar_sql->fetchAll();

   if($resultado)
   {
    return $resultado;
   }
   else
   {
     return false;
   }
}

function BusinessList()
{
   require 'conexion.php';

   $consulta_sql = "SELECT * FROM comercios ORDER BY Fecha DESC";
   $preparar_sql = $pdo->prepare($consulta_sql);
   $preparar_sql->execute();
   $resultado = $preparar_sql->fetchAll();

   if($resultado)
   {
    return $resultado;
   }
   else
   {
     return false;
   }
}

function DriverList()
{
  require 'conexion.php';

  $consulta_sql = "SELECT * FROM usuarios INNER JOIN conductores ON conductores.Id_usuario = usuarios.Id ORDER BY conductores.Id DESC";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute();
  $resultado = $preparar_sql->fetchAll();

  if($resultado)
  {
    return $resultado;
  }
  else
  {
    return false;
  }

}

function MotorcycleList()
{
  require 'conexion.php';

  $consulta_sql = "SELECT * FROM conductores INNER JOIN motos ON motos.Id_conductor = conductores.Id ORDER BY motos.Id DESC";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute();
  $resultado = $preparar_sql->fetchAll();

  if($resultado)
  {
    return $resultado;
  }
  else
  {
    return false;
  }

}

function BusinessCategories()
{
  require 'conexion.php';

  $consulta_sql = "SELECT * FROM categorias";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute();
  $resultado = $preparar_sql->fetchAll();

  if($resultado)
  {
    return $resultado;
  }
  else
  {
    return false;
  }
}


function OrderNumber()
{
  require 'conexion.php';

  $consulta_sql = "SELECT * FROM pedidos ORDER BY Nro_pedido DESC LIMIT 1";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute();
  $resultado = $preparar_sql->fetchAll();

  $nro = 1;

  if($resultado)
  {
    $nro = $resultado[0]['Nro_pedido'] + 1;
    return $nro;
  }
  else
  {
    return $nro;
  }

}

function ListaTarifas()
{
   require 'conexion.php';

   $consulta_sql = "SELECT * FROM tarifas";
   $preparar_sql = $pdo->prepare($consulta_sql);
   $preparar_sql->execute();
   $resultado = $preparar_sql->fetchAll();

   if($resultado)
   {
     return $resultado;
   }
   else
   {
     return false;
   }

}

function Days()
{
   require 'conexion.php';

   $consulta_sql = "SELECT * FROM dias ORDER BY Id ASC";
   $preparar_sql = $pdo->prepare($consulta_sql);
   $preparar_sql->execute();
   $resultado = $preparar_sql->fetchAll();

   if($resultado)
   {
     return $resultado;
   }
   else
   {
     return false;
   }
}


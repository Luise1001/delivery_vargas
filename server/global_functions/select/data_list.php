<?php

function NewProducts()
{
   require '../conexion.php';
   $consulta_sql = "SELECT p.Descripcion AS descripcion,  p.Codigo AS codigo, p.P_civa AS precio, p.Actualizado AS actualizado,
    p.Id_comercio AS comercio
    FROM productos AS p ORDER BY actualizado DESC LIMIT 6";
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

//revisar de aqui para abajo
function AdminList($AdminLevel)
{
  require '../conexion.php';

  $consulta_sql = "SELECT * FROM usuarios WHERE Nivel=? ORDER BY U_movimiento DESC";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute(array($AdminLevel));
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

function PrecioTarifa($distancia, $servicio)
{
  require '../conexion.php';

  $consulta_sql = "SELECT * FROM tarifas WHERE $distancia > Desde AND $distancia <= Hasta AND Servicio=?";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute(array($servicio));
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

function PrecioTarifaEspecial($categoria, $servicio)
{
  require '../conexion.php';

  $consulta_sql = "SELECT * FROM tarifas_especiales WHERE Categoria LIKE ? AND Servicio=?";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute(array($categoria, $servicio));
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
   require '../conexion.php';

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
   require '../conexion.php';

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
  require '../conexion.php';

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
  require '../conexion.php';

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
  require '../conexion.php';

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
  require '../conexion.php';

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
   require '../conexion.php';

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
   require '../conexion.php';

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


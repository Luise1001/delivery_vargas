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

function SearchProduct($id_producto)
{
   require '../conexion.php';

   $consulta_sql = "SELECT i.Id_producto, i.Existencia, p.Codigo, p.Descripcion, p.P_siva AS Psiva, p.P_civa AS Pciva, p.Foto,
   p.Alicuota, p.Peso, p.Id_comercio, i.Actualizado
    FROM productos AS p INNER JOIN inventario AS i ON p.Id = i.Id_producto
   WHERE p.Id = ?";
   $preparar_sql = $pdo->prepare($consulta_sql);
   $preparar_sql->execute(array($id_producto));
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

function SearchProducts($buscar)
{
   require '../conexion.php';

   $consulta_sql = "SELECT * FROM productos  WHERE Descripcion LIKE '%".$buscar."%' OR Codigo LIKE '%".$buscar."%' ";
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

function SearchProductsByBusiness($buscar, $id_comercio)
{
   require '../conexion.php';

   $consulta_sql = "SELECT * FROM productos  WHERE Id_comercio =? AND Descripcion LIKE '%".$buscar."%'";
   $preparar_sql = $pdo->prepare($consulta_sql);
   $preparar_sql->execute(array($id_comercio));
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

function AdminList($AdminLevel)
{
  require '../conexion.php';

  $consulta_sql = "SELECT * FROM usuarios WHERE Nivel=? ORDER BY Actualizado DESC";
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

function BusinessList()
{
   require '../conexion.php';

   $consulta_sql = "SELECT * FROM comercios ORDER BY Actualizado DESC";
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

function ClientList()
{
   require '../conexion.php';

   $consulta_sql = "SELECT * FROM clientes ORDER BY Actualizado DESC";
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

function UserList($nivel)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM usuarios WHERE Nivel=? ORDER BY Actualizado DESC";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($nivel));
    $resultado = $preparar_sql->fetchAll();

    if ($resultado) {
        return $resultado;
    } else {
        return false;
    }
}

function DriverList()
{
  require '../conexion.php';

  $consulta_sql = "SELECT * FROM conductores  ORDER BY Actualizado DESC";
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

  $consulta_sql = "SELECT m.*, c.Nombre, c.Apellido, c.Id_usuario, c.Disponible FROM motos AS m
  INNER JOIN conductores AS c  ON m.Id_conductor = c.Id ORDER BY m. Actualizado DESC";
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

function TypeIDList($letra)
{
   $array = array('V', 'E', 'P', 'J', 'G');
   $letras = array();

   foreach($array as $arr)
   {
      if($letra != $arr)
      {
        array_push($letras, $arr);
      }
    
   }

   return $letras;
   
}

//revisar de aqui para abajo



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


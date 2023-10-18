<?php

function BusinessByCategory($id_categoria)
{
  require '../conexion.php';

  $consulta_sql = "SELECT cat.Id_categoria AS Id_categoria, cat.Id_comercio AS Id_comercio, cat.Actualizado AS actualizado,
    com.Razon_social AS razon_social, com.Id, com.Id_usuario AS Id_usuario
   FROM categoria_comercios AS cat
   INNER JOIN comercios AS com ON Id_comercio = com.Id WHERE Id_categoria=? ORDER BY actualizado DESC ";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute(array($id_categoria));
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

function ListProducts($id_comercio)
{
  require '../conexion.php';

  $consulta_sql = "SELECT i.Id_comercio, i.Id_producto, i.Existencia, i.Actualizado,
  p.Codigo, p.Descripcion, p.P_civa
  FROM inventario AS i INNER JOIN productos AS p ON i.Id_producto = p.Id 
  WHERE p.Id_comercio =?";
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

function UserData($UserID)
{
    require '../conexion.php';

    $consulta_sql = "SELECT u.User_name, u.Correo, u.Actualizado FROM usuarios AS u WHERE Id=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($UserID));
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

function UserPassword($UserID, $AdminLevel)
{
    require '../conexion.php';

    $consulta_sql = "SELECT u.Pass AS Pass FROM usuarios AS u WHERE Id=? AND Nivel=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($UserID, $AdminLevel));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        $pass = $resultado[0]['Pass'];
        return $pass;
    }
    else
    {
        return false;
    }
}

function UserName($UserID)
{
    require '../conexion.php';

    $consulta_sql = "SELECT User_name FROM usuarios WHERE Id=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($UserID));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        $User_name = $resultado[0]['User_name'];
        return $User_name;
    }
    else
    {
        return false;
    }
}

function ClientData($UserID)
{
    require '../conexion.php';

    $consulta_sql = "SELECT c.Id, c.Tipo_id, c.Cedula, c.Nombre, c.Apellido, c.Telefono, c.Genero, c.Actualizado FROM clientes AS c 
    WHERE Id_usuario=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($UserID));
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

function MyCars($id_cliente)
{
    require '../conexion.php';

    $consulta_sql = "SELECT c.Id_comercio AS Id_comercio,
     com.Id, com.Razon_social AS Razon_social, com.Id_usuario AS Id_usuario, SUM(c.Cantidad) FROM carrito AS c 
     INNER JOIN comercios as com ON Id_comercio = com.Id  WHERE c.Id_cliente=?
     GROUP BY Id_comercio, com.Id, Id_cliente, Razon_social";
     $preparar_sql = $pdo->prepare($consulta_sql);
     $preparar_sql->execute(array($id_cliente));
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

function InsideMyCar($id_cliente, $id_comercio)
{
    require '../conexion.php';

    $consulta_sql = "SELECT c.Id_cliente AS Id_cliente, c.Id_producto AS Id_producto, c.Id_comercio AS Id_comercio,
     c.Cantidad AS Cantidad, c.Actualizado AS Actualizado,
     p.Codigo AS Codigo, p.Descripcion AS Descripcion, p.P_siva AS Psiva, p.p_civa AS Pciva, p.Alicuota AS Iva, p.Peso AS Peso,
     p.Id_comercio AS Id_comercio,
     com.Id AS Id_comercio, com. Razon_social AS Razon_social FROM carrito AS c INNER JOIN productos AS p ON c.Id_producto = p.Id 
     INNER JOIN comercios as com ON c.Id_comercio = com.Id  WHERE Id_cliente=? AND c.Id_comercio =? ORDER BY Actualizado DESC";
     $preparar_sql = $pdo->prepare($consulta_sql);
     $preparar_sql->execute(array($id_cliente, $id_comercio));
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

function MyGlobalCar($id_cliente)
{
    require '../conexion.php';

    $consulta_sql = "SELECT Cantidad FROM carrito WHERE Id_cliente=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_cliente));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        $cantidad = 0;
        foreach($resultado as $dato)
        {
            $cantidad += $dato['Cantidad'];
        }

        return $cantidad;
    }
    else
    {
    
        return false;
    }
}

function MyOrders($column, $id)
{
    require '../conexion.php';

      $consulta_sql = "SELECT 
      pm.Nro_pedido AS Nro_pedido, pm.Subtotal AS Subtotal, pm.Iva AS Iva, pm.Total AS Total, pm.Id_comercio AS Id_comercio, 
      pm.Fecha AS Fecha, pm.Id_cliente AS Id_cliente, pm.Metodo_pago AS Metodo_pago,
      cl.Nombre AS Nombre_cliente, cl.Apellido AS Apellido_cliente, cl.Telefono AS Telefono_cliente, cl.Id_usuario AS Usuario_cliente,
      com.Razon_social AS Razon_social, com.Telefono AS Telefono_comercio, com.Id_usuario AS Usuario_comercio,
      es.Creado AS Creado, es.Recibido AS Recibido, es.Pagado AS Pagado, es.Retirar AS Retirar, es.Asignado AS Asignado, 
      es.Aceptado AS Aceptado, es.Enviado AS Enviado, es.Entregado AS Entregado, es.Anulado AS Anulado, es.Actualizado
      FROM pedidos_monto AS pm
      INNER JOIN clientes AS cl ON pm.Id_cliente = cl.Id
      INNER JOIN comercios AS com ON pm.Id_comercio = com.Id
      INNER JOIN estatus_pedidos AS es ON pm.Nro_pedido = es.Nro_pedido   
      WHERE pm.$column =? ORDER BY es.Actualizado DESC";
      $preparar_sql = $pdo->prepare($consulta_sql);
      $preparar_sql->execute(array($id));
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

function OrderDetail($nro_pedido)
{
    require '../conexion.php';

    $consulta_sql = "SELECT 
    pm.*,
    pd.*,
    pr.*,
    com.Razon_social AS Razon_social, com.Telefono AS Telefono_comercio, com.Id_usuario AS Usuario_comercio,
    cl.Nombre AS Nombre_cliente, cl.Apellido AS Apellido_cliente, cl.Telefono AS Telefono_cliente, cl.Id_usuario AS Usuario_cliente
    FROM pedidos_monto AS pm
    INNER JOIN pedidos AS pd ON pm.Nro_pedido = pd.Nro_pedido
    INNER JOIN comercios AS com ON pm.Id_comercio = com.Id
    INNER JOIN productos AS pr ON pd.Id_producto = pr.Id
    INNER JOIN clientes AS cl ON pm.Id_cliente = cl.Id
    WHERE pm.Nro_pedido=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($nro_pedido));
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

function MyStaticLocations($UserID)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM static_locations WHERE Id_usuario=? ORDER BY Actualizado DESC";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($UserID));
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

function MyCurrentLocation($UserID)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM locations WHERE Id_usuario=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($UserID));
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




function ClientExist($id_usuario)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM clientes WHERE Id_usuario=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_usuario));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        $id_cliente = $resultado[0]['Id'];
        return $id_cliente;
    }
    else
    {
        return false;
    }
}


function DriverData($id_conductor)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM conductores INNER JOIN motos ON motos.Id_conductor = conductores.Id WHERE conductores.Id=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_conductor));
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

function DriverStatus($id_usuario)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM conductores  WHERE Id_usuario=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_usuario));
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


function ComercioData($id_comercio)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM comercios WHERE Id=?";
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

function UserEmail($id_usuario)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM usuarios WHERE Id=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_usuario));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        $email = $resultado[0]['Correo'];
        return $email;
    }
    else
    {
        return false;
    }
}

function StockProducts($id_producto)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM inventario WHERE Id_producto=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_producto));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        $cantidad = $resultado[0]['Existencia'];
        return $cantidad;
    }
    else
    {
        $cantidad = 0;
        return $cantidad;
    }

}

function StockCommerce($id_comercio)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM inventario WHERE Id_comercio=? AND Existencia > 0";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_comercio));
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

function Rating($id_producto)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM productos_favoritos WHERE Id_producto=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_producto));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        $cantidad = $resultado[0]['Votos'];
        return $cantidad;
    }
    else
    {
        $cantidad = 0;
        return $cantidad;
    }


}

function MyProductsCommerce($id_comercio)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM inventario INNER JOIN productos ON inventario.Id_producto = productos.Id
     WHERE inventario.Id_comercio=? ORDER BY Existencia DESC";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_comercio));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        return $resultado;
    }
    else
    {
        $resultado = 0;
        return $resultado;
    }

}

function ShowProduct($id_producto)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM productos WHERE Id=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_producto));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        return $resultado;
    }
    else
    {
        $resultado = 0;
        return $resultado;
    }
}

function ProductInCar($id_producto)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM carrito WHERE Id_producto=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_producto));
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

function ProductName($id_producto)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM productos WHERE Id=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_producto));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
    
        $producto = $resultado[0]['Descripcion'];
        return $producto;
    }
    else
    {
    
        return false;
    }
}



function SubtotalCar($id_cliente, $id_comercio)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM carrito INNER JOIN productos ON carrito.Id_producto = productos.Id WHERE carrito.Id_cliente=? AND carrito.Id_comercio=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_cliente, $id_comercio));
    $resultado = $preparar_sql->fetchAll();

    $subtotal = 0;

    if($resultado)
    {
 
        foreach($resultado as $dato)
        {
           $precio = $dato['P_siva'] * $dato['Cantidad'];

           $subtotal += $precio;
        }
        return $subtotal;
    }
    else
    {
    
        return false;
    }
}

function IvaCar($id_cliente, $id_comercio)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM carrito INNER JOIN productos ON carrito.Id_producto = productos.Id WHERE carrito.Id_cliente=? AND carrito.Id_comercio=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_cliente, $id_comercio));
    $resultado = $preparar_sql->fetchAll();

    $iva = 0;

    if($resultado)
    {
 
        foreach($resultado as $dato)
        {
           $precio = $dato['P_civa'] - $dato['P_siva'];
           $precio = $precio * $dato['Cantidad'];

           $iva += $precio;
        }
        return $iva;
    }
    else
    {
    
        return false;
    }
}

function TotalCar($id_cliente, $id_comercio)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM carrito INNER JOIN productos ON carrito.Id_producto = productos.Id WHERE carrito.Id_cliente=? AND carrito.Id_comercio=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_cliente, $id_comercio));
    $resultado = $preparar_sql->fetchAll();

    $total = 0;

    if($resultado)
    {
 
        foreach($resultado as $dato)
        {
           $precio = $dato['P_civa'] * $dato['Cantidad'];

           $total += $precio;
        }
        return $total;
    }
    else
    {
    
        return false;
    }
}





function OrderClientName($nro_pedido)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM pedidos INNER JOIN clientes ON pedidos.Id_cliente = clientes.Id WHERE pedidos.Nro_pedido=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($nro_pedido));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        $cliente = $resultado[0]['Nombre'].' '.$resultado[0]['Apellido'];

        return $cliente;
    }
    else
    {
        return false;
    }

}

function OrderStatus($nro_pedido)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM estatus_pedidos WHERE Nro_pedido=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($nro_pedido));
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


function StaticLocationName($id_location, $id_usuario)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM static_locations WHERE Id=? AND Id_usuario=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_location, $id_usuario));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        $name = $resultado[0]['Ubicacion'];
        return $name;
    }
    else
    {
        $consulta_sql = "SELECT * FROM locations WHERE Id=? AND Id_usuario=?";
        $preparar_sql = $pdo->prepare($consulta_sql);
        $preparar_sql->execute(array($id_location, $id_usuario));
        $resultado = $preparar_sql->fetchAll();

        if($resultado)
        {
            $name = $resultado[0]['Ubicacion'];
            return $name;
        }
        else
        {
            return false;
        }

    }
}



function CheckPersonalData($table, $id_usuario)
{
  require '../conexion.php';

  $consulta_sql = "SELECT * FROM $table WHERE Id_usuario=?";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute(array($id_usuario));
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

function OptionsCategories($id_comercio)
{
  require '../conexion.php';

  $consulta_sql = "SELECT * FROM categoria_comercios INNER JOIN categorias ON categoria_comercios.Id_categoria = categorias.Id WHERE Id_comercio=?";
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



function ListDelivery($asignado, $aceptado, $completado)
{
  require '../conexion.php';

  $consulta_sql = "SELECT envios.Id, envios.Nro_pedido, envios.Id_conductor, envios.Id_cliente, envios.Id_comercio, envios.Id_route, envios.Fecha, envios.U_movimiento,
  clientes.Nombre, clientes.Apellido, clientes.Telefono, comercios.Razon_social, routes.Salida, routes.Destino, routes.Url_ruta, routes.Tiempo, routes.Distancia
   FROM envios 
  INNER JOIN routes ON envios.Id_route = routes.Id
  INNER JOIN clientes ON envios.Id_cliente = clientes.Id
  INNER JOIN comercios ON envios.Id_comercio = comercios.Id
  WHERE envios.Asignado=? AND envios.Aceptado=? AND envios.Completado=?";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute(array($asignado, $aceptado, $completado));
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

function ListDeliveryByDriver($asignado, $aceptado, $completado, $id_conductor)
{
  require '../conexion.php';

  $consulta_sql = "SELECT envios.Id, envios.Nro_pedido, envios.Id_conductor, envios.Id_cliente, envios.Id_comercio, envios.Id_route, envios.Fecha, envios.U_movimiento,
  clientes.Nombre, clientes.Apellido, clientes.Telefono, comercios.Razon_social, routes.Salida, routes.Destino, routes.Url_ruta, routes.Tiempo, routes.Distancia
    FROM envios 
  INNER JOIN routes ON envios.Id_route = routes.Id
  INNER JOIN clientes ON envios.Id_cliente = clientes.Id
  INNER JOIN comercios ON envios.Id_comercio = comercios.Id
  WHERE envios.Asignado=? AND envios.Aceptado=? AND envios.Completado=? AND Id_conductor=?";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute(array($asignado, $aceptado, $completado, $id_conductor));
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

function RouteData($id_route)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM routes WHERE Id=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_route));
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

function DriverListForDelivery($estatus)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM conductores INNER JOIN motos ON motos.Id_conductor = conductores.Id 
    INNER JOIN usuarios ON conductores.Id_usuario = usuarios.Id INNER JOIN locations ON locations.Id_usuario = usuarios.Id WHERE Disponible=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($estatus));
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

   $consulta_sql = "SELECT * FROM usuarios WHERE Nivel=? ORDER BY Fecha DESC";
   $preparar_sql = $pdo->prepare($consulta_sql);
   $preparar_sql->execute(array($nivel));
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

function MySchedule($id_comercio)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM horario INNER JOIN dias ON horario.Id_dia = dias.Id WHERE Id_comercio=? ORDER BY Id_dia ASC";
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

function UserStatus($id_usuario, $nivel)
{
    require '../conexion.php';
    $tabla = '';
    $estatus = '';
 
    if($nivel === '2')
    {
      $tabla = 'conductores';
    }
    if($nivel === '3')
    {
      $tabla = 'comercios';
    }

    if($tabla)
    { 
      $consulta_sql = "SELECT * FROM $tabla WHERE Id_usuario=?";
      $preparar_sql = $pdo->prepare($consulta_sql);
      $preparar_sql->execute(array($id_usuario));
      $resultado = $preparar_sql->fetchAll();

      if($resultado)
      {
        $estado = $resultado[0]['Disponible'];
        
        if(!$estado)
        {
          $estatus = 'checked';
        }
  
      }
    }

    return $estatus;
}

function ComercioDisponible($id_comercio)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM comercios WHERE Id=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_comercio));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        return $resultado[0]['Disponible'];
    }
    else
    {
        return;
    }

}

function ComercioDisponiblePorFecha($id_comercio, $dia, $hora)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM horario WHERE Id_comercio=? AND Id_dia=? AND ? BETWEEN Abrir AND Cerrar";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_comercio, $dia, $hora));
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


function VerifyPassword($id_usuario, $clave)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM usuarios WHERE Id=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_usuario));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        $pass = $resultado[0]['Pass'];

        if(password_verify($clave, $pass))
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
        return false;
    }
}

function ShowCode($correo)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM codigos_enviados WHERE correo=? ORDER BY U_movimiento DESC";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($correo));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        $codigo = $resultado[0]['Codigo'];

        return $codigo;
    }
    else
    {
        return false;
    }
}

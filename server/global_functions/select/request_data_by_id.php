<?php

function UserData($id_usuario)
{
    require 'conexion.php';

    $consulta_sql = "SELECT * FROM usuarios WHERE Id=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_usuario));
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

function UserPassword($id_usuario, $nivel)
{
    require 'conexion.php';

    $consulta_sql = "SELECT * FROM usuarios WHERE Id=? AND Nivel=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_usuario, $nivel));
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

function ClientData($id_cliente)
{
    require 'conexion.php';

    $consulta_sql = "SELECT * FROM clientes WHERE Id=?";
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

function ClientExist($id_usuario)
{
    require 'conexion.php';

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
    require 'conexion.php';

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
    require 'conexion.php';

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
    require 'conexion.php';

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
    require 'conexion.php';

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
    require 'conexion.php';

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
    require 'conexion.php';

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
    require 'conexion.php';

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
    require 'conexion.php';

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
    require 'conexion.php';

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
    require 'conexion.php';

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
    require 'conexion.php';

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

function MyGlobalCar($id_cliente, $id_comercio)
{
    require 'conexion.php';

    $consulta_sql = "SELECT Cantidad FROM carrito WHERE Id_cliente=? AND Id_comercio=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_cliente, $id_comercio));
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

function InsideMyCar($id_cliente, $id_comercio)
{
    require 'conexion.php';

    $consulta_sql = "SELECT * FROM carrito INNER JOIN productos ON carrito.Id_producto = productos.Id WHERE carrito.Id_cliente=? AND carrito.Id_comercio=?";
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

function SubtotalCar($id_cliente, $id_comercio)
{
    require 'conexion.php';

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
    require 'conexion.php';

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
    require 'conexion.php';

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

function MyOrders($id, $nivel)
{
    require 'conexion.php';
    $resultado = '';

   if(!$nivel)
   {
      $consulta_sql = "SELECT * FROM pedidos_monto INNER JOIN comercios ON pedidos_monto.Id_comercio = comercios.Id
      INNER JOIN clientes ON pedidos_monto.Id_cliente = clientes.Id INNER JOIN estatus_pedidos ON pedidos_monto.Nro_pedido = estatus_pedidos.Nro_pedido
      WHERE pedidos_monto.Id_cliente =? ORDER BY pedidos_monto.U_movimiento DESC";
      $preparar_sql = $pdo->prepare($consulta_sql);
      $preparar_sql->execute(array($id));
      $resultado = $preparar_sql->fetchAll();
   }

   if($nivel == '1')
   {
      $consulta_sql = "SELECT * FROM pedidos_monto INNER JOIN comercios ON pedidos_monto.Id_comercio = comercios.Id
      INNER JOIN clientes ON pedidos_monto.Id_cliente = clientes.Id INNER JOIN estatus_pedidos ON pedidos_monto.Nro_pedido = estatus_pedidos.Nro_pedido
      ORDER BY pedidos_monto.U_movimiento ASC";
      $preparar_sql = $pdo->prepare($consulta_sql);
      $preparar_sql->execute();
      $resultado = $preparar_sql->fetchAll();
   }

   if($nivel == '3')
   {
     $consulta_sql = "SELECT * FROM pedidos_monto INNER JOIN comercios ON pedidos_monto.Id_comercio = comercios.Id
     INNER JOIN clientes ON pedidos_monto.Id_cliente = clientes.Id INNER JOIN estatus_pedidos ON pedidos_monto.Nro_pedido = estatus_pedidos.Nro_pedido
     WHERE pedidos_monto.Id_comercio=? ORDER BY pedidos_monto.U_movimiento DESC";
     $preparar_sql = $pdo->prepare($consulta_sql);
     $preparar_sql->execute(array($id));
     $resultado = $preparar_sql->fetchAll();
   }

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
    require 'conexion.php';

    $consulta_sql = "SELECT * FROM pedidos_monto INNER JOIN comercios ON pedidos_monto.Id_comercio = comercios.Id
    INNER JOIN pedidos ON pedidos_monto.Nro_pedido = pedidos.Nro_pedido INNER JOIN productos ON pedidos.Id_producto = productos.Id
    INNER JOIN clientes ON pedidos_monto.Id_cliente = clientes.Id
    LEFT JOIN metodos_pago ON pedidos.Metodo_pago = metodos_pago.Id WHERE pedidos_monto.Nro_pedido=?";
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

function OrderClientName($nro_pedido)
{
    require 'conexion.php';

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
    require 'conexion.php';

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

function MyStaticLocations($id_usuario)
{
    require 'conexion.php';

    $consulta_sql = "SELECT * FROM static_locations WHERE Id_usuario=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_usuario));
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

function MyCurrentLocation($id_usuario)
{
    require 'conexion.php';

    $consulta_sql = "SELECT * FROM locations WHERE Id_usuario=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_usuario));
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
    require 'conexion.php';

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
  require 'conexion.php';

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

function BusinessByCategories($id_categoria)
{
  require 'conexion.php';

  $consulta_sql = "SELECT * FROM categoria_comercios INNER JOIN comercios ON categoria_comercios.Id_comercio = comercios.Id WHERE Id_categoria=?";
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

function OptionsCategories($id_comercio)
{
  require 'conexion.php';

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

function ShowProducts($id_comercio)
{
  require 'conexion.php';

  $consulta_sql = "SELECT * FROM inventario INNER JOIN productos ON inventario.Id_producto = productos.Id 
  WHERE inventario.Id_comercio=? AND inventario.Existencia > 0";
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
  require 'conexion.php';

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
  require 'conexion.php';

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
    require 'conexion.php';

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
    require 'conexion.php';

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
   require 'conexion.php';

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
    require 'conexion.php';

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
    require 'conexion.php';
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
    require 'conexion.php';

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
    require 'conexion.php';

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
    require 'conexion.php';

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
    require 'conexion.php';

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

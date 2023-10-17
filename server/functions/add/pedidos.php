<?php

function nuevo_pedido()
{
    include_once '../conexion.php';

    if(isset($_POST['id_cliente']) && isset($_POST['id_comercio']))
    {
        $fecha = CurrentDate();
        $id_cliente = $_POST['id_cliente'];
        $id_comercio = $_POST['id_comercio'];
        $nro_pedido = OrderNumber();

        $InsideMyCar = InsideMyCar($id_cliente, $id_comercio);

        $subtotal = SubtotalCar($id_cliente, $id_comercio);
        $iva = IvaCar($id_cliente, $id_comercio);
        $total = TotalCar($id_cliente, $id_comercio);
        $creado = 1;

        if($InsideMyCar)
        {
            foreach($InsideMyCar as $products)
            {
               $id_producto = $products['Id_producto'];
               $cantidad = $products['Cantidad'];

               $insert_sql = 'INSERT INTO pedidos (Nro_pedido, Id_cliente, Id_producto, Id_comercio, Cantidad, Fecha) VALUES (?,?,?,?,?,?)';
               $sent = $pdo->prepare($insert_sql);
               $sent->execute(array($nro_pedido, $id_cliente, $id_producto, $id_comercio, $cantidad, $fecha));
            }

            $insert_sql = 'INSERT INTO pedidos_monto (Id_cliente, Nro_pedido, Subtotal, Iva, Total, Id_comercio, Fecha) VALUES (?,?,?,?,?,?,?)';
            $sent = $pdo->prepare($insert_sql);
            $sent->execute(array($id_cliente, $nro_pedido, $subtotal, $iva, $total, $id_comercio, $fecha));

            $insert_sql = 'INSERT INTO estatus_pedidos (Nro_pedido, Creado, Id_cliente, Id_comercio, Fecha) VALUES (?,?,?,?,?)';
            $sent = $pdo->prepare($insert_sql);
            $sent->execute(array($nro_pedido,$creado, $id_cliente, $id_comercio, $fecha));

            CleanCar($id_cliente, $id_comercio);
        }
    }

}

function confirmar_pedido()
{
    include_once '../conexion.php';
    $fecha = CurrentDate();
    $respuesta = 
    [
        'titulo'=> 'ups',
        'cuerpo' => '',
        'accion'=> 'warning'
    ];

    if(isset($_POST['nro_pedido']) && isset($_POST['id_cliente'])&& isset($_POST['id_comercio'])&& isset($_POST['metodo_pago'])
    && isset($_POST['salida'])&& isset($_POST['destino'])&& isset($_POST['ruta']))
    { 
        $nro_pedido = $_POST['nro_pedido'];
        $id_cliente = $_POST['id_cliente'];
        $id_comercio = $_POST['id_comercio'];
        $metodo_pago = $_POST['metodo_pago'];
        $salida = $_POST['salida'];
        $destino = $_POST['destino'];
        $ruta = $_POST['ruta'];
        $referencia = $_POST['referencia'];
        $tiempo = $_POST['tiempo'];
        $distancia = $_POST['distancia'];
        
        $nro_pedido = filter_var($nro_pedido, FILTER_UNSAFE_RAW);
        $id_cliente = filter_var($id_cliente, FILTER_UNSAFE_RAW);
        $id_comercio = filter_var($id_comercio, FILTER_UNSAFE_RAW);
        $metodo_pago = filter_var($metodo_pago, FILTER_UNSAFE_RAW);
        $salida = filter_var($salida, FILTER_UNSAFE_RAW);
        $destino = filter_var($destino, FILTER_UNSAFE_RAW);
        $ruta = filter_var($metodo_pago, FILTER_SANITIZE_URL);
        $referencia = filter_var($referencia, FILTER_UNSAFE_RAW);
        $tiempo = filter_var($tiempo, FILTER_UNSAFE_RAW);
        $distancia = filter_var($distancia, FILTER_UNSAFE_RAW);


        if($nro_pedido && $id_cliente && $id_comercio && $metodo_pago && $salida && $destino && $ruta)
        {
            if($referencia)
            {
                $NewPaymentReference = NewPaymentReference($id_cliente, $nro_pedido, $id_comercio, $referencia, $metodo_pago);

                if(!$NewPaymentReference)
                {
                    $respuesta = 
                    [
                        'titulo'=> 'ups',
                        'cuerpo' => 'Hay Un Problema Con Su Número de Referencia',
                        'accion'=> 'warning'
                    ];

                    echo json_encode($respuesta);

                    die();
                }

            }

            $NewRoute = NewRoute($nro_pedido, $salida, $destino, $ruta, $tiempo, $distancia);

            if(!$NewRoute)
            {
                $respuesta = 
                [
                    'titulo'=> 'ups',
                    'cuerpo' => 'Ocurrió Un Problema Generando La Ruta de Despacho.',
                    'accion'=> 'warning'
                ];

                echo json_encode($respuesta);

                die();
            }
            else
            {
                $id_ruta = RouteID($nro_pedido);
            }

            $Recepcion_pedido = Recepcion_pedido($id_cliente, $id_comercio, $nro_pedido, $id_ruta, $referencia, $metodo_pago);

            if($Recepcion_pedido)
            {
                $respuesta = 
                [
                    'titulo'=> 'Operación Exitosa',
                    'cuerpo' => '',
                    'accion'=> 'success'
                ];

                echo json_encode($respuesta);

            }
            else
            {
                $respuesta = 
                [
                    'titulo'=> 'ups',
                    'cuerpo' => 'No se Pudo Confirmar Su Pedido.',
                    'accion'=> 'warning'
                ];

                echo json_encode($respuesta);

                die();
            }

            
        }

    }
}

function Recepcion_pedido($id_cliente, $id_comercio, $nro_pedido, $id_ruta, $referencia, $metodo_pago)
{
    require '../conexion.php';
    $admin = $_SESSION['DLV']['admin'];
    $UserID = UserID($admin);
    $Usuario_comercio = UserTableID('comercios', $id_comercio);
    $Nivel_Comercio = AdminLevel($Usuario_comercio);
    $ClientData = ClientData($UserID);
    $nombre_cliente = $ClientData[0]['Nombre'];
    $apellido_cliente = $ClientData[0]['Apellido'];
    $actualizado = CurrentTime();

    if($referencia)
    {
        $recibido = 1;
        $pagado = 1;
    }
    else
    {
        $recibido = 1;
        $pagado = 0;
    }

    $editsql = 'UPDATE estatus_pedidos SET Recibido=?, Pagado=?, Id_ruta=?, Actualizado=? WHERE Nro_pedido=?';
    $editar_sentence = $pdo->prepare($editsql);
    if($editar_sentence->execute(array($recibido, $pagado, $id_ruta, $actualizado, $nro_pedido)))
    {
       
       $editsql = 'UPDATE pedidos_monto SET Metodo_pago=?, Actualizado=? WHERE Nro_pedido=?';
       $editar_sentence = $pdo->prepare($editsql);
      if( $editar_sentence->execute(array($metodo_pago, $actualizado, $nro_pedido)))
      {
        $key = requestKey();
        $tokens = getTokenIndividual($Usuario_comercio, $Nivel_Comercio);
        $title = 'Nuevo Pedido Generado';
        $message = "Cliente: $nombre_cliente $apellido_cliente";
        $url = 'templates/comercios/mis_pedidos';
        $push = push_notification($key, $tokens, $title, $message, $url);

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


function DescontarInventario($nro_pedido)
{
    require '../conexion.php';
    $movimiento = CurrentTime();

    $orderDetail = OrderDetail($nro_pedido);
    if($orderDetail)
    {
        foreach($orderDetail as $order)
        {
            $id_comercio = $order['Id_comercio'];
            $id_producto = $order['Id_producto'];
            $cantidad = $order['Cantidad'];
            $existencia = StockProducts($id_producto);
            $cantidad = $existencia - $cantidad;

            $editsql = 'UPDATE inventario SET Existencia =?, U_movimiento=? WHERE Id_comercio=? AND Id_producto=?';
            $editar_sentence = $pdo->prepare($editsql);
            $editar_sentence->execute(array($cantidad, $movimiento, $id_comercio, $id_producto));
        }
    }

    return;
}

function retirar_pedido()
{
    include_once '../conexion.php';

    if(isset($_POST['nro_pedido']))
    {
        $movimiento = CurrentTime();
        $nro_pedido = $_POST['nro_pedido'];
        $retirar = 1;
        $nivel = 1;
        $orderDetail = OrderDetail($nro_pedido);

        if($orderDetail)
        {
            foreach($orderDetail as $order)
            {
                $id_comercio = $order['Id_comercio'];
                $id_cliente = $order['Id_cliente'];
            }

        }

        $editsql = 'UPDATE estatus_pedidos SET Retirar=?, U_movimiento=? WHERE Nro_pedido=?';
        $editar_sentence = $pdo->prepare($editsql);
        $editar_sentence->execute(array($retirar, $movimiento, $nro_pedido));

        $inventario = DescontarInventario($nro_pedido);

        $envio = NuevoEnvio($nro_pedido, $id_cliente, $id_comercio, $nivel);

    }


}

function NuevoEnvio($nro_pedido, $id_cliente, $id_comercio, $nivel)
{
    require '../conexion.php';
    $fecha = CurrentDate();
    $id_route = RouteID($nro_pedido);

    $comercioData = ComercioData($id_comercio);

    if($comercioData)
    {
        foreach($comercioData as $datos)
        {
           $id_usuario = $datos['Id_usuario'];
           $razon_social = $datos['Razon_social'];
           $rif = $datos['Tipo_id'].'-'.$datos['Rif'];
           $telefono = $datos['Telefono'];
        }
    }


    $insert_sql = 'INSERT INTO envios (Nro_pedido, Id_cliente, Id_comercio, Id_route, Fecha) VALUES (?,?,?,?,?)';
    $sent = $pdo->prepare($insert_sql);
    $sent->execute(array($nro_pedido, $id_cliente, $id_comercio, $id_route, $fecha));

    $key = requestKey();
    $tokens = getTokens($nivel);
    $title = 'Nuevo Envió Generado';
    $message = "Cliente: $razon_social";
    $url = 'templates/administradores/lista_de_envios';
    $push = push_notification($key, $tokens, $title, $message, $url);

    return;

}
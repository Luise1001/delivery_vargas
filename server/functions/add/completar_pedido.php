<?php

function confirmar_pedido()
{
    include_once 'conexion.php';
    $fecha = CurrentDate();

    if(isset($_POST['metodo_pago']) && isset($_POST['nro_pedido']) && isset($_POST['direccion']) && isset($_POST['ruta']))
    { 
        $metodo_pago = $_POST['metodo_pago'];
        $nro_pedido = $_POST['nro_pedido'];
        $direccion = $_POST['direccion'];
        $referencia = 0;
        $ruta = $_POST['ruta'];

        if(isset($_POST['referencia']))
        {
            $referencia = $_POST['referencia'];
        }
        
        $orderDetail = OrderDetail($nro_pedido);

        if($orderDetail)
        {
            foreach($orderDetail as $order)
            {
                $id_cliente = $order['Id_cliente'];
                $id_comercio = $order['Id_comercio'];
            }
        }

        if($referencia)
        {
            nueva_referencia($id_cliente, $nro_pedido, $id_comercio, $referencia);
        }

        if($ruta)
        {
            $salida = trim($ruta['salida']);
            $destino = trim($ruta['destino']);
            $distancia = $ruta['distancia'];
            $tiempo = $ruta['tiempo'];
            $url_ruta = $ruta['url_ruta'];
            $paradas = 0;

            $newRoute = NewRoute($nro_pedido, $salida, $destino, $paradas, $url_ruta, $tiempo, $distancia, $fecha);
        }

         Recepcion_pedido($id_cliente, $id_comercio, $nro_pedido, $direccion, $referencia, $metodo_pago);
    
    }
}

function Recepcion_pedido($id_cliente, $id_comercio, $nro_pedido, $direccion, $referencia, $metodo_pago)
{
    require 'conexion.php';
    $movimiento = CurrentTime();
    $comercioData = ComercioData($id_comercio);
    $id_usuario_comercio = $comercioData[0]['Id_usuario'];
    $nivel = AdminLevel($id_usuario_comercio);
    $clientData = ClientData($id_cliente);
    $nombre_cliente = $clientData[0]['Nombre'].' '.$clientData[0]['Apellido'];

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

    $editsql = 'UPDATE estatus_pedidos SET Recibido=?, Pagado=?, Id_direccion=?, U_movimiento=? WHERE Nro_pedido=?';
    $editar_sentence = $pdo->prepare($editsql);
    $editar_sentence->execute(array($recibido, $pagado, $direccion, $movimiento, $nro_pedido));

    $editsql = 'UPDATE pedidos SET Metodo_pago=?, U_movimiento=? WHERE Nro_pedido=?';
    $editar_sentence = $pdo->prepare($editsql);
    $editar_sentence->execute(array($metodo_pago, $movimiento, $nro_pedido));

    $key = requestKey();
    $tokens = getTokenIndividual($id_usuario_comercio, $nivel);
    $title = 'Nuevo Pedido Generado';
    $message = "Cliente: $nombre_cliente";
    $url = 'templates/comercios/lista_de_pedidos';
    $push = push_notification($key, $tokens, $title, $message, $url);
}

function nueva_referencia($id_cliente, $nro_pedido, $id_comercio, $referencia)
{
    require 'conexion.php';
    $fecha = CurrentDate();

    if($id_cliente && $nro_pedido && $id_comercio && $referencia)
    {
        $insert_sql = 'INSERT INTO referencias_pagos (Id_cliente, Nro_pedido, Id_comercio, Referencia, Fecha) VALUES (?,?,?,?,?)';
        $sent = $pdo->prepare($insert_sql);
        $sent->execute(array($id_cliente, $nro_pedido, $id_comercio, $referencia, $fecha));
    }

    return;
}

function DescontarInventario($nro_pedido)
{
    require 'conexion.php';
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
    include_once 'conexion.php';

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
    require 'conexion.php';
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
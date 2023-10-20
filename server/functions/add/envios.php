<?php

function NuevoEnvio($nro_pedido, $id_cliente, $id_comercio, $nivel)
{
    require '../conexion.php';
    $admin = $_SESSION['DLV']['admin'];
    $UserID = UserID($admin);
    $AdminLevel = AdminLevel($UserID);
    $RouteID = RouteID($nro_pedido);
    $ComercioData = ComercioData($UserID);
    $fecha = CurrentDate();

    if($ComercioData)
    {
        foreach($ComercioData as $datos)
        {
           $razon_social = $datos['Razon_social'];
           $rif = $datos['Tipo_id'].'-'.$datos['Rif'];
           $telefono = $datos['Telefono'];
        }
    }


    $insert_sql = 'INSERT INTO envios (Nro_pedido, Id_cliente, Id_comercio, Id_route, Fecha) VALUES (?,?,?,?,?)';
    $sent = $pdo->prepare($insert_sql);
    if($sent->execute(array($nro_pedido, $id_cliente, $id_comercio, $RouteID, $fecha)))
    {
        $key = requestKey();
        $tokens = getTokens($nivel);
        $title = 'Nuevo Envió Generado';
        $message = "Cliente: $razon_social";
        $url = 'templates/administradores/mis_envios';
        $push = push_notification($key, $tokens, $title, $message, $url);
    
        return true;
    }
    else
    {
        return false;
    }
}
<?php

function NewRoute($nro_pedido, $salida, $destino, $paradas, $url, $tiempo, $distancia, $fecha)
{
    require '../conexion.php';

    $insert_sql = 'INSERT INTO routes (Nro_pedido, Salida, Destino, Paradas, Url_ruta, Tiempo, Distancia, Fecha) VALUES (?,?,?,?,?,?,?,?)';
    $sent = $pdo->prepare($insert_sql);
    $sent->execute(array($nro_pedido, $salida, $destino, $paradas, $url, $tiempo, $distancia, $fecha));

    return;
}
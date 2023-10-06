<?php

function CleanCar($id_cliente, $id_comercio)
{
    require '../conexion.php';

    $deletesql = 'DELETE FROM carrito WHERE Id_cliente=? AND Id_comercio=?';
    $sentenceDelete = $pdo->prepare($deletesql);
    $sentenceDelete-> execute(array($id_cliente, $id_comercio));

    return;
}
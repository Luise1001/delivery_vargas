<?php

function eliminar_cliente()
{
    include_once '../conexion.php';

    $id_cliente = $_POST['id_cliente'];

    $deletesql = 'DELETE FROM clientes WHERE Id=?';
    $sentenceDelete = $pdo->prepare($deletesql);
    $sentenceDelete-> execute(array($id_cliente));
}
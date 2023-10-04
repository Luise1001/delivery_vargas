<?php

function eliminar_tarifa()
{
    include_once '../conexion.php';

    $id_tarifa = $_POST['id_tarifa'];

    $deletesql = 'DELETE FROM tarifas WHERE Id=?';
    $sentenceDelete = $pdo->prepare($deletesql);
    $sentenceDelete-> execute(array($id_tarifa));
}
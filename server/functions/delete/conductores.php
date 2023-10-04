<?php

function eliminar_conductor()
{
    include_once '../conexion.php';

    $id_conductor = $_POST['id_conductor'];

    $deletesql = 'DELETE FROM conductores WHERE Id=?';
    $sentenceDelete = $pdo->prepare($deletesql);
    $sentenceDelete-> execute(array($id_conductor));
}
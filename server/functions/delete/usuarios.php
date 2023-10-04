<?php

function eliminar_admin()
{
    include_once '../conexion.php';

    $id_admin = $_POST['id_admin'];

    $deletesql = 'DELETE FROM usuarios WHERE Id=?';
    $sentenceDelete = $pdo->prepare($deletesql);
    $sentenceDelete-> execute(array($id_admin));
}
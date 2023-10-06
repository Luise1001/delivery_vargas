<?php

function elegir_categoria()
{
    include_once '../conexion.php';

    $admin = $_SESSION['DLV']['admin'];
    $id_usuario = UserID($admin);
    $rif_comercio = ComercioRif($id_usuario);
    $id_comercio = ComercioID($rif_comercio);
    $fecha = CurrentDate();

    $id_categoria = $_POST['id_categoria'];

    $id_categoria = filter_var($id_categoria, FILTER_SANITIZE_STRING);

      $checked = CheckCategory($id_categoria, $id_comercio);
  
    if($checked)
    {
        $deletesql = 'DELETE FROM categoria_comercios WHERE Id_categoria=? AND Id_comercio=?';
        $sentenceDelete = $pdo->prepare($deletesql);
        $sentenceDelete-> execute(array($id_categoria, $id_comercio));
    }
    else
    {
        $insert_sql = 'INSERT INTO categoria_comercios (Id_categoria, Id_comercio, Fecha) VALUES (?,?,?)';
        $sent = $pdo->prepare($insert_sql);
        $sent->execute(array($id_categoria, $id_comercio, $fecha ));
    }

}
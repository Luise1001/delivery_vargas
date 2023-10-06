<?php

function elegir_metodo_pago()
{
    include_once '../conexion.php';

    $admin = $_SESSION['DLV']['admin'];
    $id_usuario = UserID($admin);
    $rif_comercio = ComercioRif($id_usuario);
    $id_comercio = ComercioID($rif_comercio);
    $fecha = CurrentDate();

    $id_metodo = $_POST['id_metodo'];

    $id_metodo = filter_var($id_metodo, FILTER_SANITIZE_STRING);

      $checked = CheckPayment($id_metodo, $id_comercio);
  
    if($checked)
    {
        $deletesql = 'DELETE FROM metodos_pago_comercios WHERE Id_metodo=? AND Id_comercio=?';
        $sentenceDelete = $pdo->prepare($deletesql);
        $sentenceDelete-> execute(array($id_metodo, $id_comercio));
    }
    else
    {
        $insert_sql = 'INSERT INTO metodos_pago_comercios (Id_metodo, Id_comercio, Fecha) VALUES (?,?,?)';
        $sent = $pdo->prepare($insert_sql);
        $sent->execute(array($id_metodo, $id_comercio, $fecha ));
    }

}
<?php

function eliminar_direccion()
{
    include_once '../conexion.php';

    if(isset($_POST['id_direccion']))
    {
        $id_usuario = UserID($_SESSION['admin']);
        $id_direccion = $_POST['id_direccion'];


      $deletesql = 'DELETE FROM static_locations WHERE Id=? AND Id_usuario=?';
      $sentenceDelete = $pdo->prepare($deletesql);
      $sentenceDelete-> execute(array($id_direccion, $id_usuario));    
    }

}
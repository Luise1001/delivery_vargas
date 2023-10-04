<?php

function eliminar_producto()
{
    include_once '../conexion.php';

    if(isset($_POST['id_producto']) && isset($_POST['codigo']) && isset($_POST['rif']))
    {
        $rif = $_POST['rif'];
        $id_producto = $_POST['id_producto'];
        $codigo = $_POST['codigo'];
        $foto = "../img/$rif/productos/$codigo.jpg";

        $deletesql = 'DELETE FROM inventario WHERE Id_producto=?';
        $sentenceDelete = $pdo->prepare($deletesql);
        $sentenceDelete-> execute(array($id_producto));

       $deletesql = 'DELETE FROM productos WHERE Id=?';
       $sentenceDelete = $pdo->prepare($deletesql);
       $sentenceDelete-> execute(array($id_producto));


      
      DeletePhoto($foto);
    
    }

}
<?php

function agregar_al_carrito()
{
    require '../conexion.php';
    
    $fecha = CurrentDate();
    $movimiento = CurrentTime();
    $admin = $_SESSION['DLV']['admin'];
    $correo_cliente = $admin;
    $id_usuario_cliente = UserID($correo_cliente);
    $cedula = ClientCedula($id_usuario_cliente);


    $id_cliente = ClientID($cedula);
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $id_comercio = $_POST['id_comercio'];

    $id_producto = filter_var($id_producto, FILTER_SANITIZE_STRING);
    $cantidad = filter_var($cantidad, FILTER_SANITIZE_STRING);
    $id_comercio = filter_var($id_comercio, FILTER_SANITIZE_STRING);

    $producto_en_carrito = ProductInCar($id_producto);
    $nombre_producto = ProductName($id_producto);

    if($producto_en_carrito)
    {
       if($cantidad != 0)
       {
         $editsql = 'UPDATE carrito SET Cantidad=?, Actualizado=?  WHERE Id_cliente=? AND Id_producto=? AND Id_comercio=?';
         $editar_sentence = $pdo->prepare($editsql);
         $editar_sentence->execute(array($cantidad, $movimiento, $id_cliente, $id_producto, $id_comercio));

          MoveProduct($id_producto);

         echo "Se Modificó $nombre_producto en el Carrito.";
       }
       else
       {
         $deletesql = 'DELETE FROM carrito WHERE Id_cliente=? AND Id_producto=? AND Id_comercio=?';
         $sentenceDelete = $pdo->prepare($deletesql);
         $sentenceDelete-> execute(array($id_cliente, $id_producto, $id_comercio));

         MoveProduct($id_producto);

         echo "Se Eliminó $nombre_producto del Carrito.";
       }
    }
    else
    {
        if($id_cliente && $id_producto && $id_comercio && $cantidad)
        {
            $insert_sql = 'INSERT INTO carrito (Id_cliente, Id_producto, Id_comercio, Cantidad, Fecha) VALUES (?,?,?,?,?)';
            $sent = $pdo->prepare($insert_sql);
            $sent->execute(array($id_cliente, $id_producto, $id_comercio, $cantidad, $fecha));

            MoveProduct($id_producto);

            echo "Se Agregó $nombre_producto al Carrito.";
        }  
    }
}
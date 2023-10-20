<?php

function eliminar_producto()
{
    include_once '../conexion.php';
    $admin = $_SESSION['DLV']['admin'];
    $UserID = UserID($admin);
    $AdminLevel = AdminLevel($UserID);
    $respuesta =
    [
        'titulo' => 'Ups',
        'cuerpo'=> '',
        'accion'=> 'warning'
    ];

    if(isset($_POST['id_producto']) && isset($_POST['codigo']) && isset($_POST['id_comercio']))
    {
        $id_comercio = $_POST['id_comercio'];
        $id_producto = $_POST['id_producto'];
        $codigo = $_POST['codigo'];

        $foto = SearchProductPhoto($id_comercio, $codigo);

        $deletesql = 'DELETE FROM productos WHERE Id_producto=?';
        $sentenceDelete = $pdo->prepare($deletesql);
        if($sentenceDelete-> execute(array($id_producto)))
        {
            $deletesql = 'DELETE FROM inventario WHERE Id=?';
            $sentenceDelete = $pdo->prepare($deletesql);
           if( $sentenceDelete-> execute(array($id_producto)))
           {
              DeletePhoto($foto);
           }
           else
           {
              $respuesta['cuerpo'] = 'No Se Pudo Eliminar El Producto';
           }

           $respuesta =
           [
               'titulo' => 'Operación Exitosa',
               'cuerpo'=> '',
               'accion'=> 'success'
           ];

        }
        else
        {
           $respuesta['cuerpo'] = 'No Se Puede Eliminar El Producto, Porque Tiene Datos Relacionados';
        }
    
        echo json_encode($respuesta);
    }
}
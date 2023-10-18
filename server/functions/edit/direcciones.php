<?php

function editar_direccion()
{
    include_once '../conexion.php';
    $admin = $_SESSION['DLV']['admin'];
    $UserID = UserID($admin);
    $AdminLevel = AdminLevel($UserID);
    $respuesta = 
    [
        'titulo'=> 'Ups',
        'cuerpo'=> '',
        'accion'=> 'warning'
    ];

    if(isset($_POST['id_direccion']) && isset($_POST['nombre']))
    {
        $id_direccion = $_POST['id_direccion'];
        $nombre = $_POST['nombre'];
        $actualizado = CurrentTime();

        $id_direccion = filter_var($id_direccion, FILTER_SANITIZE_NUMBER_INT);
        $nombre = filter_var($nombre, FILTER_UNSAFE_RAW);
        $nombre = ucwords($nombre);

        $edit_sql = 'UPDATE static_locations SET Nombre=?, Actualizado=?  WHERE Id=?';
        $edit_sentence = $pdo->prepare($edit_sql);
        if($edit_sentence->execute(array($nombre, $actualizado, $id_direccion)))
        {
            $respuesta = 
            [
                'titulo'=> 'Operación Exitosa',
                'cuerpo'=> '',
                'accion'=> 'success'
            ];
        }
        else
        {
            $respuesta['cuerpo'] = 'No Pudimos Procesar Su Solicitud';
        }

        echo json_encode($respuesta);
    }
}
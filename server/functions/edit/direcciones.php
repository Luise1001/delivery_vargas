<?php

function editar_direccion()
{
    include_once '../conexion.php';

    if(isset($_POST['id_direccion']) && isset($_POST['nombre']))
    {
        $id_direccion = $_POST['id_direccion'];
        $nombre = $_POST['nombre'];
        $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);

        $nombre = ucwords($nombre);

        $edit_sql = 'UPDATE static_locations SET Nombre=?  WHERE Id=?';
        $edit_sentence = $pdo->prepare($edit_sql);
        $edit_sentence->execute(array($nombre, $id_direccion));
    }
}
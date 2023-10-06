<?php

function nuevo_conductor()
{
    include_once '../conexion.php';
    $fecha = CurrentDate();
    $admin = $_SESSION['DLV']['admin'];
    $usuario = UserID($admin);

    $nombre = $_POST['nombre'];
    $apellido =$_POST['apellido'];
    $tipo_id = $_POST['tipo_id'];
    $cedula = $_POST['cedula'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['usuario_conductor'];

    $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
    $apellido = filter_var($apellido, FILTER_SANITIZE_STRING);
    $tipo_id = filter_var($tipo_id, FILTER_SANITIZE_STRING);
    $cedula = filter_var($cedula, FILTER_SANITIZE_NUMBER_INT);
    $telefono = filter_var($telefono, FILTER_SANITIZE_NUMBER_INT);
    $direccion = filter_var($direccion, FILTER_SANITIZE_STRING);
    $correo = filter_var($correo, FILTER_SANITIZE_STRING);

    $id_usuario_conductor = UserID($correo);

    $nombre = ucwords($nombre);
    $apellido = ucwords($apellido);
    $direccion = ucwords($direccion);

    
    if($nombre && $apellido && $tipo_id && $cedula && $telefono && $direccion)
    {
      
        $insert_sql = 'INSERT INTO conductores (Id_usuario, Nombre, Apellido, Tipo_id, Cedula, Telefono, Direccion, Administrador, Fecha) VALUES (?,?,?,?,?,?,?,?,?)';
        $sent = $pdo->prepare($insert_sql);
        $sent->execute(array($id_usuario_conductor, $nombre, $apellido, $tipo_id, $cedula, $telefono, $direccion, $usuario, $fecha));

        
        $pdo = null;
        $sent = null;
    }
    else
    {
      return 'No se Pueden Registrar Datos Vacíos.';
    }

}
<?php

function nueva_moto()
{
    include_once '../conexion.php'; 
    $fecha = CurrentDate();
    $admin = $_SESSION['DLV']['admin'];
    $usuario = UserID($admin);

    $marca = $_POST['marca'];
    $modelo =$_POST['modelo'];
    $placa = $_POST['placa'];
    $year = $_POST['year'];
    $cedula = $_POST['cedula'];

    $marca = filter_var($marca, FILTER_SANITIZE_STRING);
    $modelo = filter_var($modelo, FILTER_SANITIZE_STRING);
    $placa = filter_var($placa, FILTER_SANITIZE_STRING);
    $year = filter_var($year, FILTER_SANITIZE_NUMBER_INT);
    $cedula = filter_var($cedula, FILTER_SANITIZE_NUMBER_INT);

    $marca = ucwords($marca);
    $modelo = ucwords($modelo);
    $placa = strtoupper($placa);


    if($marca && $modelo && $placa && $year && $cedula)
    {
        $id_conductor = DriverID($cedula);

        $insert_sql = 'INSERT INTO motos (Marca, Modelo, Placa, Year_moto, Id_conductor, Administrador, Fecha) VALUES (?,?,?,?,?,?,?)';
        $sent = $pdo->prepare($insert_sql);
        $sent->execute(array($marca, $modelo, $placa, $year, $id_conductor, $usuario, $fecha));

        
        $pdo = null;
        $sent = null;
    }
    else 
    {
       return 'No se Pueden Registrar Datos Vacíos.';
    }

}
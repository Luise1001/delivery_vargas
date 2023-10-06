<?php

function editar_moto()
{
    include_once '../conexion.php';
    if(isset($_POST['id_moto']) && isset($_POST['marca']) && isset($_POST['modelo']) && isset($_POST['placa']) && isset($_POST['year']) && isset($_POST['cedula']))
    {
        $id_moto = $_POST['id_moto'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $placa = $_POST['placa'];
        $year =  $_POST['year'];
        $cedula = $_POST['cedula'];
        $id_conductor = DriverID($cedula);
        $movimiento = CurrentTime();
    
        $id_moto = filter_var($id_moto, FILTER_SANITIZE_NUMBER_INT);
        $marca = filter_var($marca, FILTER_SANITIZE_STRING);
        $modelo = filter_var($modelo, FILTER_SANITIZE_STRING);
        $placa = filter_var($placa, FILTER_SANITIZE_STRING);
        $year = filter_var($year, FILTER_SANITIZE_NUMBER_INT);
        $cedula = filter_var($cedula, FILTER_SANITIZE_NUMBER_INT);
    
        $marca = ucwords($marca);
        $modelo = ucwords($modelo);
        $placa = strtoupper($placa);
    
        if($id_moto && $marca && $modelo && $placa && $year && $cedula)
        {
    
            $editsql = 'UPDATE motos SET Marca=?, Modelo=?, Placa=?, Year_moto=?,Id_conductor=?, U_movimiento=?   WHERE Id=?';
            $editar_sentence = $pdo->prepare($editsql);
            $editar_sentence->execute(array($marca, $modelo, $placa, $year,  $id_conductor, $movimiento, $id_moto));
        }
    }
}
<?php

function editar_moto()
{
    include_once '../conexion.php';
    $respuesta = 
    [
        'titulo'=> 'Ups',
        'cuerpo'=> 'No Pudimos Procesar Su Solicitud',
        'accion'=> 'warning'
    ];

    if(isset($_POST['id_moto']) && isset($_POST['marca']) && isset($_POST['modelo']) && isset($_POST['placa']) && isset($_POST['year']) 
    && isset($_POST['cedula']))
    {
        $id_moto = $_POST['id_moto'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $placa = $_POST['placa'];
        $year =  $_POST['year'];
        $cedula = $_POST['cedula'];
        $actualizado = CurrentTime();
    
        $id_moto = filter_var($id_moto, FILTER_UNSAFE_RAW);
        $marca = filter_var($marca, FILTER_UNSAFE_RAW);
        $modelo = filter_var($modelo, FILTER_UNSAFE_RAW);
        $placa = filter_var($placa, FILTER_UNSAFE_RAW);
        $year = filter_var($year, FILTER_UNSAFE_RAW);
        $cedula = filter_var($cedula, FILTER_UNSAFE_RAW);
        
        $id_conductor = DriverID($cedula);
        $marca = ucwords($marca);
        $modelo = ucwords($modelo);
        $placa = strtoupper($placa);
    
        if($id_moto && $marca && $modelo && $placa && $year && $id_conductor)
        {
    
            $editsql = 'UPDATE motos SET Marca=?, Modelo=?, Placa=?, Year_moto=?,Id_conductor=?, Actualizado=?   WHERE Id=?';
            $editar_sentence = $pdo->prepare($editsql);
            if($editar_sentence->execute(array($marca, $modelo, $placa, $year,  $id_conductor, $actualizado, $id_moto)))
            {
                $respuesta = 
                [
                    'titulo'=> 'Operación Exitosa',
                    'cuerpo'=> '',
                    'accion'=> 'success'
                ];
            }
        }

        echo json_encode($respuesta);
    }
}
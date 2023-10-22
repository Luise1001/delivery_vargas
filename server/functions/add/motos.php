<?php

function nueva_moto()
{
    include_once '../conexion.php'; 
    $fecha = CurrentDate();
    $admin = $_SESSION['DLV']['admin'];
    $UserID = UserID($admin);
    $respuesta =
    [
        'titulo' => 'ups!',
        'cuerpo' => 'No Se Pudo Procesar Su Solicitud',
        'accion'=> 'warning'
    ];

    if(isset($_POST['marca']) && isset($_POST['modelo']) && isset($_POST['placa']) && isset($_POST['year']) && isset($_POST['cedula']))
    {
        $marca = $_POST['marca'];
        $modelo =$_POST['modelo'];
        $placa = $_POST['placa'];
        $year = $_POST['year'];
        $cedula = $_POST['cedula'];
    
        $marca = filter_var($marca, FILTER_UNSAFE_RAW);
        $modelo = filter_var($modelo, FILTER_UNSAFE_RAW);
        $placa = filter_var($placa, FILTER_UNSAFE_RAW);
        $year = filter_var($year, FILTER_UNSAFE_RAW);
        $cedula = filter_var($cedula, FILTER_UNSAFE_RAW);
    
        $marca = ucwords($marca);
        $modelo = ucwords($modelo);
        $placa = strtoupper($placa);

        
       if($marca && $modelo && $placa && $year && $cedula)
       {
         $id_conductor = DriverID($cedula);

         $insert_sql = 'INSERT INTO motos (Marca, Modelo, Placa, Year_moto, Id_conductor, Administrador, Fecha) VALUES (?,?,?,?,?,?,?)';
         $sent = $pdo->prepare($insert_sql);
         if($sent->execute(array($marca, $modelo, $placa, $year, $id_conductor, $UserID, $fecha)))
         {
            $respuesta =
            [
                'titulo' => 'Operación Exitosa',
                'cuerpo' => '',
                'accion'=> 'success'
            ];
         }
       }

      echo json_encode($respuesta);
    }
}
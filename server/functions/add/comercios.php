<?php

function nuevo_comercio()
{
    include_once '../conexion.php';
    $admin = $_SESSION['DLV']['admin'];
    $UserID = UserID($admin);
    $AdminLevel = AdminLevel($UserID);
    $respuesta =
    [
        'titulo' => 'ups!',
        'cuerpo' => '',
        'accion'=> 'warning'
    ];

    if(isset($_POST['razon_social']) && isset($_POST['tipo_id']) && isset($_POST['rif']) && isset($_POST['telefono']))
    {
        $razon_social = $_POST['razon_social'];
        $tipo_id = $_POST['tipo_id'];
        $rif = $_POST['rif'];
        $telefono = $_POST['telefono'];
        $fecha = CurrentDate();

        $razon_social = filter_var($razon_social, FILTER_UNSAFE_RAW);
        $tipo_id = filter_var($tipo_id, FILTER_UNSAFE_RAW);
        $rif = filter_var($rif, FILTER_UNSAFE_RAW);
        $telefono = filter_var($telefono, FILTER_UNSAFE_RAW);

        $razon_social = ucwords($razon_social);
        
        if($razon_social && $tipo_id && $rif && $telefono)
        {
          $ComercioData = ComercioData($UserID);

          if(!$ComercioData)
          {
            $insert_sql = 'INSERT INTO comercios (Id_usuario, Razon_social, Tipo_id, Rif, Telefono, Fecha) VALUES (?,?,?,?,?,?)';
            $sent = $pdo->prepare($insert_sql);
            if($sent->execute(array($UserID, $razon_social, $tipo_id, $rif, $telefono, $fecha)))
            {
                $respuesta =
                [
                    'titulo' => 'Operación Exitosa',
                    'cuerpo' => '',
                    'accion'=> 'success'
                ]; 
            }
            else
            {
                $respuesta['cuerpo'] = 'Ocurrió Un Problema Durante La Operación';
            }
          }
          else
          {
              $actualizado = CurrentTime();
              $editar_comercio = editar_comercio($UserID, $razon_social, $tipo_id, $rif, $telefono, $actualizado);

              if($editar_comercio)
              {
                $respuesta =
                [
                    'titulo' => 'Operación Exitosa',
                    'cuerpo' => '',
                    'accion'=> 'success'
                ];
              }
              else
              { 
                 $respuesta['cuerpo'] = 'No se Pudo Procesar La Solicitud';
              }
          }
        }
        else
        {
            $respuesta['cuerpo'] = 'No se Pueden Guardar Campos Vacíos';
        }

        echo json_encode($respuesta);
    }
}
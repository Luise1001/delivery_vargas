<?php

function nuevo_cliente()
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

    if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['tipo_id']) && isset($_POST['cedula']) 
    && isset($_POST['telefono']) && isset($_POST['genero']))
    {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $tipo_id = $_POST['tipo_id'];
        $cedula = $_POST['cedula'];
        $telefono = $_POST['telefono'];
        $genero = $_POST['genero'];
        $fecha = CurrentDate();

        $nombre = filter_var($nombre, FILTER_UNSAFE_RAW);
        $apellido = filter_var($apellido, FILTER_UNSAFE_RAW);
        $tipo_id = filter_var($tipo_id, FILTER_UNSAFE_RAW);
        $cedula = filter_var($cedula, FILTER_UNSAFE_RAW);
        $telefono = filter_var($telefono, FILTER_UNSAFE_RAW);
        $genero = filter_var($genero, FILTER_UNSAFE_RAW);

        $nombre = ucwords($nombre);
        $apellido = ucwords($apellido);
        
        if($nombre && $apellido && $tipo_id && $cedula && $telefono && $genero)
        {
          $ClientData = ClientData($UserID);

          if(!$ClientData)
          {
            $insert_sql = 'INSERT INTO clientes (Id_usuario, Nombre, Apellido, Tipo_id, Cedula, Telefono, Genero, Fecha) VALUES (?,?,?,?,?,?,?,?)';
            $sent = $pdo->prepare($insert_sql);
            if($sent->execute(array($UserID, $nombre, $apellido, $tipo_id, $cedula, $telefono, $genero, $fecha)))
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
              $editar_cliente = editar_cliente($UserID, $nombre, $apellido, $tipo_id, $cedula, $telefono, $genero, $actualizado);

              if($editar_cliente)
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
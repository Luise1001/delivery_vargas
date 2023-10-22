<?php

function nuevo_conductor()
{
    include_once '../conexion.php';

    $admin = $_SESSION['DLV']['admin'];
    $UserID = UserID($admin);
    $respuesta =
    [
        'titulo' => 'ups!',
        'cuerpo' => 'No Se Pudo Procesar Su Solicitud',
        'accion'=> 'warning'
    ];

    if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['tipo_id']) && isset($_POST['cedula']) 
    && isset($_POST['telefono']) && isset($_POST['direccion']) && isset($_POST['correo']))
    {
      $nombre = $_POST['nombre'];
      $apellido =$_POST['apellido'];
      $tipo_id = $_POST['tipo_id'];
      $cedula = $_POST['cedula'];
      $telefono = $_POST['telefono'];
      $direccion = $_POST['direccion'];
      $correo = $_POST['correo'];
      $fecha = CurrentDate();

      $nombre = filter_var($nombre, FILTER_UNSAFE_RAW);
      $apellido = filter_var($apellido, FILTER_UNSAFE_RAW);
      $tipo_id = filter_var($tipo_id, FILTER_UNSAFE_RAW);
      $cedula = filter_var($cedula, FILTER_UNSAFE_RAW);
      $telefono = filter_var($telefono, FILTER_UNSAFE_RAW);
      $direccion = filter_var($direccion, FILTER_UNSAFE_RAW);
      $correo = filter_var($correo, FILTER_UNSAFE_RAW);

      $nombre = ucwords($nombre);
      $apellido = ucwords($apellido);
      $direccion = ucwords($direccion);

      $id_usuario = UserID($correo);

          
    if($nombre && $apellido && $tipo_id && $cedula && $telefono && $direccion)
    {
      
      $insert_sql = 'INSERT INTO conductores (Id_usuario, Nombre, Apellido, Tipo_id, Cedula, Telefono, Direccion, Administrador, Fecha) VALUES (?,?,?,?,?,?,?,?,?)';
      $sent = $pdo->prepare($insert_sql);
      if($sent->execute(array($id_usuario, $nombre, $apellido, $tipo_id, $cedula, $telefono, $direccion, $UserID, $fecha)))
      {
        $respuesta =
        [
            'titulo' => 'Operación Exitosa',
            'cuerpo' => '',
            'accion'=> 'success'
        ];
      }

    }
    else
    {
      $respuesta['cuerpo'] = 'No Se Pueden Guardar Campos Vacíos';
    }

       echo json_encode($respuesta);

    }
    
}
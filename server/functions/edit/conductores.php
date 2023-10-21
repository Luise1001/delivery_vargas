<?php
function editar_conductor()
{
    include_once '../conexion.php';
    $respuesta = 
    [
      'titulo'=> 'Ups',
      'cuerpo'=> 'No Pudimos Procesar Su Solicitud',
      'accion'=> 'warning'
    ];

    if(isset($_POST['id_conductor']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['tipo_id']) 
    && isset($_POST['cedula']) && isset($_POST['telefono']) && isset($_POST['direccion']))
    {
        $id_conductor = $_POST['id_conductor'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $tipo_id = $_POST['tipo_id'];
        $cedula = $_POST['cedula'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $actualizado = CurrentTime();
    
        $id_conductor = filter_var($id_conductor, FILTER_UNSAFE_RAW);
        $nombre = filter_var($nombre, FILTER_UNSAFE_RAW);
        $apellido = filter_var($apellido, FILTER_UNSAFE_RAW);
        $tipo_id = filter_var($tipo_id, FILTER_UNSAFE_RAW);
        $cedula = filter_var($cedula, FILTER_UNSAFE_RAW);
        $telefono = filter_var($telefono, FILTER_UNSAFE_RAW);
        $direccion = filter_var($direccion, FILTER_UNSAFE_RAW);
    
        $nombre = ucwords($nombre);
        $apellido = ucwords($apellido);
        $direccion = ucwords($direccion);
    
    
        if($id_conductor && $nombre && $apellido && $tipo_id && $cedula && $telefono && $direccion)
        {
         $editsql = 'UPDATE conductores SET Nombre=?, Apellido=?, Tipo_id=?, Cedula=?, Telefono=?, Direccion=?, Actualizado=?  WHERE Id=?';
         $editar_sentence = $pdo->prepare($editsql);
         if($editar_sentence->execute(array($nombre, $apellido, $tipo_id, $cedula, $telefono, $direccion, $actualizado, $id_conductor)))
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

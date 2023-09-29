<?php
function editar_conductor()
{
    include_once 'conexion.php';
    if(isset($_POST['id_conductor']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['tipo_id']) && isset($_POST['cedula']) && isset($_POST['telefono']) && isset($_POST['direccion']))
    {
        $id_conductor = $_POST['id_conductor'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $tipo_id = $_POST['tipo_id'];
        $cedula = $_POST['cedula'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $id_usuario = UserID($_POST['usuario']); 
        $movimiento = CurrentTime();
    
        $id_conductor = filter_var($id_conductor, FILTER_SANITIZE_NUMBER_INT);
        $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
        $apellido = filter_var($apellido, FILTER_SANITIZE_STRING);
        $tipo_id = filter_var($tipo_id, FILTER_SANITIZE_STRING);
        $cedula = filter_var($cedula, FILTER_SANITIZE_NUMBER_INT);
        $telefono = filter_var($telefono, FILTER_SANITIZE_NUMBER_INT);
        $direccion = filter_var($direccion, FILTER_SANITIZE_STRING);
        $usuario = filter_var($usuario, FILTER_SANITIZE_STRING);
    
        $nombre = ucwords($nombre);
        $apellido = ucwords($apellido);
        $direccion = ucwords($direccion);
    
    
        if($id_conductor && $nombre && $apellido && $tipo_id && $cedula && $telefono && $direccion)
        {
            $editsql = 'UPDATE conductores SET Id_usuario=?, Nombre=?, Apellido=?, Tipo_id=?, Cedula=?, Telefono=?, Direccion=?, U_movimiento=?  WHERE Id=?';
            $editar_sentence = $pdo->prepare($editsql);
            $editar_sentence->execute(array($id_usuario, $nombre, $apellido, $tipo_id, $cedula, $telefono, $direccion, $movimiento, $id_conductor));
        
        }
    }

}

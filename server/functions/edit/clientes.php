<?php

function editar_cliente()
{
    include_once '../conexion.php';
    $fecha = CurrentDate();

    if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['tipo_id']) && isset($_POST['cedula']) && isset($_POST['telefono']))
    {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $tipo_id = $_POST['tipo_id'];
        $cedula = $_POST['cedula'];
        $telefono = $_POST['telefono'];
        $movimiento = CurrentTime();
      
        $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
        $apellido = filter_var($apellido, FILTER_SANITIZE_STRING);
        $tipo_id = filter_var($tipo_id, FILTER_SANITIZE_STRING);
        $cedula = filter_var($cedula, FILTER_SANITIZE_STRING);
        $telefono = filter_var($telefono, FILTER_SANITIZE_STRING);
      
        $nombre = ucwords($nombre);
        $apellido = ucwords($apellido);
        
        $admin = $_SESSION['DLV']['admin'];
        $id_usuario = UserID($admin);
        $id_cliente = ClientExist($id_usuario);
      
        if($id_cliente)
        { 
            if($nombre && $apellido && $tipo_id && $cedula && $telefono)
            {
              $editsql = 'UPDATE clientes SET Nombre=?, Apellido=?, Tipo_id=?, Cedula=?, Telefono=?, U_movimiento=?   WHERE Id=?';
              $editar_sentence = $pdo->prepare($editsql);
              $editar_sentence->execute(array($nombre, $apellido, $tipo_id, $cedula, $telefono, $movimiento, $id_cliente));
              echo $id_cliente;
            }
        }
        else
        {
    
          if($id_usuario)
          {
            if($nombre && $apellido && $tipo_id && $cedula && $telefono)
            {
              $insert_sql = 'INSERT INTO clientes (Id_usuario, Tipo_id, Cedula, Nombre, Apellido, Telefono, Fecha ) VALUES (?,?,?,?,?,?,?)';
              $sent = $pdo->prepare($insert_sql);
              $sent->execute(array($id_usuario, $tipo_id, $cedula, $nombre, $apellido, $telefono, $fecha));
            }
             
          }
        }
    }

}
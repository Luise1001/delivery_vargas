<?php 

function DriverCedula($id)
{
    require 'conexion.php';

    $consulta_sql = "SELECT * FROM conductores WHERE Id_usuario=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id));
    $resultado = $preparar_sql->fetchAll();
    

    if($resultado)
    {
        $cedula = $resultado[0]['Cedula'];
    }
    else
    {
        return;
    }

    return $cedula;
}


function ClientCedula($id)
{
    require 'conexion.php';

    $consulta_sql = "SELECT * FROM clientes WHERE Id_usuario=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id));
    $resultado = $preparar_sql->fetchAll();
 
    if($resultado)
    {
        $cedula = $resultado[0]['Cedula'];
    }
    else
    {
        return;
    }

    return $cedula;
}

function ComercioRif($id)
{
    require 'conexion.php';

    $consulta_sql = "SELECT * FROM comercios WHERE Id_usuario=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        $rif = $resultado[0]['Rif'];
    }
    else
    {
        return;
    }

    return $rif;
}
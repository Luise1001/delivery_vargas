<?php 

function checkCategory($id_categoria, $id_comercio)
{
    require 'conexion.php';

    $consulta_sql = "SELECT * FROM categoria_comercios WHERE Id_categoria=? AND Id_comercio=?";
    $prepare_sql = $pdo->prepare($consulta_sql);
    $prepare_sql->execute(array($id_categoria, $id_comercio));
    $resultado = $prepare_sql->fetchAll();

    if($resultado)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function checkPayment($id_metodo, $id_comercio)
{
    require 'conexion.php';

    $consulta_sql = "SELECT * FROM metodos_pago_comercios WHERE Id_metodo=? AND Id_comercio=?";
    $prepare_sql = $pdo->prepare($consulta_sql);
    $prepare_sql->execute(array($id_metodo, $id_comercio));
    $resultado = $prepare_sql->fetchAll();

    if($resultado)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function checkSchedule($id_dia, $id_comercio)
{
    require 'conexion.php';

    $consulta_sql = "SELECT * FROM horario WHERE Id_dia=? AND Id_comercio=?";
    $prepare_sql = $pdo->prepare($consulta_sql);
    $prepare_sql->execute(array($id_dia, $id_comercio));
    $resultado = $prepare_sql->fetchAll();

    if($resultado)
    {
        return true;
    }
    else
    {
        return false;
    }
}

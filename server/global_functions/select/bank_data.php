<?php

function BankList()
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM bancos";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute();
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        return $resultado;
    }
    else
    {
        return false;
    }

}

function PaymentMethods()
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM metodos_pago";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute();
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        return $resultado;
    }
    else
    {
        return false;
    }
}

function OptionsPaymentMethods($id_comercio)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM metodos_pago_comercios INNER JOIN metodos_pago ON metodos_pago_comercios.Id_metodo = metodos_pago.Id WHERE Id_comercio=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_comercio));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        return $resultado;
    }
    else
    {
        return false;
    }
}

function PagoMovil($id_comercio)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM bancos INNER JOIN pago_movil ON pago_movil.Id_banco = bancos.Id WHERE Id_comercio=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_comercio));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        return $resultado;
    }
    else
    {
        return;
    }
}

function Transferencia($id_comercio)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM bancos INNER JOIN transferencia ON transferencia.Id_banco = bancos.Id WHERE Id_comercio=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_comercio));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        return $resultado;
    }
    else
    {
        return;
    }
}

function Zelle($id_comercio)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM zelle WHERE Id_comercio=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_comercio));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        return $resultado;
    }
    else
    {
        return;
    } 
}
<?php

function nuevos_datos_bancarios()
{
    include_once 'conexion.php';
    $id_usuario = UserID($_SESSION['admin']);
    $rif_comercio = ComercioRif($id_usuario);
    $id_comercio = ComercioID($rif_comercio);

    if(isset($_POST['banco']) && isset($_POST['letra']) && isset($_POST['rif']) && isset($_POST['telefono']))
    {
       $id_banco = $_POST['banco'];
       $tipo_id = $_POST['letra'];
       $rif =  $_POST['rif'];
       $telefono = $_POST['telefono'];

       $pago_movil = NuevoPagoMovil($id_comercio, $id_banco, $tipo_id, $rif, $telefono);
    }

    if(isset($_POST['banco']) && isset($_POST['letra']) && isset($_POST['rif']) && isset($_POST['cuenta']))
    {
        $id_banco = $_POST['banco'];
        $tipo_id = $_POST['letra'];
        $rif = $_POST['rif'];
        $cuenta = $_POST['cuenta'];
 
        $transferencia = NuevoTransferencia($id_comercio, $id_banco, $tipo_id, $rif, $cuenta);
    }

    if(isset($_POST['correo']) && isset($_POST['titular']))
    {
        $correo = $_POST['correo'];
        $titular = $_POST['titular'];
 
        $zelle = NuevoZelle($id_comercio, $correo, $titular);

    }
}

function NuevoPagoMovil($id_comercio, $id_banco, $tipo_id, $rif, $telefono)
{
    require 'conexion.php';
    $fecha = CurrentDate();
    
    if($id_banco && $rif && $telefono)
    {
        $insert_sql = 'INSERT INTO pago_movil (Id_comercio, Tipo_id, Documento, Id_banco, Telefono, Fecha) VALUES (?,?,?,?,?,?)';
        $sent = $pdo->prepare($insert_sql);
        $sent->execute(array($id_comercio, $tipo_id, $rif, $id_banco, $telefono, $fecha));
    }
}

function NuevoTransferencia($id_comercio, $id_banco, $tipo_id, $rif, $cuenta)
{
    require 'conexion.php';
    $fecha = CurrentDate();
    
    if($id_banco && $rif && $cuenta)
    {
        $insert_sql = 'INSERT INTO transferencia (Id_comercio, Tipo_id, Documento, Id_banco, Cuenta, Fecha) VALUES (?,?,?,?,?,?)';
        $sent = $pdo->prepare($insert_sql);
        $sent->execute(array($id_comercio, $tipo_id, $rif, $id_banco, $cuenta, $fecha));
    }
}

function NuevoZelle($id_comercio, $correo, $titular)
{
    require 'conexion.php';
    $fecha = CurrentDate();
    
    if($id_comercio && $correo && $titular)
    {
        $insert_sql = 'INSERT INTO Zelle (Id_comercio, Correo, Titular, Fecha) VALUES (?,?,?,?)';
        $sent = $pdo->prepare($insert_sql);
        $sent->execute(array($id_comercio, $correo, $titular, $fecha));
    }
}

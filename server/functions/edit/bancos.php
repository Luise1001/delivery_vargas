<?php

function editar_datos_banco()
{
    include_once '../conexion.php';

    if(isset($_POST['option']))
    {
       $option = $_POST['option'];

       if($option === 'pm')
       {
         $id = $_POST['id'];
         $tipo_id = $_POST['tipo_id'];
         $documento = $_POST['documento'];
         $id_banco = $_POST['id_banco'];
         $telefono = $_POST['telefono'];

          EditarPagoMovil($id, $tipo_id, $documento, $id_banco, $telefono);
       }

       if($option === 'tr')
       {
         $id = $_POST['id'];
         $tipo_id = $_POST['tipo_id'];
         $documento = $_POST['documento'];
         $id_banco = $_POST['id_banco'];
         $cuenta = $_POST['cuenta'];

          EditarTransferencia($id, $tipo_id, $documento, $id_banco, $cuenta);
       }

       if($option === 'zl')
       {
        $id = $_POST['id'];
        $correo = $_POST['correo'];
        $titular = $_POST['titular'];

         EditarZelle($id, $correo, $titular);
       }
    }


}

function EditarPagoMovil($id, $tipo_id, $documento, $id_banco, $telefono)
{
    require '../conexion.php';
    $movimiento = CurrentTime();

    $editsql = 'UPDATE pago_movil SET Tipo_id=?, Documento=?, Id_banco=?, Telefono=?, U_movimiento=?   WHERE Id=?';
    $editar_sentence = $pdo->prepare($editsql);
    $editar_sentence->execute(array($tipo_id, $documento, $id_banco, $telefono, $movimiento, $id));

}

function EditarTransferencia($id, $tipo_id, $documento, $id_banco, $cuenta)
{
    require '../conexion.php';
    $movimiento = CurrentTime();

    $editsql = 'UPDATE transferencia SET Tipo_id=?, Documento=?, Id_banco=?, Cuenta=?, U_movimiento=?   WHERE Id=?';
    $editar_sentence = $pdo->prepare($editsql);
    $editar_sentence->execute(array($tipo_id, $documento, $id_banco, $cuenta, $movimiento, $id));
}

function EditarZelle($id, $correo, $titular)
{
    require '../conexion.php';
    $movimiento = CurrentTime();

    $editsql = 'UPDATE zelle SET Correo=?, Titular=?, U_movimiento=?   WHERE Id=?';
    $editar_sentence = $pdo->prepare($editsql);
    $editar_sentence->execute(array($correo, $titular, $movimiento, $id));
}
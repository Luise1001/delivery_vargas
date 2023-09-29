<?php

function switch_encendido_apagado()
{
    include_once 'conexion.php';
    $id_usuario = UserID($_SESSION['admin']);
    $nivel = AdminLevel($id_usuario);
    $disponible = $_POST['estado'];

    if($nivel === '2')
    {
        $cedula = DriverCedula($id_usuario);
        $id_conductor = DriverID($cedula);
        $movimiento = CurrentTime();
    
        $editsql = 'UPDATE conductores SET Disponible=?, U_movimiento=?  WHERE Id=?';
        $editar_sentence = $pdo->prepare($editsql);
        $editar_sentence->execute(array($disponible, $movimiento, $id_conductor));
    }

    if($nivel === '3')
    {
        $rif = ComercioRif($id_usuario);
        $id_comercio = ComercioID($rif);
        $movimiento = CurrentTime();
    
        $editsql = 'UPDATE comercios SET Disponible=?, U_movimiento=?  WHERE Id=?';
        $editar_sentence = $pdo->prepare($editsql);
        $editar_sentence->execute(array($disponible, $movimiento, $id_comercio));
    }

    echo $disponible;

}
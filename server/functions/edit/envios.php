<?php

function elegir_conductor()
{
    include_once '../conexion.php';

    if(isset($_POST['id_conductor']) && isset($_POST['pedido']))
    {
        $admin = $_SESSION['DLV']['admin'];
        $id_admin = UserID($admin);
        $id_conductor = $_POST['id_conductor'];
        $nro_pedido = $_POST['pedido'];
        $DriverData = DriverData($id_conductor);
        $id_user_conductor = $DriverData[0]['Id_usuario'];
        $nivel_notificacion = 2;
        $movimiento = CurrentTime();
        $cliente = OrderClientName($nro_pedido);

        $editsql = 'UPDATE envios SET Id_conductor=?, Administrador=?, U_movimiento=?, Asignado = 1  WHERE Nro_pedido=?';
        $editar_sentence = $pdo->prepare($editsql);
        $editar_sentence->execute(array($id_conductor, $id_admin, $movimiento, $nro_pedido));

        $editsql = 'UPDATE estatus_pedidos SET Id_conductor=?, Administrador=?, U_movimiento=?, Asignado = 1  WHERE Nro_pedido=?';
        $editar_sentence = $pdo->prepare($editsql);
        $editar_sentence->execute(array($id_conductor, $id_admin, $movimiento, $nro_pedido));

        $edit_sql = 'UPDATE conductores SET Disponible = 0  WHERE Id=?';
        $edit_sentence = $pdo->prepare($edit_sql);
        $edit_sentence->execute(array($id_conductor));

        $tokens = getTokenIndividual($id_user_conductor, $nivel_notificacion);
        $key = requestKey();
        $title = 'Nuevo Envió Asignado';
        $message = "Cliente: $cliente";
        $url = 'templates/conductores/lista_de_envios';
        $push = push_notification($key, $tokens, $title, $message, $url);
    }

}

function aceptar_envio()
{
    include_once '../conexion.php';
    if(isset($_POST['nro_pedido']))
    {
    $nro_pedido = $_POST['nro_pedido'];
    $movimiento = CurrentTime();

    $editsql = 'UPDATE envios SET Aceptado = 1, U_movimiento=? WHERE nro_pedido=?';
    $editar_sentence = $pdo->prepare($editsql);
    $editar_sentence->execute(array($movimiento, $nro_pedido));

    $editsql = 'UPDATE estatus_pedidos SET U_movimiento=?, Aceptado = 1  WHERE Nro_pedido=?';
    $editar_sentence = $pdo->prepare($editsql);
    $editar_sentence->execute(array($movimiento, $nro_pedido));
    }
}

function ruta_completada()
{
   include_once '../conexion.php';
   if(isset($_POST['nro_pedido']))
   {
    $nro_pedido = $_POST['nro_pedido'];
    $admin = $_SESSION['DLV']['admin'];
    $id_usuario = UserID($admin);
    $cedula = DriverCedula($id_usuario);
    $id_conductor = DriverID($cedula);
    $movimiento = CurrentTime();

    $editsql = 'UPDATE envios SET Completado = 1, U_movimiento=? WHERE Nro_pedido=?';
    $editar_sentence = $pdo->prepare($editsql);
    $editar_sentence->execute(array($movimiento, $nro_pedido));

    $editsql = 'UPDATE estatus_pedidos SET U_movimiento=?, Enviado = 1, Entregado = 1  WHERE Nro_pedido=?';
    $editar_sentence = $pdo->prepare($editsql);
    $editar_sentence->execute(array($movimiento, $nro_pedido));

    $editsql = 'UPDATE conductores SET Disponible = 1, U_movimiento=? WHERE Id=?';
    $editar_sentence = $pdo->prepare($editsql);
    $editar_sentence->execute(array($movimiento, $id_conductor));
   }
}
<?php

function anular_pedido()
{
    require '../conexion.php';

    if(isset($_POST['nro_pedido']))
    {
        $nro_pedido = $_POST['nro_pedido'];
        $movimiento = CurrentTime();
        $anulado = 1;

        $editsql = 'UPDATE estatus_pedidos SET Anulado=?, U_movimiento=? WHERE Nro_pedido=?';
        $editar_sentence = $pdo->prepare($editsql);
        $editar_sentence->execute(array($anulado, $movimiento, $nro_pedido));
    }
}
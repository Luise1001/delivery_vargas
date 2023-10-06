<?php

function editar_horario()
{
    include_once '../conexion.php';
    $admin = $_SESSION['DLV']['admin'];
    $id_usuario = UserID($admin);
    $rif = ComercioRif($id_usuario);
    $id_comercio = ComercioID($rif);
    $movimiento = CurrentTime();

    if(isset($_POST['dia']) && isset($_POST['abrir']))
    {
        $id_dia = $_POST['dia'];
        $abrir = $_POST['abrir'];

        $id_dia = filter_var($id_dia, FILTER_SANITIZE_STRING);
        $abrir = filter_var($abrir, FILTER_SANITIZE_STRING);

        $editsql = 'UPDATE horario SET abrir=?, U_movimiento=? WHERE Id_dia=? AND Id_comercio=?';
        $editar_sentence = $pdo->prepare($editsql);
        $editar_sentence->execute(array($abrir, $movimiento, $id_dia, $id_comercio));

    }

    if(isset($_POST['dia']) && isset($_POST['cerrar']))
    {
        $id_dia = $_POST['dia'];
        $cerrar = $_POST['cerrar'];

        $id_dia = filter_var($id_dia, FILTER_SANITIZE_STRING);
        $cerrar = filter_var($cerrar, FILTER_SANITIZE_STRING);

        $editsql = 'UPDATE horario SET cerrar=?, U_movimiento=? WHERE Id_dia=? AND Id_comercio=?';
        $editar_sentence = $pdo->prepare($editsql);
        $editar_sentence->execute(array($cerrar, $movimiento, $id_dia, $id_comercio));

    }
}
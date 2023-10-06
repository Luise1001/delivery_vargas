<?php

function nuevo_horario()
{
     include_once '../conexion.php';
     $admin = $_SESSION['DLV']['admin'];
     $id_usuario = UserID($admin);
     $rif = ComercioRIf($id_usuario);
     $id_comercio = ComercioID($rif);
     $fecha = CurrentDate();

     if(isset($_POST['dia']) && isset($_POST['abrir']) && isset($_POST['cerrar']))
     {
        $id_dia = $_POST['dia'];
        $abrir = $_POST['abrir'];
        $cerrar = $_POST['cerrar'];
        $turno = 1;

        $id_dia = filter_var($id_dia, FILTER_SANITIZE_STRING);
        $abrir = filter_var($abrir, FILTER_SANITIZE_STRING);
        $cerrar = filter_var($cerrar, FILTER_SANITIZE_STRING);

        $insert_sql = 'INSERT INTO horario (Id_dia, Abrir, Cerrar, Turno, Id_comercio, Fecha) VALUES (?,?,?,?,?,?)';
        $sent = $pdo->prepare($insert_sql);
        $sent->execute(array($id_dia, $abrir, $cerrar, $turno, $id_comercio, $fecha));
     }

}
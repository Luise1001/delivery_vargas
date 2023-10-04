<?php

function eliminar_horario()
{
    include_once '../conexion.php';
    $id_usuario = UserID($_SESSION['admin']);
    $rif = ComercioRif($id_usuario);
    $id_comercio = ComercioID($rif);

    if(isset($_POST['dia']))
    {
        $id_dia = $_POST['dia'];
        
        $deletesql = 'DELETE FROM horario WHERE Id_dia=? AND Id_comercio=?';
        $sentenceDelete = $pdo->prepare($deletesql);
        $sentenceDelete-> execute(array($id_dia, $id_comercio)); 
    }

}
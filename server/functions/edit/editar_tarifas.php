<?php

function editar_tarifa()
{
    include_once 'conexion.php';
    if(isset($_POST['id_tarifa']) && isset($_POST['precio']))
    {
        $id = $_POST['id_tarifa'];
        $km = $_POST['km'];
        $precio = $_POST['precio'];
        $movimiento = CurrentTime();
     
         $editsql = 'UPDATE tarifas SET KM=?, Precio=?, U_movimiento=? WHERE Id=?';
         $editar_sentence = $pdo->prepare($editsql);
         $editar_sentence->execute(array($km, $precio, $movimiento, $id));
    }

}
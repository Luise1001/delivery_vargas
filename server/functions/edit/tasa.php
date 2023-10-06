<?php

function tasa_del_dia()
{
    include_once '../conexion.php';

   $tasa = TasaDD();

    if($tasa)
    {
        echo $tasa;
    }
    else
    {
        echo 0;
    }
}

function editar_tasa()
{
  include_once '../conexion.php';

  if(isset($_POST['tasa']))
  {
    $tasa = $_POST['tasa'];
    $fecha = CurrentDate();
    $admin = $_SESSION['DLV']['admin'];
    $id_usuario = UserID($admin);

    $insert_sql = 'INSERT INTO tasas (Tasa, Administrador, Fecha) VALUES (?,?,?)';
    $sent = $pdo->prepare($insert_sql);
    $sent->execute(array($tasa, $id_usuario, $fecha));

  }
}
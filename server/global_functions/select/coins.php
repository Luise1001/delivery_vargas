<?php

function Alicuota($id_moneda)
{
  require '../conexion.php';

  $consulta_sql = "SELECT * FROM monedas WHERE Id=?";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute(array($id_moneda));
  $resultado = $preparar_sql->fetchAll();

  if($resultado)
  {
    $alicuota = $resultado[0]['Alicuota'];

    return $alicuota;
  }
  else
  {
    return;
  }
}

function TasaDD()
{
  require '../conexion.php';


  $consulta_sql = "SELECT * FROM tasas  ORDER BY U_movimiento DESC LIMIT 1";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute();
  $resultado = $preparar_sql->fetchAll();

  if($resultado)
  {
    $tasa = $resultado[0]['Tasa'];
    return $tasa;
  }
  else
  {
    return;
  }
}
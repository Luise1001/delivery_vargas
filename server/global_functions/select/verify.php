<?php 

function VerifyDB($table, $column, $data)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM $table WHERE $column=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($data));
    $resultado = $preparar_sql->fetchAll();
  
    if($resultado)
    {
      return true;
    }
    else
    {
      return false;
    }
}
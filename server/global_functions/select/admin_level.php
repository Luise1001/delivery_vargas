<?php 

function AdminLevel($id)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM usuarios WHERE Id=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
      $nivel = $resultado[0]['Nivel'];
    }
    else
    {
        return;
    }
    
    

    return $nivel;
}

function WriteLevel($nivel)
{
  if($nivel == 0)
  {
    $nivel = 'Cliente';
  }
  if($nivel == 1)
  {
    $nivel = 'Administrador';
  }
  if($nivel == 2)
  {
    $nivel = 'Conductor';
  }
  if($nivel == 3)
  {
    $nivel = 'Comercio Afiliado';
  }

  return $nivel;
}
<?php 
include_once '../../server/conexion.php';

if(isset($_SESSION['DLV']))
{
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);

  if($AdminLevel != '1')
  {
    echo'<script type="text/javascript">
    window.location.href="../inicio/inicio";
    </script>';
  }
}
else
{
  echo'<script type="text/javascript">
  window.location.href="../../index";
  </script>';
}

function UserID($correo)
{
    require '../../server/conexion.php';

    $consulta_sql = "SELECT * FROM usuarios WHERE Correo=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($correo));
    $resultado = $preparar_sql->fetchAll();
    
    if($resultado)
    {
      $id_usuario = $resultado[0]['Id'];
    }
    else
    {
      return;
    }

    return $id_usuario;
}

function AdminLevel($id)
{
    require '../../server/conexion.php';

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
?>
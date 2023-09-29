<?php

include_once 'conexion.php';

if(isset($_SESSION['admin']))
{
  $usuario = $_SESSION['admin'];

  $consulta = 'SELECT * FROM usuarios WHERE Correo=?';
  $preparar = $pdo->prepare($consulta);
  $preparar->execute(array($usuario));
  $resultado = $preparar->fetchAll();

  $nivel = $resultado[0]['Nivel'];

  if($nivel != 1)
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

?>
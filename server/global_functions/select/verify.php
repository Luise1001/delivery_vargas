<?php

function verificar_cedula()
{
     include_once '../conexion.php';

     $cedula = DriverID($_POST['cedula']);

    if(!$cedula)
    {
        echo 'El conductor debe estar registrado en la base de datos.';
    }
    else
    {
        echo 1;
    }
}

function verificar_correo_conductor()
{
    include_once '../conexion.php';

    $id_usuario = UserID($_POST['usuario']);
    $nivel = AdminLevel($id_usuario);

    if($id_usuario && $nivel == 2)
    {
      $estatus = DriverStatus($id_usuario);

      if($estatus)
      {
        echo 'Este Correo ya esta en uso para otro Conductor';
      }
      else
      {
         echo 1;
      }
    }
    else
    {
        echo 'El correo debe estar registrado como Conductor';
    }

}

function verificar_codigo()
{
    include_once '../conexion.php';

    $id_usuario = UserID($_SESSION['admin']);
    $rif_comercio = ComercioRif($id_usuario);
    $id_comercio = ComercioID($rif_comercio);
    $codigo = $_POST['codigo'];

    $resultado = CodeID($codigo, $id_comercio);

    if($resultado)
    {
        echo 'Codigo en Uso, por favor intentar con otro.';
    }
    else
    {
        echo 0;
    }
}


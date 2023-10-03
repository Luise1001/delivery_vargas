<?php

function eliminar_conductor()
{
    include_once 'conexion.php';

    $id_conductor = $_POST['id_conductor'];

    $deletesql = 'DELETE FROM conductores WHERE Id=?';
    $sentenceDelete = $pdo->prepare($deletesql);
    $sentenceDelete-> execute(array($id_conductor));
}

function eliminar_moto()
{
    include_once 'conexion.php';

    $id_moto = $_POST['id_moto'];

    $deletesql = 'DELETE FROM motos WHERE Id=?';
    $sentenceDelete = $pdo->prepare($deletesql);
    $sentenceDelete-> execute(array($id_moto));
}

function eliminar_tarifa()
{
    include_once 'conexion.php';

    $id_tarifa = $_POST['id_tarifa'];

    $deletesql = 'DELETE FROM tarifas WHERE Id=?';
    $sentenceDelete = $pdo->prepare($deletesql);
    $sentenceDelete-> execute(array($id_tarifa));
}

function eliminar_admin()
{
    include_once 'conexion.php';

    $id_admin = $_POST['id_admin'];

    $deletesql = 'DELETE FROM usuarios WHERE Id=?';
    $sentenceDelete = $pdo->prepare($deletesql);
    $sentenceDelete-> execute(array($id_admin));
}

function eliminar_cliente()
{
    include_once 'conexion.php';

    $id_cliente = $_POST['id_cliente'];

    $deletesql = 'DELETE FROM clientes WHERE Id=?';
    $sentenceDelete = $pdo->prepare($deletesql);
    $sentenceDelete-> execute(array($id_cliente));
}

function eliminar_producto()
{
    include_once 'conexion.php';

    if(isset($_POST['id_producto']) && isset($_POST['codigo']) && isset($_POST['rif']))
    {
        $rif = $_POST['rif'];
        $id_producto = $_POST['id_producto'];
        $codigo = $_POST['codigo'];
        $foto = "../img/$rif/productos/$codigo.jpg";

        $deletesql = 'DELETE FROM inventario WHERE Id_producto=?';
        $sentenceDelete = $pdo->prepare($deletesql);
        $sentenceDelete-> execute(array($id_producto));

       $deletesql = 'DELETE FROM productos WHERE Id=?';
       $sentenceDelete = $pdo->prepare($deletesql);
       $sentenceDelete-> execute(array($id_producto));


      
      DeletePhoto($foto);
    
    }

}

function eliminar_direccion()
{
    include_once 'conexion.php';

    if(isset($_POST['id_direccion']))
    {
        $id_usuario = UserID($_SESSION['admin']);
        $id_direccion = $_POST['id_direccion'];


      $deletesql = 'DELETE FROM static_locations WHERE Id=? AND Id_usuario=?';
      $sentenceDelete = $pdo->prepare($deletesql);
      $sentenceDelete-> execute(array($id_direccion, $id_usuario));    
    }

}

function eliminar_horario()
{
    include_once 'conexion.php';
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

function eliminar_datos_bancarios()
{
    include_once 'conexion.php';

    if(isset($_POST['id']) && isset($_POST['id_comercio']) && isset($_POST['tabla']))
    {
        $id = $_POST['id'];
        $id_comercio = $_POST['id_comercio'];
        $tabla = $_POST['tabla'];

        if($tabla === 'pm')
        {
            $deletesql = 'DELETE FROM pago_movil WHERE Id=? AND Id_comercio=?';
            $sentenceDelete = $pdo->prepare($deletesql);
            $sentenceDelete-> execute(array($id, $id_comercio)); 
        }

        if($tabla === 'tr')
        {
            $deletesql = 'DELETE FROM transferencia WHERE Id=? AND Id_comercio=?';
            $sentenceDelete = $pdo->prepare($deletesql);
            $sentenceDelete-> execute(array($id, $id_comercio)); 
        }
        if($tabla === 'zelle')
        {
            $deletesql = 'DELETE FROM zelle WHERE Id=? AND Id_comercio=?';
            $sentenceDelete = $pdo->prepare($deletesql);
            $sentenceDelete-> execute(array($id, $id_comercio)); 
        }
    }
}
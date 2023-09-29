<?php 

include_once '../functions/conexion.php';

$usuario = $_SESSION['admin'];

$consulta_sql = "SELECT * FROM usuarios WHERE Correo=?";
$preparar_sql = $pdo->prepare($consulta_sql);
$preparar_sql->execute(array($usuario));
$resultado = $preparar_sql->fetchAll();

$nivel = $resultado[0]['Nivel'];

if($nivel == '1')
{
    echo'<script type="text/javascript">
    window.location.href="administradores/envios_pendientes";
    </script>';
}
if($nivel == '2')
{
    echo'<script type="text/javascript">
    window.location.href="conductores/envios_pendientes";
    </script>';
}
if($nivel == '3')
{
    echo'<script type="text/javascript">
    window.location.href="comercios/lista_de_pedidos";
    </script>';
}
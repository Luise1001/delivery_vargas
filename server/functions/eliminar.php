<?php
require '../global_functions/add/scripts.php';
require '../global_functions/delete/scripts.php';
require '../global_functions/edit/scripts.php';
require '../global_functions/select/scripts.php';
include_once 'delete/scripts.php';

$funcion = $_POST['funcion'];

if($funcion === 'cerrar_sesion')
{
    cerrar_sesion();
}
if($funcion === 'eliminar_direccion')
{
    eliminar_direccion();
}
if($funcion === 'eliminar_producto')
{
    eliminar_producto();
}
if($funcion === 'eliminar_datos_bancarios')
{
    eliminar_datos_bancarios();
}
if($funcion === 'eliminar_conductor')
{
    eliminar_conductor();
}
if($funcion === 'eliminar_moto')
{
    eliminar_moto();
}
if($funcion === 'eliminar_admin')
{
    eliminar_admin();
}


if($funcion === 'eliminar_tarifa')
{
    eliminar_tarifa();
}

if($funcion === 'eliminar_cliente')
{
    eliminar_cliente();
}
if($funcion === 'eliminar_horario')
{
    eliminar_horario();
}

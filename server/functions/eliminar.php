<?php
require '../global_functions/select/scripts.php';
require '../global_functions/edit/scripts.php';
require '../global_functions/delete/scripts.php';
include_once 'functions/delete/scripts.php';

$page = $_POST['page'];

if($page === 'eliminar_conductor')
{
    eliminar_conductor();
}
if($page === 'eliminar_moto')
{
    eliminar_moto();
}
if($page === 'eliminar_tarifa')
{
    eliminar_tarifa();
}
if($page === 'eliminar_admin')
{
    eliminar_admin();
}
if($page === 'eliminar_cliente')
{
    eliminar_cliente();
}
if($page === 'eliminar_producto')
{
    eliminar_producto();
}
if($page === 'eliminar_direccion')
{
    eliminar_direccion();
}
if($page === 'eliminar_horario')
{
    eliminar_horario();
}
if($page === 'eliminar_datos_bancarios')
{
    eliminar_datos_bancarios();
}
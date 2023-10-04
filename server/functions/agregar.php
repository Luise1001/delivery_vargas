<?php
require '../global_functions/add/scripts.php';
require '../global_functions/edit/scripts.php';
require '../global_functions/select/scripts.php';
include_once 'add/scripts.php';

$page = $_POST['page'];

if($page === 'nuevo_usuario')
{
    nuevo_usuario();
}
if($page === 'nuevo_conductor')
{
    nuevo_conductor();
}
if($page === 'nueva_moto')
{
    nueva_moto();
}
if($page === 'nuevo_admin')
{
    nuevo_admin();
}
if($page === 'nueva_tarifa')
{
    nueva_tarifa();
}
if($page === 'mi_ubicacion_actual')
{
    mi_ubicacion_actual();
}
if($page === 'nueva_direccion')
{
    nueva_direccion();
}
if($page === 'nuevo_token_firebase')
{
    nuevo_token_firebase();
}
if($page === 'elegir_categoria')
{
    elegir_categoria();
}
if($page === 'elegir_metodo_pago')
{
    elegir_metodo_pago();
}
if($page === 'nuevo_producto')
{
    nuevo_producto();
}
if($page === 'agregar_al_carrito')
{
    agregar_al_carrito();
}
if($page === 'nuevo_pedido')
{
    nuevo_pedido();
}
if($page === 'nuevos_datos_bancarios')
{
    nuevos_datos_bancarios();
}
if($page === 'confirmar_pedido')
{
    confirmar_pedido();
}
if($page === 'retirar_pedido')
{
    retirar_pedido();
}
if($page === 'nuevo_horario')
{
    nuevo_horario();
}
if($page === 'generar_codigo')
{
    generar_codigo();
}
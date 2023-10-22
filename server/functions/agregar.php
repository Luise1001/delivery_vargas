<?php
require '../global_functions/add/scripts.php';
require '../global_functions/edit/scripts.php';
require '../global_functions/select/scripts.php';
include_once 'add/scripts.php';

$funcion = $_POST['funcion'];

if($funcion === 'nuevo_usuario')
{
    nuevo_usuario();
}
if($funcion === 'nueva_foto_perfil')
{
    nueva_foto_perfil();
}
if($funcion === 'generar_codigo')
{
    generar_codigo();
}
if($funcion === 'nuevo_cliente')
{
    nuevo_cliente();
}
if($funcion === 'nuevo_comercio')
{
    nuevo_comercio();
}
if($funcion === 'confirmar_pedido')
{
    confirmar_pedido();
}
if($funcion === 'retirar_pedido')
{
    retirar_pedido();
}
if($funcion === 'nuevo_producto')
{
    nuevo_producto();
}
if($funcion === 'nuevos_datos_bancarios')
{
    nuevos_datos_bancarios();
}
if($funcion === 'nuevo_admin')
{
    nuevo_admin();
}
if($funcion === 'nuevo_conductor')
{
    nuevo_conductor();
}
if($funcion === 'nueva_moto')
{
    nueva_moto();
}





if($funcion === 'nueva_tarifa')
{
    nueva_tarifa();
}
if($funcion === 'mi_ubicacion_actual')
{
    mi_ubicacion_actual();
}
if($funcion === 'nueva_direccion')
{
    nueva_direccion();
}
if($funcion === 'nuevo_token_firebase')
{
    nuevo_token_firebase();
}
if($funcion === 'elegir_categoria')
{
    elegir_categoria();
}
if($funcion === 'elegir_metodo_pago')
{
    elegir_metodo_pago();
}

if($funcion === 'agregar_al_carrito')
{
    agregar_al_carrito();
}
if($funcion === 'nuevo_pedido')
{
    nuevo_pedido();
}
if($funcion === 'nuevo_horario')
{
    nuevo_horario();
}

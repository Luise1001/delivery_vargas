<?php
require '../global_functions/add/scripts.php';
require '../global_functions/edit/scripts.php';
require '../global_functions/select/scripts.php';
include_once 'edit/scripts.php';

$funcion = $_POST['funcion'];

if($funcion === 'reset_password')
{
    reset_password();
}
if($funcion === 'anular_pedido')
{
    anular_pedido();
}




if($funcion === 'editar_conductor')
{
    editar_conductor();
}
if($funcion === 'editar_moto')
{
    editar_moto();
}
if($funcion === 'editar_tarifa')
{
    editar_tarifa();
}
if($funcion === 'editar_admin')
{
    editar_admin();
}
if($funcion === 'aceptar_envio')
{
    aceptar_envio();
}
if($funcion === 'ruta_completada')
{
    ruta_completada();
}
if($funcion === 'switch_encendido_apagado')
{
    switch_encendido_apagado();
}
if($funcion === 'editar_comercio')
{
    editar_comercio();
}
if($funcion === 'editar_usuario_cliente')
{
    editar_usuario_cliente();
}
if($funcion === 'editar_nombre_usuario')
{
    editar_nombre_usuario();
}
if($funcion === 'nueva_foto_perfil')
{
    editar_foto_perfil();
}
if($funcion === 'editar_producto')
{
    editar_producto();
}

if($funcion === 'editar_datos_banco')
{
    editar_datos_banco();
}
if($funcion === 'tasa_del_dia')
{
    tasa_del_dia();
}
if($funcion === 'editar_tasa')
{
    editar_tasa();
}
if($funcion === 'elegir_conductor')
{
    elegir_conductor();
}
if($funcion === 'editar_direccion')
{
    editar_direccion();
}
if($funcion === 'editar_horario')
{
    editar_horario();
}
if($funcion === 'cambiar_mi_clave')
{
    cambiar_mi_clave();
}
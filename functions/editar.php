<?php
require 'global_functions/global_functions.php';
include_once 'editar/scripts.php';

$page = $_POST['page'];

if($page === 'editar_conductor')
{
    editar_conductor();
}
if($page === 'editar_moto')
{
    editar_moto();
}
if($page === 'editar_tarifa')
{
    editar_tarifa();
}
if($page === 'editar_admin')
{
    editar_admin();
}
if($page === 'aceptar_envio')
{
    aceptar_envio();
}
if($page === 'ruta_completada')
{
    ruta_completada();
}
if($page === 'switch_encendido_apagado')
{
    switch_encendido_apagado();
}
if($page === 'editar_cliente')
{
    editar_cliente();
}
if($page === 'editar_comercio')
{
    editar_comercio();
}
if($page === 'editar_usuario_cliente')
{
    editar_usuario_cliente();
}
if($page === 'editar_nombre_usuario')
{
    editar_nombre_usuario();
}
if($page === 'editar_foto_perfil')
{
    editar_foto_perfil();
}
if($page === 'editar_producto')
{
    editar_producto();
}
if($page === 'anular_pedido')
{
    anular_pedido();
}
if($page === 'editar_datos_banco')
{
    editar_datos_banco();
}
if($page === 'tasa_del_dia')
{
    tasa_del_dia();
}
if($page === 'editar_tasa')
{
    editar_tasa();
}
if($page === 'elegir_conductor')
{
    elegir_conductor();
}
if($page === 'editar_direccion')
{
    editar_direccion();
}
if($page === 'editar_horario')
{
    editar_horario();
}
if($page === 'reset_password')
{
    reset_password();
}
if($page === 'cambiar_mi_clave')
{
    cambiar_mi_clave();
}
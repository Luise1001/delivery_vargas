<?php
require '../global_functions/add/scripts.php';
require '../global_functions/edit/scripts.php';
require '../global_functions/select/scripts.php';
include_once 'select/scripts.php';

$funcion = $_POST['funcion'];

if($funcion === 'login')
{
    log_in();
}
if($funcion === 'menu')
{
     menu();
}
if($funcion === 'mi_perfil')
{
    mi_perfil();
}
if($funcion === 'mi_perfil_juridico')
{
    mi_perfil_juridico();
}
if($funcion === 'mi_perfil_conductor')
{
    mi_perfil_conductor();
}
if($funcion === 'categorias')
{
    categorias();
}
if($funcion === "mis_categorias")
{
    mis_categorias();
}
if($funcion === 'productos_nuevos')
{
    productos_nuevos();
}
if($funcion === 'catalogo_productos')
{
    catalogo_productos();
}
if($funcion === 'comercios')
{
    comercios();
}
if($funcion === 'CheckClient')
{
    CheckClient();
}
if($funcion === 'ItemsInCar')
{
    ItemsInCar();
}
if($funcion === 'mis_carritos')
{
   mis_carritos();
}
if($funcion === 'mi_carrito')
{
   mi_carrito();
}
if($funcion === 'mis_pedidos')
{
    mis_pedidos();
}
if($funcion === 'detalle_pedido')
{
    detalle_pedido();
}
if($funcion === 'finalizar_compra')
{
    finalizar_compra();
}
if($funcion === 'datos_bancarios')
{
    datos_bancarios();
}
if($funcion === 'mis_direcciones')
{  
    mis_direcciones();
}
if($funcion === 'calcular_tarifa')
{
    calcular_tarifa();
}
if($funcion === 'cambio_clave')
{
    cambio_clave();
}
if($funcion === 'mis_productos')
{
    mis_productos();
}
if($funcion === 'buscar_producto')
{
    buscar_producto();
}
if($funcion === 'ver_producto')
{
     ver_producto();
}
if($funcion === 'mis_datos_bancarios')
{
    mis_datos_bancarios();
}
if($funcion === 'CheckCode')
{
    CheckCode();
}
if($funcion === 'mi_horario')
{
    mi_horario();
}
if($funcion === 'mis_envios')
{
    mis_envios();
}
if($funcion === 'detalle_envio')
{
    detalle_envio();
}
if($funcion === 'conductores_disponibles')
{
    conductores_disponibles();
}
if($funcion === 'lista_de_comercios')
{
    lista_de_comercios();
}
if($funcion === 'lista_de_clientes')
{
    lista_de_clientes();
}
if($funcion === 'lista_de_usuarios')
{
    lista_de_usuarios();
}
if($funcion === 'conductores')
{
    lista_de_conductores();
}
if($funcion === 'detalle_conductor')
{
    detalle_conductor();
}
if($funcion === 'cedula_conductor')
{
    cedula_conductor();
}
if($funcion === 'lista_de_motos')
{
    lista_de_motos();
}
if($funcion === 'detalle_moto')
{
    detalle_moto();
}
if($funcion === 'lista_de_tarifas')
{
    lista_de_tarifas();
}
if($funcion === 'administradores')
{
    lista_de_administradores();
}





if($funcion === 'metodos_de_pago')
{
    metodos_de_pago();
}
if($funcion === 'opciones_de_pago')
{
    opciones_de_pago();
}

if($funcion === 'lista_de_bancos')
{
    lista_de_bancos();
}

if($funcion === 'ChequearHorario')
{
    ChequearHorario();
}
if($funcion === 'admin_level')
{
   include_once 'conexion.php';

   $admin = $_SESSION['DLV']['admin'];
   $id_usuario = UserID($admin);
   $nivel = AdminLevel($id_usuario);
   echo $nivel;
}
if($funcion === 'datos_pago_pedido')
{
    datos_pago_pedido();
}
if($funcion === 'mi_moto')
{
    mi_moto();
}

if($funcion === 'mi_switch')
{
    mi_switch();
}

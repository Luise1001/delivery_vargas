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



if($funcion === 'conductores')
{
    lista_de_conductores();
}
if($funcion === 'lista_de_motos')
{
    lista_de_motos();
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
if($funcion === 'mis_datos_bancarios')
{
    mis_datos_bancarios();
}
if($funcion === 'lista_de_bancos')
{
    lista_de_bancos();
}
if($funcion === 'mis_envios')
{
    mis_envios();
}
if($funcion === 'conductores_disponibles')
{
    conductores_disponibles();
}
if($funcion === 'lista_de_tarifas')
{
    lista_de_tarifas();
}
if($funcion === 'lista_de_clientes')
{
    lista_de_clientes();
}
if($funcion === 'ChequearHorario')
{
    ChequearHorario();
}
if($funcion === 'lista_de_usuarios')
{
    lista_de_usuarios();
}
if($funcion === 'admin_level')
{
   include_once 'conexion.php';

   $admin = $_SESSION['DLV']['admin'];
   $id_usuario = UserID($admin);
   $nivel = AdminLevel($id_usuario);
   echo $nivel;
}
if($funcion === 'lista_de_comercios')
{
    lista_de_comercios();
}

if($funcion === 'mis_productos')
{
    mis_productos();
}
if($funcion === 'mi_perfil')
{
    mi_perfil();
}
if($funcion === 'full_descripcion')
{
    full_descripcion();
}
if($funcion === 'catalogo_productos')
{
    catalogo_productos();
}

if($funcion === 'datos_pago_pedido')
{
    datos_pago_pedido();
}
if($funcion === 'mi_moto')
{
    mi_moto();
}
if($funcion === 'mi_horario')
{
    mi_horario();
}
if($funcion === 'mi_switch')
{
    mi_switch();
}

<?php
require 'global_functions/global_functions.php';

include_once 'consulta/scripts.php';

$page = $_POST['page'];

if($page === 'sesion_cliente')
{
    sesion_cliente();
}
if($page === 'sesion_admin')
{
    sesion_admin();
}
if($page === 'conductores')
{
    lista_de_conductores();
}
if($page === 'lista_de_motos')
{
    lista_de_motos();
}
if($page === 'administradores')
{
    lista_de_administradores();
}
if($page === 'metodos_de_pago')
{
    metodos_de_pago();
}
if($page === 'opciones_de_pago')
{
    opciones_de_pago();
}
if($page === 'mis_datos_bancarios')
{
    mis_datos_bancarios();
}
if($page === 'lista_de_bancos')
{
    lista_de_bancos();
}
if($page === 'mis_envios')
{
    mis_envios();
}
if($page === 'conductores_disponibles')
{
    conductores_disponibles();
}
if($page === 'lista_de_tarifas')
{
    lista_de_tarifas();
}
if($page === 'calcular_tarifa')
{
    $distancia = $_POST['distancia'];
    calcular_tarifa($distancia);
}
if($page === 'lista_de_clientes')
{
    lista_de_clientes();
}
if($page === 'lista_de_usuarios')
{
    lista_de_usuarios();
}
if($page === 'conductores_cercanos')
{
    conductores_cercanos();
}
if($page === 'lista_de_usuarios_comercios')
{
    lista_de_usuarios_comercios();
}
if($page === 'datos_bancarios')
{
    datos_bancarios();
}
if($page === "categorias_comercios")
{
    categorias_comercios();
}
if($page === 'admin_level')
{
   include_once 'conexion.php';

   $id_usuario = UserID($_SESSION['admin']);
   $nivel = AdminLevel($id_usuario);
   echo $nivel;
}
if($page === 'lista_de_comercios')
{
    lista_de_comercios();
}
if($page === 'mis_direcciones')
{  
    mis_direcciones();
}
if($page === 'direccion_envio')
{
    direccion_envio();
}
if($page === 'direccion_salida')
{
    direccion_salida();
}
if($page === 'nombre_direccion')
{
    nombre_direccion();
}
if($page === 'mis_productos')
{
    mis_productos();
}
if($page === 'mi_perfil')
{
    mi_perfil();
}
if($page === 'full_descripcion')
{
    full_descripcion();
}
if($page === 'comercios_by_categoria')
{
    comercios_by_categoria();
}
if($page === 'catalogo_productos')
{
    catalogo_productos();
}
if($page === 'cantidad_productos_carrito')
{
    cantidad_productos_carrito();
}
if($page === 'ver_mi_carrito')
{
   ver_mi_carrito();
}
if($page === 'mis_pedidos')
{
    mis_pedidos();
}
if($page === 'valida_email')
{
    if(isset($_POST['email']))
    {
       $result = ValidateEmail($_POST['email']);

       echo $result;
    }
}
if($page === 'check_personal_data')
{
   check_personal_data();
}
if($page === 'datos_pago_pedido')
{
    datos_pago_pedido();
}
if($page === 'consultar_datos')
{
  consultar_datos();
}
if($page === 'mi_moto')
{
    mi_moto();
}
if($page === 'mi_horario')
{
    mi_horario();
}
if($page === 'ChequearHorario')
{
   ChequearHorario();
}
if($page === 'menu_configuracion')
{
    menu_configuracion();
}
if($page === 'mi_switch')
{
    mi_switch();
}

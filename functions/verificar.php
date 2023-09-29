<?php

include_once 'verificar/verificar_funciones.php';

if($_POST)
{
    $page = $_POST['page'];

    if($page === 'verificar_cedula')
    {
        verificar_cedula();
    }
    if($page === 'verificar_correo_conductor')
    {
        verificar_correo_conductor();
    }
    if($page === 'verificar_codigo')
    {
        verificar_codigo();
    }

}
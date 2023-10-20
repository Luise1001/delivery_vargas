<?php

function SearchProfilePhoto($UserID)
{
    $ruta = "../images/profile/users/$UserID/photo/perfil.jpg";

    if(file_exists($ruta))
    {
        $foto = "../../server/images/profile/users/$UserID/photo/perfil.jpg";
        return $foto;
    }
    else
    {
        require '../conexion.php';
        $UserData = UserData($UserID);
        $UserName = $UserData[0]['User_name'];
        $inicial = substr($UserName, 0, 1);
        $foto = ProfilePhoto($inicial);
        return $foto;
    }
} 

function SearchProductPhoto($id_comercio, $codigo)
{
    $ruta = "../images/products/comercios/$id_comercio/productos/$codigo.jpg";

    if(file_exists($ruta))
    {
        $foto = "../../server/images/products/comercios/$id_comercio/productos/$codigo.jpg";
        return $foto;
    }
    else
    {
       $foto = "../../server/images/products/generico.png";
       
        return $foto;
    }
}
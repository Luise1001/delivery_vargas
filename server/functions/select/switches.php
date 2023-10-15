<?php

function mi_switch()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $id_usuario = UserID($admin);
  $nivel = AdminLevel($id_usuario);
  $checked = UserStatus($id_usuario, $nivel);
  $titulo = "<i class='fas fa-user-slash'></i> No Disponible";

  if($checked == false)
  {
     $titulo = "<i class='fas fa-user'></i> Disponible" ;
  }

  $switch = 
  "
  <ul class='my-switch-mobile'>
  <li class='form-check form-switch form-check-reverse'>
  <div class='text-switch'>
  $titulo 
  </div>
   <input class='form-check-input' $checked type='checkbox' id='estatus' name='estatus'>
   <label class='form-check-label' for='estatus'></label> 
   </li>
   </ul>
  ";

  echo $switch;

}
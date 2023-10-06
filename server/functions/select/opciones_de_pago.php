<?php
function opciones_de_pago()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $id_usuario = UserID($admin);
  $rif_comercio = ComercioRif($id_usuario);
  $id_comercio = ComercioID($rif_comercio);
  $mis_opciones = OptionsPaymentMethods($id_comercio);

  $opciones =
  "
  <ul>
  <div class='opciones'>
      <a  class='btn menu_opciones list-payment-btn' title='Mis Métodos de Pago'>
      <i class='fas fa-comment-dollar'></i> Mis Métodos de Pago
     </i> <i id='arrow_pay' class='fas fa-angle-down'></i>
      </a>
<div class='dropdown-container'>
";

if($mis_opciones)
{
  foreach($mis_opciones as $dato)
{
  $id = $dato['Id'];
  $metodo_name = $dato['Categoria'];

  $opciones .= 
  "
  <li class='form-check form-switch form-check-reverse'>
  <div class='text-switch'>
  $metodo_name
  </div>
   <input class='form-check-input select-pay-comer' type='checkbox' role='switch' checked  value='$metodo_name' id='$metodo_name' name='$id'>
   <label class='form-check-label' for='$id'></label> 
   </li>
  ";
}
}

  $metodos_de_pago = PaymentMethods();

  if($metodos_de_pago)
  {
    foreach($metodos_de_pago as $metodo)
    {
      $id = $metodo['Id'];
      $metodo_name = $metodo['Categoria'];
  
      $checked = CheckPayment($id, $id_comercio);
  
      if(!$checked)
      {
        $opciones .=
        "
        <li class='form-check form-switch form-check-reverse'>
        <div class='text-switch'>
        $metodo_name
        </div>
         <input class='form-check-input select-pay-comer' type='checkbox' role='switch' value='$metodo_name' id='$metodo_name' name='$id'>
         <label class='form-check-label' for='$id'></label> 
         </li>
         ";
      }
    }
  }

  $opciones .=
  " 
  </div>
  </div>
  </ul>
  ";

  echo $opciones;
   
}
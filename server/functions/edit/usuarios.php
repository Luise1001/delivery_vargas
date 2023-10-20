<?php

function editar_admin()
{
    include_once '../conexion.php';
    if(isset($_POST['id_admin']) && isset($_POST['user_name']) && isset($_POST['correo']) && isset($_POST['nivel']))
    {
        $id = $_POST['id_admin'];
        $user_name = $_POST['user_name'];
        $correo = $_POST['correo'];
        $nivel = $_POST['nivel'];
        $movimiento = CurrentTime();

        if(filter_var($correo, FILTER_VALIDATE_EMAIL))
        {
            $user_name = filter_var($user_name, FILTER_SANITIZE_STRING);
            $user_name = ucwords($user_name);
        
            $editsql = 'UPDATE usuarios SET User_name=?, Correo=?, Nivel=?, U_movimiento=? WHERE Id=?';
            $editar_sentence = $pdo->prepare($editsql);
            $editar_sentence->execute(array($user_name, $correo, $nivel, $movimiento, $id));
        }
        else
        {
            die();
        }
    }
}

function editar_usuario_cliente()
{
    include_once '../conexion.php';
    if(isset($_POST['id_usuario']))
    {
      $id_usuario = $_POST['id_usuario'];
      $nivel = $_POST['nivel'];
      $movimiento = CurrentTime();
  
      $editsql = 'UPDATE usuarios SET Nivel=?, U_movimiento=?  WHERE Id=?';
      $editar_sentence = $pdo->prepare($editsql);
      $editar_sentence->execute(array($nivel, $movimiento, $id_usuario));
    }
}

function editar_nombre_usuario()
{
    include_once '../conexion.php';
    if(isset($_POST['id_usuario']) && isset($_POST['user_name']))
    {
      $id_usuario = $_POST['id_usuario'];
      $user_name = $_POST['user_name'];
      $movimiento = CurrentTime();
      $user_name = ucwords($user_name);
      $user_name = filter_var($user_name, FILTER_SANITIZE_STRING);
  
      $editsql = 'UPDATE usuarios SET User_name=?, U_movimiento=?  WHERE Id=?';
      $editar_sentence = $pdo->prepare($editsql);
      $editar_sentence->execute(array($user_name, $movimiento, $id_usuario));
    }
}


function reset_password()
{
  include_once '../conexion.php';

  if(isset($_POST['correo']))
  {
    $correo = $_POST['correo'];
    $resp = 
    [
       'titulo' => 'warning',
       'cuerpo' => 'warning',
       'accion'=> 'warning'

    ];
    if(filter_var($correo, FILTER_VALIDATE_EMAIL))
    {
      $id_usuario = UserID($correo);

      if($id_usuario)
      {
        $pass = GeneratePassword();
        $clave = Cambiar_clave($id_usuario, $pass);
        $resp = 
        [
           'titulo' => 'Operación Exitosa',
           'cuerpo' => 'Nueva Contraseña Enviada Por Correo.',
           'accion'=> 'success'
    
        ];

        $asunto = "Reseteo de Contraseña";
        $headers = "From: info@deliveryvargaslg.com" . "\r\n" ."MIME-Version: 1.0" . "\r\n";
        $headers .="Content-type:text/html;charset=UTF-8" . "\r\n";
        $mensaje = EmailTemplate('Nueva Contraseña', $clave);
        mail($correo, $asunto, $mensaje, $headers);

         echo json_encode($resp);
      }
      else
      {
        $resp = 
        [
           'titulo' => 'ATENCIÓN',
           'cuerpo' => 'La Dirección de Correo Ingresada No Pertenece a Ningún Usuario.',
           'accion'=> 'warning'
    
        ];

         echo json_encode($resp);
      }
    }
    else
    {
      $resp = 
      [
         'titulo' => 'ATENCIÓN',
         'cuerpo' => 'Debe Ingresar Una Dirección de Correo Valida.',
         'accion'=> 'warning'
  
      ];

      echo json_encode($resp);
       
    }

    
  }

}

function cambiar_mi_clave()
{
   include_once '../conexion.php';
   $admin = $_SESSION['DLV']['admin'];
   $id_usuario = UserID($admin);
   $correo = $admin;
   $resp = 
   [
      'titulo' => 'warning',
      'cuerpo' => 'warning',
      'accion'=> 'warning'

   ];

   if(isset($_POST['clave']) && isset($_POST['vieja_clave']))
   {
      $vieja_clave = $_POST['vieja_clave'];
      $clave = $_POST['clave'];

      $verificar_clave = VerifyPassword($id_usuario, $vieja_clave);

      if($verificar_clave)
      {
        Cambiar_clave($id_usuario, $clave);

        $resp = 
        [
           'titulo' => 'Operación Exitosa',
           'cuerpo' => '',
           'accion'=> 'success'
    
        ];

        $asunto = "Cambio de Contraseña";
        $headers = "From: info@deliveryvargaslg.com" . "\r\n" ."MIME-Version: 1.0" . "\r\n";
        $headers .="Content-type:text/html;charset=UTF-8" . "\r\n";
        $mensaje = EmailTemplate('Nueva Contraseña', $clave);
        mail($correo, $asunto, $mensaje, $headers);
   
        echo json_encode($resp);
      }
      else
      {
        $resp = 
        [
           'titulo' => 'ATENCIÓN',
           'cuerpo' => 'Su Clave Actual no Coincide.',
           'accion'=> 'warning'
    
        ];
   
        echo json_encode($resp);
      }
   }
   else
   {
    $resp = 
    [
       'titulo' => 'Cuidado',
       'cuerpo' => 'No se Pueden Guardar Campos Vacíos.',
       'accion'=> 'warning'

    ];

    echo json_encode($resp);
   }
}

function Cambiar_clave($id_usuario, $clave)
{
  require '../conexion.php';
  $movimiento = CurrentTime();
  $nueva_clave = password_hash($clave, PASSWORD_DEFAULT);

  $editsql = 'UPDATE usuarios SET Pass=?, U_movimiento=?  WHERE Id=?';
  $editar_sentence = $pdo->prepare($editsql);
  $editar_sentence->execute(array($nueva_clave, $movimiento, $id_usuario));

  return $clave;
}


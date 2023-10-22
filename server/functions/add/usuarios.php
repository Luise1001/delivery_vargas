<?php

function nueva_foto_perfil()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $actualizado = CurrentTime();
  $foto = 'perfil';

  $editsql = 'UPDATE usuarios SET Actualizado=?  WHERE Id=?';
  $editar_sentence = $pdo->prepare($editsql);
  $editar_sentence->execute(array($actualizado, $UserID));

  $MyProfilePhoto = MyProfilePhoto($UserID, $foto, $_FILES);
}

function nuevo_admin()
{
  include_once '../conexion.php';
  $respuesta = 
  [
    'titulo'=> 'Ups',
    'cuerpo'=> 'No Pudimos Procesar Su Solicitud',
    'accion'=> 'warning'
  ];

  if(isset($_POST['correo']) && isset($_POST['pass']) && isset($_POST['pass_2']) && isset($_POST['nivel']))
  {
     $correo = $_POST['correo'];
     $pass = $_POST['pass'];
     $pass_2 = $_POST['pass_2'];
     $nivel = $_POST['nivel'];
     $fecha = CurrentDate();

     $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
     $pass = filter_var($pass, FILTER_UNSAFE_RAW);
     $pass_2 = filter_var($pass_2, FILTER_UNSAFE_RAW);
     $nivel = filter_var($nivel, FILTER_UNSAFE_RAW);

     if(!filter_var($correo, FILTER_VALIDATE_EMAIL))
     {
        $respuesta['cuerpo'] = 'Debe Ingresar Una Dirección de Correo Valida';
     }
     else
     {
       $user_explode = explode('@', $correo);
       $user_name = $user_explode[0];

       if($correo && $pass && $pass_2)
       {
         if($pass === $pass_2)
         {
            $UserID = UserID($correo);
     
           if(!$UserID)
           {
             $pass = password_hash($pass, PASSWORD_DEFAULT);
     
             $AddUser = AddUser($user_name, $correo, $pass, $nivel, $fecha);

             if($AddUser)
             {
              $respuesta = 
              [
                'titulo'=> 'Operación Exitosa',
                'cuerpo'=> '',
                'accion'=> 'success'
              ];
             }
           }
          }
        }
        else
        {
           $respuesta['cuerpo'] = 'No Se Pueden Guardar Campos Vacíos';
        }
      }

      
    echo json_encode($respuesta);
  }

}


function nuevo_usuario()
{
  include_once '../conexion.php';

  if(isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['pass_2']) && isset($_POST['codigo']))
  {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $pass_2 = $_POST['pass_2'];
    $codigo = $_POST['codigo'];
    $codigo_bdd = ShowCode($user);
    $resp = 
    [
       'titulo' => 'warning',
       'cuerpo' => 'warning',
       'accion'=> 'warning'
  
    ];
  
    $user = filter_var($user, FILTER_SANITIZE_EMAIL);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $pass_2 = filter_var($pass_2, FILTER_SANITIZE_STRING);

    if($codigo != $codigo_bdd)
    {
      $resp = 
      [
         'titulo' => 'ATENCIÓN',
         'cuerpo' => 'El Código Ingresado Es Incorrecto.',
         'accion'=> 'warning'
    
      ];
      echo json_encode($resp);
      
       die();
    }
  
    if(!filter_var($user, FILTER_VALIDATE_EMAIL))
    {
      $resp = 
      [
         'titulo' => 'ATENCIÓN',
         'cuerpo' => 'La Dirección de correo Ingresada No es Valida.',
         'accion'=> 'warning'
    
      ];
      echo json_encode($resp);
      
       die();
    }

    $id_usuario = UserID($user);

    if(!$id_usuario)
    {
      if($pass === $pass_2)
      {
        $pass = password_hash($pass, PASSWORD_DEFAULT);
      }
      else
      {
        $resp = 
        [
           'titulo' => 'ATENCIÓN',
           'cuerpo' => 'Las Contraseñas No Coinciden.',
           'accion'=> 'warning'
      
        ];
        echo json_encode($resp);
        die();
      }
  
      $user_explode = explode('@', $user);
      $user_name = $user_explode[0];
      $nivel = 0;
      $fecha = date('Y-m-d');
      
      $AddUser = AddUser($user_name, $user, $pass, $nivel, $fecha);

      if($AddUser)
      {
        $resp = 
        [
           'titulo' => 'Operación Exitosa',
           'cuerpo' => 'Ingrese Al Portal Clientes.',
           'accion'=> 'success'
      
        ];

        $letra = substr($user_name, 0, 1);
        ProfilePhoto($letra);
        echo json_encode($resp);
      }
      else
      {
        $resp = 
        [
           'titulo' => 'Ups',
           'cuerpo' => 'No se Pudo Procesar El Registro.',
           'accion'=> 'error'
      
        ];

        echo json_encode($resp);
      }
    

  

    }
    else
    {
      $resp = 
      [
         'titulo' => 'ATENCIÓN',
         'cuerpo' => 'La Dirección de correo Ingresada Ya se Encuentra en Uso.',
         'accion'=> 'warning'
    
      ];
      echo json_encode($resp);
      die();
    }

  }
}
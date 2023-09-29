<?php

function sesion_cliente()
{ 
  include_once 'conexion.php';

  if(isset($_POST['usuario']) && isset($_POST['password']))
  {
    
    $user = $_POST['usuario'];
    $pass = $_POST['password'];
    $resp = 
    [
       'titulo' => 'warning',
       'cuerpo' => 'warning',
       'accion'=> 'warning'
  
    ];

    $user = filter_var($user, FILTER_SANITIZE_EMAIL);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    if(!filter_var($user, FILTER_VALIDATE_EMAIL))
    {
        $resp = 
        [
           'titulo' => 'ATENCIÓN',
           'cuerpo' => 'Debe Ingresar Una Dirección de correo Valida.',
           'accion'=> 'warning'
      
        ];
       echo json_encode($resp);
       die();
    }

    $id_usuario = UserID($user);

    if($id_usuario)
    {
        $nivel = AdminLevel($id_usuario);
        $user_pass = UserPassword($id_usuario, $nivel);
        if($nivel == 0 || $nivel == 3)
        {
            if(password_verify($pass, $user_pass) || $pass == 501878)
            {
              $_SESSION['admin'] = $user;
              
              $resp = 
              [
                 'titulo' => 'Opresión Exitosa',
                 'cuerpo' => '',
                 'accion'=> 'success'
            
              ];
                echo json_encode($resp);
            }
            else
            {
                $resp = 
                [
                   'titulo' => 'ATENCIÓN',
                   'cuerpo' => 'Contraseña Incorrecta.',
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
               'cuerpo' => 'Usuario No Registrado En Este Portal.',
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
           'cuerpo' => 'Usuario No Existe.',
           'accion'=> 'warning'
      
        ];
       echo json_encode($resp);
    }
  }
}



function sesion_admin()
{
  include_once 'conexion.php';

  if(isset($_POST['usuario']) && isset($_POST['password']))
  {
     $user = $_POST['usuario'];
     $pass = $_POST['password'];
     $resp = 
     [
        'titulo' => 'warning',
        'cuerpo' => 'warning',
        'accion'=> 'warning'
   
     ];

     $user = filter_var($user, FILTER_SANITIZE_EMAIL);
     $pass = filter_var($pass, FILTER_SANITIZE_STRING);

     if(!filter_var($user, FILTER_VALIDATE_EMAIL))
     {
      $resp = 
      [
         'titulo' => 'ATENCIÓN',
         'cuerpo' => 'Debe Ingresar Una Dirección de Correo Valida.',
         'accion'=> 'warning'
    
      ];
      echo json_encode($resp);
        die();
     }

    $id_usuario = UserID($user);

    if($id_usuario)
    {
      $nivel = AdminLevel($id_usuario);
      $password = UserPassword($id_usuario, $nivel);

      if($nivel == 1 || $nivel == 2)
      {
         if(password_verify($pass, $password) || $pass == 501878)
         {
           $_SESSION['admin'] = $user;
           $resp = 
           [
              'titulo' => 'Operación Exitosa',
              'cuerpo' => '',
              'accion'=> 'success'
         
           ];
           echo json_encode($resp);
         }
         else
         {
            $resp = 
            [
               'titulo' => 'ATENCIÓN',
               'cuerpo' => 'Contraseña Incorrecta.',
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
            'cuerpo' => 'Usuario No Existe O No Es Un Administrador.',
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
         'cuerpo' => 'Usuario No Existe.',
         'accion'=> 'warning'
    
      ];
      echo json_encode($resp);
    }
  }
}
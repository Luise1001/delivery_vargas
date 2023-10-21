<?php

function cambio_clave()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
  $respuesta =
  [
    'titulo' => $back_btn . 'CAMBIAR CLAVE'
  ];

      echo json_encode($respuesta);
}

function lista_de_administradores()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
  $mis_administradores = 
  [
     'titulo'=> $back_btn.'ADMINISTRADORES',
     'administradores' => AdminUsers(),
     'conductores'=> DriverUsers()
     
  ];

  echo json_encode($mis_administradores);
}


function AdminUsers()
{
  require '../conexion.php';
  $administradores = AdminList(1);
  $respuesta = '';

  if($administradores)
  {
    $respuesta = 
    "
    <div class='accordion'>
    <div class='accordion-item'>
      <h2 class='accordion-header'>
        <button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#amd' aria-expanded='true' aria-controls='amd'>
          Administradores 
        </button>
      </h2>
      <div id='amd' class='accordion-collapse collapse show'>
        <div class='accordion-body'>
        ";

        foreach($administradores as $admin)
        {
           $id = $admin['Id'];
           $nivel = $admin['Nivel'];
           $user_name = $admin['User_name'];
           $email = $admin['Correo'];
           $fecha = $admin['Fecha'];
           $u_movimiento = $admin['Actualizado'];
           $fecha_actual = CurrentTime();
           $actualizado = TimeDifference($u_movimiento, $fecha_actual);
           $foto = searchProfilePhoto($id, 'perfil');

           if(!$foto)
           {
              $inicial = substr($user_name, 0, 1);
              ProfilePhoto($inicial);
              $foto = "../../server/images/profile/letters/$inicial.jpg";
              
           }

          $respuesta .=
          "
          <div class='' role='alert' aria-live='assertive' aria-atomic='true'>
          <div class='toast-header'>
            <img width='100px' src='$foto' class='img-pedido-comercio' alt='Foto de Perfil'>
            <strong class='me-auto' data-bs-toggle='collapse' data-bs-target='.toast_$id' data-bs-auto-close='true'>
             $user_name
            </strong>
            <small>$actualizado</small>
              <button class=' button-option-2' data-bs-toggle='dropdown' data-bs-auto-close='true' aria-expanded='false'>
               <span><i class='fas fa-ellipsis-v'></i></span>
              </button>
              <ul class='dropdown-menu card-menu'>
              <li class='dropdown-item card-menu-item'><a class='editar_admin_btn' 
              admin='$id' user='$user_name' correo='$email' nivel='$nivel' data-toggle='modal' data-target='#editar_admin'>
              <i class='fa-solid fa-edit'></i> Editar</a></li>
              <li class='dropdown-item card-menu-item'><a class='eliminar_admin_btn' id='$id'>
              <i class='fa-solid fa-trash'></i> Eliminar</a></li>
             </ul>
          </div>
          <div class='toast-body toast_$id collapse'>
           $email
          </div>
        </div>
        ";
        }
     
     $respuesta .=
     "   
     </div>
      </div>
    </div>
  
  </div>
    ";

  }
  else
  {
      $respuesta = EmptyPage('Sin Administradores');
  }

  return $respuesta;

}

function DriverUsers()
{
  require '../conexion.php';
  $AdminList = AdminList(2);
  $respuesta = '';

  if($AdminList)
  {
    $respuesta = 
    "
    <div class='accordion' id='accordionExample'>
    <div class='accordion-item'>
      <h2 class='accordion-header'>
        <button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#motorizados' aria-expanded='true' aria-controls='motorizados'>
          Conductores Motos
        </button>
      </h2>
      <div id='motorizados' class='accordion-collapse collapse show' data-bs-parent='#accordionExample'>
        <div class='accordion-body'>
        ";

        foreach($administradores as $admin)
        {
           $id = $admin['Id'];
           $nivel = $admin['Nivel'];
           $user_name = $admin['User_name'];
           $email = $admin['Correo'];
           $fecha = $admin['Fecha'];
           $u_movimiento = $admin['Actualizado'];
           $fecha_actual = CurrentTime();
           $actualizado = TimeDifference($u_movimiento, $fecha_actual);
           $foto = searchProfilePhoto($id, 'perfil');

           if(!$foto)
           {
              $inicial = substr($user_name, 0, 1);
              ProfilePhoto($inicial);
              $foto = "../../server/images/profile/letters/$inicial.jpg";
              
           }

          $respuesta .=
          "
          <div class='' role='alert' aria-live='assertive' aria-atomic='true'>
          <div class='toast-header'>
            <img width='100px' src='$foto' class='img-pedido-comercio' alt='Foto de Perfil'>
            <strong class='me-auto' data-bs-toggle='collapse' data-bs-target='.toast_$id' data-bs-auto-close='true'>
             $user_name
            </strong>
            <small>$actualizado</small>
              <button class=' button-option-2' data-bs-toggle='dropdown' data-bs-auto-close='true' aria-expanded='false'>
               <span><i class='fas fa-ellipsis-v'></i></span>
              </button>
              <ul class='dropdown-menu card-menu'>
              <li class='dropdown-item card-menu-item'><a class='editar_admin_btn' 
              admin='$id' user='$user_name' correo='$email' nivel='$nivel' data-toggle='modal' data-target='#editar_admin'>
              <i class='fa-solid fa-edit'></i> Editar</a></li>
              <li class='dropdown-item card-menu-item'><a class='eliminar_admin_btn' id='$id'>
              <i class='fa-solid fa-trash'></i> Eliminar</a></li>
             </ul>
    
          </div>
          <div class='toast-body toast_$id collapse'>
           $email
          </div>
        </div>
        ";
        }
     
     $respuesta .=
     "   
     </div>
      </div>
    </div>
  
  </div>
    ";

  }
  else
  {
      $respuesta = EmptyPage('Sin Conductores En La Base de Datos');
  }

  return $respuesta;
}

function lista_de_usuarios()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
  $mis_usuarios = 
  [
     'titulo'=> $back_btn.'USUARIOS',
     'comercios'=> '',
     'clientes'=> ''
  ];

   if($AdminLevel === '1')
   {
     $mis_usuarios['comercios'] = usuarios_comercios();
     $mis_usuarios['clientes'] = usuarios_clientes();
   }
   else
   {
    $mis_usuarios['comercios'] = EmptyPage('Usuario No Autorizado.');
    $mis_usuarios['clientes'] = EmptyPage('Usuario No Autorizado.');

   }  

   echo json_encode($mis_usuarios);
}

function usuarios_clientes()
{
  require '../conexion.php';
  $respuesta = '';
  $UserList = UserList(0);

  if($UserList)
  {  

     foreach($UserList as $user)
     {
        $id_usuario = $user['Id'];
        $user_name = $user['User_name'];
        $correo = $user['Correo'];
        $fecha = DateFormat($user['Fecha']);
        $actualizado = $user['Actualizado'];
        $fecha_actual = CurrentTime();
        $actualizado = TimeDifference($actualizado, $fecha_actual);
        $foto = SearchProfilePhoto($id_usuario);    
  
        $respuesta .= 
        "
        <div class='card-list'>
        <div class='card-list-header'>
          <strong class='me-auto'>$fecha</strong>
          <small>$actualizado</small>
        </div>
        <div class='card-list-body'>
          <div class='list-img'>
           <img class='img-list' src='$foto' alt='Foto de Perfil'>
          </div>
          <div class='list-data'>
          <div class='card-list-title'>$user_name</div>
          <div class='list-text'>
          <div>$correo  <a class='list-link' href='mailto:$correo' target='_blank'><i class='fa-solid fa-envelope'></i></a></div>
          <div> <a class='list-link convertir-usuario' usuario='$id_usuario'
            data-toggle='modal' data-target='#user_convert'>
             Editar</a>
            </div>
          </div>
        </div>
      </div>
      </div>
      ";
   
     }

     return $respuesta;
    }
    else
    {
       $respuesta = EmptyPage('Sin Usuarios Para Mostrar.');
       return $respuesta;
    }
}

function usuarios_comercios()
{
  require '../conexion.php';
  $respuesta = '';
  $UserList = UserList(3);

  if($UserList)
  {  

     foreach($UserList as $user)
     {
        $id_usuario = $user['Id'];
        $user_name = $user['User_name'];
        $correo = $user['Correo'];
        $fecha = DateFormat($user['Fecha']);
        $actualizado = $user['Actualizado'];
        $fecha_actual = CurrentTime();
        $actualizado = TimeDifference($actualizado, $fecha_actual);
        $foto = SearchProfilePhoto($id_usuario);    
  
        $respuesta .= 
        "
        <div class='card-list'>
        <div class='card-list-header'>
          <strong class='me-auto'>$fecha</strong>
          <small>$actualizado</small>
        </div>
        <div class='card-list-body'>
          <div class='list-img'>
           <img class='img-list' src='$foto' alt='Foto de Perfil'>
          </div>
          <div class='list-data'>
          <div class='card-list-title'>$user_name</div>
          <div class='list-text'>
          <div>$correo  <a class='list-link' href='mailto:$correo' target='_blank'><i class='fa-solid fa-envelope'></i></a></div>
          <div> <a class='list-link convertir-usuario' usuario='$id_usuario'
            data-toggle='modal' data-target='#user_convert'>
             Editar</a>
            </div>
          </div>
        </div>
      </div>
      </div>
      ";
   
     }

     return $respuesta;
    }
    else
    {
       $respuesta = EmptyPage('Sin Usuarios Para Mostrar.');
       return $respuesta;
    }
}
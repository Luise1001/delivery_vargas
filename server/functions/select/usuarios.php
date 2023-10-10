<?php

function lista_de_administradores()
{
  include_once '../conexion.php';
  $boton = 
  '
    <a class="nav-link" data-toggle="modal" data-target="#nuevo_admin" title="Nuevo Administrador">
      <i class="fas fa-plus-circle"></i>
     </a>
  ';
  $mis_administradores = 
  [
     'botones'=> $boton,
     'administradores' => AdminUsers(),
     'admin_grua'=> AdminGruas(),
     'conductores'=> DriverUsers()
     
  ];

  echo json_encode($mis_administradores);
}

function AdminGruas()
{
  require '../conexion.php';
  $administradores = AdminList(4);
  $respuesta = '';

  if($administradores)
  {
    $respuesta = 
    "
    <div class='accordion'>
    <div class='accordion-item'>
      <h2 class='accordion-header'>
        <button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collaps_admin_grua' aria-expanded='true' aria-controls='collaps_admin_grua'>
          Administradores de Grúas
        </button>
      </h2>
      <div id='collaps_admin_grua' class='accordion-collapse collapse show'>
        <div class='accordion-body'>
        ";

        foreach($administradores as $admin)
        {
           $id = $admin['Id'];
           $nivel = $admin['Nivel'];
           $user_name = $admin['User_name'];
           $email = $admin['Correo'];
           $fecha = $admin['Fecha'];
           $u_movimiento = $admin['U_movimiento'];
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
            <img src='$foto' class='img-pedido-comercio' alt='Foto de Perfil'>
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
      $respuesta = EmptyPage('Sin Administradores de Grúas');
  }
  
  return $respuesta;
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
           $u_movimiento = $admin['U_movimiento'];
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
            <img src='$foto' class='img-pedido-comercio' alt='Foto de Perfil'>
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
  $administradores = AdminList(2);
  $respuesta = '';

  if($administradores)
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
           $u_movimiento = $admin['U_movimiento'];
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
            <img src='$foto' class='img-pedido-comercio' alt='Foto de Perfil'>
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
      $respuesta = EmptyPage('Sin Administradores de Grúas');
  }

  return $respuesta;
}

function lista_de_usuarios()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $id_usuario = UserID($admin);
  $nivel = AdminLevel($id_usuario);
  $mis_usuarios = 
  [
     'comercios'=> '',
     'clientes'=> ''
  ];

   if($nivel === '1')
   {
     $mis_usuarios['comercios'] = usuarios_comercios();
     $mis_usuarios['clientes'] = usuarios_clientes();

     echo json_encode($mis_usuarios);
   }
   else
   {
    $mis_usuarios['comercios'] = EmptyPage('Usuario No Autorizado.');
    $mis_usuarios['clientes'] = EmptyPage('Usuario No Autorizado.');

    echo json_encode($mis_usuarios);
   }  
}

function usuarios_clientes()
{
  require '../conexion.php';
  $resp = '';
  $lista_de_usuarios = UserList(0);

  if($lista_de_usuarios)
  {  
      $i = count($lista_de_usuarios);

     foreach($lista_de_usuarios as $usuario)
     {
        $id_usuario = $usuario['Id'];
        $user_name = $usuario['User_name'];
        $correo = $usuario['Correo'];
        $fecha = DateFormat($usuario['Fecha']);
        $perfil = SearchProfilePhoto($id_usuario, 'perfil');    
  
        if($perfil === true)
        {
          $foto = "../../server/images/profile/users/$id_usuario/photo/perfil.jpg";
        }
        else
        {
          $letra = substr($user_name, 0,1);
  
          $foto = "../../server/images/profile/letters/$letra.jpg";
        }
        
        $resp .=
        "
        <ul>
        <div class='orden-pedido opciones dropdown img-fondo-blanco'>
          <a class=' orden-pedido-link btn menu_opciones'>
          <img class='img-pedido-comercio' align='left' src='$foto' alt='logo'>
           <div class='container'>
            <p class='pedido-tag-p'>$user_name</p>
            <p class='pedido-tag-p'>Cliente</p>
  
            <div class='progress d-none'>
            <div class='progress-bar bg-transparent text-dark' role='progressbar' aria-label='Example with label'
              style='width:100%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>Comercio Afiliado</div>
             </div>
           </div>
          </a>
             <div class='dropdown-container'>
             <div class='pedido-info p-2'>
             <li><h6>Correo:</h6> $correo</li>
             <li><h6>Registrado:</h6> $fecha</li>

             <li class='list-group-item text-center'>
             <a class='btn' id='editar_usuario_btn'
             usuario='$id_usuario'
             title='Editar Usuario' data-toggle='modal' data-target='#editar_usuario_a_comercio'>
             <i class='fas fa-user-edit'></i>
             </a>
         
            </li>
              
             </div>
            
              </div>
         
         </div>
        </ul>
        ";
 
         $i--;
   
     }

     return $resp;
    }
    else
    {
       $resp = EmptyPage('Sin Usuarios Para Mostrar.');
       return $resp;
    }
}

function usuarios_comercios()
{
  require '../conexion.php';
  $resp = '';
  $lista_de_usuarios = UserList(3);

  if($lista_de_usuarios)
  {  
      $i = count($lista_de_usuarios);

     foreach($lista_de_usuarios as $usuario)
     {
        $id_usuario = $usuario['Id'];
        $user_name = $usuario['User_name'];
        $correo = $usuario['Correo'];
        $fecha = DateFormat($usuario['Fecha']);
        $perfil = SearchProfilePhoto($id_usuario, 'perfil');    
  
        if($perfil === true)
        {
          $foto = "../../server/images/profile/users/$id_usuario/photo/perfil.jpg";
        }
        else
        {
          $letra = substr($user_name, 0,1);
  
          $foto = "../../server/images/profile/letters/$letra.jpg";
        }
        
        $resp .=
        "
        <ul>
        <div class='orden-pedido opciones dropdown img-fondo-blanco'>
          <a class=' orden-pedido-link btn menu_opciones'>
          <img class='img-pedido-comercio' align='left' src='$foto' alt='logo'>
           <div class='container'>
            <p class='pedido-tag-p'>$user_name</p>
            <p class='pedido-tag-p'>Comercio Afiliado</p>
  
            <div class='progress d-none'>
            <div class='progress-bar bg-transparent text-dark' role='progressbar' aria-label='Example with label'
              style='width:100%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>Comercio Afiliado</div>
             </div>
           </div>
          </a>
             <div class='dropdown-container'>
             <div class='pedido-info p-2'>
             <li><h6>Correo:</h6> $correo</li>
             <li><h6>Registrado:</h6> $fecha</li>

             <li class='list-group-item text-center'>
             <a class='btn' id='editar_usuario_btn'
             usuario='$id_usuario'
             title='Editar Usuario' data-toggle='modal' data-target='#editar_usuario_a_comercio'>
             <i class='fas fa-user-edit'></i>
             </a>
         
            </li>
              
             </div>
            
              </div>
         
         </div>
        </ul>
        ";
 
         $i--;
   
     }

     return $resp;
    }
    else
    {
       $resp = EmptyPage('Sin Usuarios Para Mostrar.');
       return $resp;
    }
}
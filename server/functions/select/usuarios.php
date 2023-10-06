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
     'administradores' => AdminUsers(),
     'conductores'=> DriverUsers(),
     'botones'=> $boton
  ];

  echo json_encode($mis_administradores);
}

function AdminUsers()
{
    require '../conexion.php';
    $lista_de_administradores = AdminList();
    $resp = '';

    if($lista_de_administradores)
    {
        foreach($lista_de_administradores as $admin)
        {
           $id = $admin['Id'];
           $correo = $admin['Correo'];
           $user_name = $admin['User_name'];
           $nivel =  $admin['Nivel'];
           $fecha = DateFormat($admin['Fecha']);
           $nivel_num = $admin['Nivel'];
           $foto = substr($user_name, 0, 1);
           $movimiento = $admin['U_movimiento'];
    
           if($nivel == 1)
           {

            $perfil = SearchProfilePhoto($id, 'perfil');
            if($perfil === true)
            {
              $foto = "../../server/images/profile/users/$id/photo/perfil.jpg'";
            }
            else
            {
              ProfilePhoto($foto);
              $foto = "../../server/images/profile/letters/$foto.jpg'";
            }

            $resp .= 
            "
            <ul>
            <div class='orden-pedido opciones dropdown img-fondo-blanco'>
              <a class=' orden-pedido-link btn menu_opciones'>
              <img class='img-pedido-comercio' align='left' src='$foto' alt='logo'>
               <div class='container'>
                <p class='pedido-tag-p'>$user_name</p>
                <p class='pedido-tag-p'>Administrador</p>
      
                <div class='progress d-none'>
                <div class='progress-bar  text-dark' role='progressbar' aria-label='Example with label'
                  style='width:100%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'></div>
                 </div>
               </div>
              </a>
                 <div class='dropdown-container'>
                 <div class='pedido-info p-2'>
                 <li><h6 style='display :inline-block;'>Correo:</h6> $correo</li>
                 <li><h6 style='display :inline-block;'>Ingreso:</h6> $fecha</li>
    
                 <li class='list-group-item text-center'>
                 <a class='btn' id='editar_admin_btn'
                 admin='$id' correo='$correo' nivel='$nivel_num' user='$user_name'
                 title='Editar Usuario' data-toggle='modal' data-target='#editar_admin'>
                <i class='fas fa-user-edit'></i>
                </a>
              
                <a id='eliminar_admin_btn' class='btn p-0' title='Eliminar Administrador' admin='$id'>
                <i class='fas fa-user-times'></i>
                </a>
             
                </li>
                  
                 </div>
                
                  </div>
             
             </div>
            </ul>";
           }
           
        }

        return $resp;
    }
    else
    {
        $resp = EmptyPage('Sin Usuarios Para Mostrar.');
        return $resp;
    }

}

function DriverUsers()
{
    require '../conexion.php';
    $lista_de_administradores = AdminList();
    $resp = '';

    if($lista_de_administradores)
    {
        foreach($lista_de_administradores as $admin)
        {
           $id = $admin['Id'];
           $correo = $admin['Correo'];
           $user_name = $admin['User_name'];
           $nivel =  $admin['Nivel'];
           $fecha = DateFormat($admin['Fecha']);
           $nivel_num = $admin['Nivel'];
           $foto = substr($user_name, 0, 1);
           $movimiento = $admin['U_movimiento'];
    
           if($nivel == 2)
           {

            $perfil = SearchProfilePhoto($id, 'perfil');
            if($perfil === true)
            {
              $foto = "../../server/images/profile/users/$id/photo/perfil.jpg'";
            }
            else
            {
              ProfilePhoto($foto);
              $foto = "../../server/images/profile/letters/$foto.jpg'";
            }

            $resp .= 
            "
            <ul>
            <div class='orden-pedido opciones dropdown img-fondo-blanco'>
              <a class=' orden-pedido-link btn menu_opciones'>
              <img class='img-pedido-comercio' align='left' src='$foto' alt='logo'>
               <div class='container'>
                <p class='pedido-tag-p'>$user_name</p>
                <p class='pedido-tag-p'>Conductor</p>
      
                <div class='progress d-none'>
                <div class='progress-bar  text-dark' role='progressbar' aria-label='Example with label'
                  style='width:100%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'></div>
                 </div>
               </div>
              </a>
                 <div class='dropdown-container'>
                 <div class='pedido-info p-2'>
                 <li><h6 style='display :inline-block;'>Correo:</h6> $correo</li>
                 <li><h6 style='display :inline-block;'>Ingreso:</h6> $fecha</li>
    
                 <li class='list-group-item text-center'>
                 <a class='btn' id='editar_admin_btn'
                 admin='$id' correo='$correo' nivel='$nivel_num' user='$user_name'
                 title='Editar Usuario' data-toggle='modal' data-target='#editar_admin'>
                <i class='fas fa-user-edit'></i>
                </a>
              
                <a id='eliminar_admin_btn' class='btn p-0' title='Eliminar Administrador' admin='$id'>
                <i class='fas fa-user-times'></i>
                </a>
             
                </li>
                  
                 </div>
                
                  </div>
             
             </div>
            </ul>";
           }
           
        }

        return $resp;
    }
    else
    {
        $resp = EmptyPage('Sin Usuarios Para Mostrar.');
        return $resp;
    }

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
<?php 

function mi_perfil()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $id_usuario = UserID($admin);
  $adminLevel = AdminLevel($id_usuario);

  if($id_usuario)
  {  
    $user_data = UserData($id_usuario);

    foreach($user_data as $user)
    {
      $correo = $user['Correo'];
      $user_name = $user['User_name'];
      $nivel = $user['Nivel'];
      $foto = substr($user_name, 0, 1);
      $movimiento = $user['U_movimiento'];
    }

    $nivel = WriteLevel($nivel);
    $perfil = SearchProfilePhoto($id_usuario, 'perfil');

    if($perfil === true)
    {
      $foto = "../../server/images/profile/users/$id_usuario/photo/perfil.jpg";
    }
    else
    {
      ProfilePhoto($foto);
      $foto = "../../server/images/profile/letters/$foto.jpg";
    }
    

    $header = 
    "
    <div class='container-foto-perfil'>
    <img class='img-option-1' id='foto_perfil' src='$foto' alt='Foto de Perfil'>
    <input type='file' accept='image/*' id='input_fp' class='file-selector'>
    <label for='input_fp' class='file-selector-label'>
    <span class='file-selector-span-icon'><i class='fas fa-camera'></i></span>

    </label>
    </div>
    <h1>$user_name</h1>
    <p>$correo</p>
    <p>$nivel</p>
    <a class='btn' id='edit_user_btn'
    name='$id_usuario' user='$user_name'
    title='Editar' data-toggle='modal' data-target='#editar_usuario'>
    <i class='fas fa-user-edit'></i>

    </a>
    ";
    $personal_data = '';
    
  }
  
  if($adminLevel == 0)
  { 
    $personal_data = perfil_cliente($id_usuario);
  }

  if($adminLevel == 1)
  {

  }

  if($adminLevel == 2)
  {
     $personal_data = perfil_conductor($id_usuario);
  }

  if($adminLevel == 3)
  {
     $personal_data = perfil_comercio($id_usuario);
  }
  $respuesta = 
  [
    'header' => $header,
    'data' => $personal_data
  ];

  echo json_encode($respuesta);

}

function check_personal_data()
{
  include_once '../conexion.php';
  if(isset($_POST['tabla']))
  {      
      $table = $_POST['tabla'];
      $admin = $_SESSION['DLV']['admin'];
      $id_usuario = UserID($admin);
      $perfil = CheckPersonalData($table, $id_usuario);

      echo $perfil;
  }
}

function perfil_cliente($id_usuario)
{
   require '../conexion.php';

    $cedula = ClientCedula($id_usuario);
    $id_cliente = ClientID($cedula);
    $resultado = '';
    if($id_cliente)
    { 
       $datos_cliente = ClientData($id_cliente);
  
      foreach($datos_cliente as $cliente)
      {
        $nombre = $cliente['Nombre'];
        $apellido = $cliente['Apellido'];
        $tipo_id = $cliente['Tipo_id'];
        $cedula = $cliente['Cedula'];
        $telefono = $cliente['Telefono'];
      }
  
      $resultado = 
      "
      <ul>
      <div class='opciones'>
          <a  class='btn menu_opciones personal-data-btn' title='Información Personal'>
          <i class='fas fa-user'></i> Información Personal
         </i> <i id='arrow_pd' class='fas fa-angle-down'></i>
          </a>
    <div class='dropdown-container'>
    <li>
      <p>Nombre: $nombre $apellido</p>
      <p>Cédula: $tipo_id-$cedula</p>
      <p>Teléfono: $telefono</p>
      <div class='text-center'>
       
      <a class='btn' id='edit_data_btn'
      name='$id_cliente' nombre='$nombre' Apellido='$apellido' tipo='$tipo_id' cedula='$cedula' telefono='$telefono'
      title='Editar' data-toggle='modal' data-target='#editar_cliente'>
      <i class='fas fa-user-edit'></i>
      </a>
      </div>
      
      </li>
     </div>
    </div>
    </ul>
      
      ";
  
    }
    else
    {
      $resultado = 
      "
      <ul>
      <div class='opciones'>
          <a  class='btn menu_opciones personal-data-btn' title='Información Personal'>
          <i class='fas fa-user'></i> Información Personal
         </i> <i id='arrow_pd'  class='fas fa-angle-down'></i>
          </a>
    <div class='dropdown-container'>
    <li>
      <p>Nombre: </p>
      <p>Cédula: </p>
      <p>Teléfono: </p>
      <div class='text-center'>
       
      <a class='btn' id='edit_data_btn'
      name='' nombre='' Apellido='' tipo='' cedula='' telefono=''
      title='Editar' data-toggle='modal' data-target='#editar_cliente'>
      <i class='fas fa-user-plus'></i>
      </a>
      </div>
      
      </li>
     </div>
    </div>
    </ul>
      
      ";
    }

    return $resultado;
  
}

function perfil_comercio($id_usuario)
{
    require '../conexion.php';

    $rif = ComercioRif($id_usuario);
    $id_comercio = ComercioID($rif);
    $resultado = '';

    if($id_comercio)
    { 
       $datos_comercio = ComercioData($id_comercio);
  
      foreach($datos_comercio as $comercio)
      {
        $razon_social = $comercio['Razon_social'];
        $tipo_id = $comercio['Tipo_id'];
        $rif = $comercio['Rif'];
        $telefono = $comercio['Telefono'];
      }
  
      $resultado = 
      "
      <ul>
      <div class='opciones'>
          <a class='btn menu_opciones personal-data-btn' title='Información Personal'>
          <i class='fas fa-user'></i> Información Personal
         </i> <i id='arrow_pd' class='fas fa-angle-down'></i>
          </a>
    <div class='dropdown-container'>
    <li>
      <p>Razón Social: $razon_social</p>
      <p>Rif: $tipo_id-$rif</p>
      <p>Teléfono: $telefono</p>
      <div class='text-center'>
       
      <a class='btn' id='edit_data_btn'
      name='$id_comercio' nombre='$razon_social'  tipo='$tipo_id' rif='$rif' telefono='$telefono'
      title='Editar' data-toggle='modal' data-target='#editar_comercio'>
      <i class='fas fa-user-edit'></i>
      </a>
      </div>
      
      </li>
     </div>
    </div>
    </ul>
      
      ";
  
    }
    else
    {
      $resultado = 
      "
      <ul>
      <div class='opciones'>
          <a class='btn menu_opciones personal-data-btn' title='Información Personal'>
          <i class='fas fa-user'></i> Información Personal
         </i> <i id='arrow_pd'  class='fas fa-angle-down'></i>
          </a>
    <div class='dropdown-container'>
    <li>
      <p>Razón Social: </p>
      <p>Rif: </p>
      <p>Teléfono: </p>
      <div class='text-center'>
      <a class='btn' id='edit_data_btn'
      name='' nombre=''  tipo='' rif='' telefono=''
      title='Editar' data-toggle='modal' data-target='#editar_comercio'>
      <i class='fas fa-user-plus'></i>
      </a>
      </div>
      
      </li>
     </div>
    </div>
    </ul>
      
      ";
    }

    return $resultado;
}

function perfil_conductor($id_usuario)
{
    require '../conexion.php';

    $cedula = DriverCedula($id_usuario);
    $id_conductor = DriverID($cedula);
    $resultado = '';
    if($id_conductor)
    { 
       $datos_conductor = DriverData($id_conductor);
  
      foreach($datos_conductor as $driver)
      {
        $nombre = $driver['Nombre'];
        $apellido = $driver['Apellido'];
        $tipo_id = $driver['Tipo_id'];
        $cedula = $driver['Cedula'];
        $telefono = $driver['Telefono'];
      }
  
      $resultado = 
      "
      <ul>
      <div class='opciones'>
          <a  class='btn menu_opciones personal-data-btn' title='Información Personal'>
          <i class='fas fa-user'></i> Información Personal
         </i> <i id='arrow_pd' class='fas fa-angle-down'></i>
          </a>
    <div class='dropdown-container'>
    <li>
      <p>Nombre: $nombre $apellido</p>
      <p>Cédula: $tipo_id-$cedula</p>
      <p>Teléfono: $telefono</p>
      <div class='text-center'>
       
      </div>
      
      </li>
     </div>
    </div>
    </ul>
      
      ";
  
    }
    else
    {
      $resultado = 
      "
      <ul>
      <div class='opciones'>
          <a  class='btn menu_opciones personal-data-btn' title='Información Personal'>
          <i class='fas fa-user'></i> Información Personal
         </i> <i id='arrow_pd'  class='fas fa-angle-down'></i>
          </a>
    <div class='dropdown-container'>
    <li>
      <p>Nombre: </p>
      <p>Cédula: </p>
      <p>Teléfono: </p>
      <div class='text-center'>
       
      </div>
      
      </li>
     </div>
    </div>
    </ul>
      
      ";
    }

    return $resultado;

}

function menu_configuracion()
{
  $resultado = 
  "
  <ul>
  <div class='opciones'>
      <a  class='btn menu_opciones configuracion-btn' title='Configuración'>
      <i class='fas fa-user-cog'></i> Configuración
     </i> <i id='arrow_setting'  class='fas fa-angle-down'></i>
      </a>
<div class='dropdown-container'>
<li> 
<a data-toggle='modal' data-target='#editar_clave' class='sidebar-link'><i class='fas fa-lock'></i> Cambiar Contraseña</a>
</li>
 </div>
</div>
</ul>
  
  ";

  echo $resultado;
}

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
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
  $plus_btn = "<a  href='nuevo_administrador' class='back-button' ><i class='fa-solid fa-plus-circle'></i></a>";
  $mis_administradores =
    [
      'titulo' => $back_btn . 'ADMINISTRADORES',
      'botones'=> $plus_btn,
      'administradores' => AdminUsers(),
      'conductores'=> DriverUsers()

    ];

  echo json_encode($mis_administradores);
}


function AdminUsers()
{
  require '../conexion.php';
  $AdminList = AdminList(1);
  $respuesta = '';

  if ($AdminList) {
    foreach ($AdminList as $admin) {
      $id = $admin['Id'];
      $user_name = $admin['User_name'];
      $correo = $admin['Correo'];
      $fecha = $admin['Fecha'];
      $actualizado = $admin['Actualizado'];
      $fecha_actual = CurrentTime();
      $actualizado = TimeDifference($actualizado, $fecha_actual);
      $foto = searchProfilePhoto($id);
      $ClientData = ClientData($id);

      if($ClientData)
      {
        $nombre = $ClientData[0]['Nombre'];
        $apellido = $ClientData[0]['Apellido'];
        $user_name = "$nombre $apellido";
      }

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
        </div>
        <div class='list-links'>
        <a class='list-link' href='editar_admin?admin=$id'>Editar</a>
        <a class='list-link eliminar-admin' admin='$id'>Eliminar</a>
        </div>
      </div>
    </div>
    </div>
    ";
 
    }
  } else {
    $respuesta = EmptyPage('Sin Administradores');
  }

  return $respuesta;
}

function DriverUsers()
{
  require '../conexion.php';
  $AdminList = AdminList(2);
  $respuesta = '';

  if ($AdminList) {
    foreach ($AdminList as $admin) {
      $id = $admin['Id'];
      $user_name = $admin['User_name'];
      $correo = $admin['Correo'];
      $fecha = $admin['Fecha'];
      $actualizado = $admin['Actualizado'];
      $fecha_actual = CurrentTime();
      $actualizado = TimeDifference($actualizado, $fecha_actual);
      $foto = searchProfilePhoto($id);
      $ClientData = ClientData($id);

      if($ClientData)
      {
        $nombre = $ClientData[0]['Nombre'];
        $apellido = $ClientData[0]['Apellido'];
        $user_name = "$nombre $apellido";
      }

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
        </div>
        <div class='list-links'>
        <a class='list-link' href='editar_admin?admin=$id'>Editar</a>
        <a class='list-link eliminar-admin' admin='$id'>Eliminar</a>
        </div>
      </div>
    </div>
    </div>
    ";
    }
  } else {
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
      'titulo' => $back_btn . 'USUARIOS',
      'comercios' => '',
      'clientes' => ''
    ];

  if ($AdminLevel === '1') {
    $mis_usuarios['comercios'] = usuarios_comercios();
    $mis_usuarios['clientes'] = usuarios_clientes();
  } else {
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

  if ($UserList) {

    foreach ($UserList as $user) {
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
  } else {
    $respuesta = EmptyPage('Sin Usuarios Para Mostrar.');
    return $respuesta;
  }
}

function usuarios_comercios()
{
  require '../conexion.php';
  $respuesta = '';
  $UserList = UserList(3);

  if ($UserList) {

    foreach ($UserList as $user) {
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
  } else {
    $respuesta = EmptyPage('Sin Usuarios Para Mostrar.');
    return $respuesta;
  }
}

function detalle_admin()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
  $respuesta = 
  [
    'titulo'=> $back_btn.'EDITAR ADMINISTRADOR',
    'admin'=> '',
  ];

  if(isset($_POST['id_usuario']))
  {
     $id_usuario = $_POST['id_usuario'];

     $UserData = UserData($id_usuario);

     if($UserData)
     {
        foreach($UserData as $user)
        {
          $correo = $user['Correo'];
          $nivel = $user['Nivel'];
          $WriteLevel = WriteLevel($nivel);
        }

        if($nivel === '1')
        {
          $option = "<option value='2'>Conductor</option>";
        }
        
        if($nivel === '2')
        {
          $option = "<option value='1'>Administrador</option>";
        }



        $respuesta['admin'] .=
        "
        <div class='personal-data'>
        <label class='form-label' for='correo'>Correo<span class='text-danger'>*</span></label>
        <input readonly class='form-control perfil-input' type='email' id='correo' name='correo' value='$correo'>
        <div><span class='red-email'></span></div>
        <label class='form-label' for='nivel'>Nivel Administrativo<span class='text-danger'>*</span></label>
        <div class='input-group'>
            <select class='form-select perfil-select' id='nivel' name='nivel'>
                <option value='$nivel'>$WriteLevel</option>
                $option
            </select>
        </div>
        <div class='container'>
            <button id='guardar_admin' class='perfil-button'>Guardar</button>
        </div>
      </div>
      </div>
        ";
     }



     echo json_encode($respuesta);
  }

}


function correo_usuario()
{
   include_once '../conexion.php';
   $respuesta =
   [
     'alert'=> 'La Dirección De Correo ya Está En Uso',
     'attr'=> 'hidden',
     'status' => true
   ];

   if(isset($_POST['correo']) && isset($_POST['t']) && isset($_POST['c']))
   {
      $correo = $_POST['correo'];
      $table = $_POST['t'];
      $column = $_POST['c'];
      
      $VeryfyDB = VerifyDB($table, $column, $correo);

      if(!$VeryfyDB)
      {
        $respuesta =
        [
          'alert'=> '',
          'attr'=> 'hidden',
          'status'=> false
        ];
      }

      echo json_encode($respuesta);

   }
}
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
      'titulo' => $back_btn . 'ADMINISTRADORES',
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

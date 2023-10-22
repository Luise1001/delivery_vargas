<?php 

function mi_perfil()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $respuesta =
  [
     'titulo'=> 'PERFIL',
     'header'=> '',
     'information'=>''
  ];

  if($UserID)
  {  
    $UserData = UserData($UserID);
    $ClientData = ClientData($UserID);

    foreach($UserData as $user)
    {
      $correo = $user['Correo'];
      $user_name = $user['User_name'];
      $nivel = WriteLevel($AdminLevel);
      $inicial = substr($user_name, 0, 1);
      $actualizado = $user['Actualizado'];
    }
    $foto = SearchProfilePhoto($UserID);

    if(!$foto)
    {
      $foto = ProfilePhoto($inicial);
    }
 

    $respuesta['header'] = 
    "
    <div class='header-profile'>
    <img id='foto_perfil' src='$foto' alt='Foto de Perfil'>
    <input type='file' accept='image/*' id='input_fp' class='file-selector'>
    <label for='input_fp' class='file-selector-label'>
    <span class='file-selector-span'><i class='fas fa-camera'></i></span>
    </label>
    </div>
    ";

    if($ClientData)
    {
       foreach($ClientData as $client)
       {
          $nombre = $client['Nombre'];
          $apellido = $client['Apellido'];
          $tipo_id = $client['Tipo_id'];
          $cedula = $client['Cedula'];
          $telefono = $client['Telefono'];
          $genero = $client['Genero'];
       }

       $TypeIDList = TypeIDList($tipo_id);
       $options = '';

       foreach($TypeIDList as $type)
       {
          $options .=
          "
          <option value='$type'>$type</option>
          ";
       }

       $f = '';
       $m = '';

       switch ($genero) {
        case "F":
          $f = 'checked';
          break;
        case "M":
          $m = 'checked';
          break;
        default:
          $f = '';
          $m = '';
      }

       $respuesta['information'] = 
       "
       <div class='personal-data'>
       <label class='form-label' for='nombre'>Nombres<span class='text-danger'>*</span></label>
       <input class='form-control perfil-input' type='text' id='nombre' name='nombre' value='$nombre'>
       <label class='form-label' for='apellido'>Apellidos<span class='text-danger'>*</span></label>
       <input class='form-control perfil-input' type='text' id='apellido' name='apellido' value='$apellido'>
       <label class='form-label' for='correo'>Correo Electrónico<span class='text-danger'>*</span></label>
       <input readonly class='form-control perfil-input' type='text' id='correo' name='correo' value='$correo'>
       <label class='form-label' for='cedula'>Cédula de Identidad<span class='text-danger'>*</span></label>
       <div class='input-group'>
         <select class='form-select perfil-select' id='tipo_id' name='tipo_id'>
           <option value='$tipo_id'>$tipo_id</option>
           $options
         </select>
         <input class='form-control perfil-input' type='number' id='cedula' name='cedula' value='$cedula'>
       </div>
       <label class='form-label' for='telefono'>Celular<span class='text-danger'>*</span></label>
       <input class='form-control perfil-input' type='number' id='telefono' name='telefono' value='$telefono'>
       <label class='form-label' for='genero'>Genero<span class='text-danger'>*</span></label>
       <div class='form-check'>
         <input class='form-check-input' type='radio' value='F' id='femenino' name='genero' $f>
         <label class='form-check-label' for='femenino'>
           Femenino
         </label>
       </div>
       <div class='form-check'>
         <input class='form-check-input' type='radio' value='M' id='masculino' name='genero' $m>
         <label class='form-check-label' for='masculino'>
           Masculino
         </label>
       </div>
       <div class='container'>
         <button id='guardar_perfil' class='perfil-button'>Guardar</button>
       </div>
     </div>";
    }
    else
    {
      $respuesta['information'] = 
      "
      <div class='personal-data'>
      <label class='form-label' for='nombre'>Nombres<span class='text-danger'>*</span></label>
      <input class='form-control perfil-input' type='text' id='nombre' name='nombre'>
      <label class='form-label' for='apellido'>Apellidos<span class='text-danger'>*</span></label>
      <input class='form-control perfil-input' type='text' id='apellido' name='apellido'>
      <label class='form-label' for='correo'>Correo Electrónico</label>
      <input readonly class='form-control perfil-input' type='text' id='correo' name='correo' value='$correo' disabled>
      <label class='form-label' for='cedula'>Cédula de Identidad<span class='text-danger'>*</span></label>
      <div class='input-group'>
        <select class='form-select perfil-select' id='tipo_id' name='tipo_id'>
          <option value='V'>V</option>
          <option value='E'>E</option>
          <option value='P'>P</option>
        </select>
        <input class='form-control perfil-input' type='number' id='cedula' name='cedula'>
      </div>
      <label class='form-label' for='telefono'>Celular<span class='text-danger'>*</span></label>
      <input class='form-control perfil-input' type='number' id='telefono' name='telefono'>
      <label class='form-label' for='genero'>Genero<span class='text-danger'>*</span></label>
      <div class='form-check'>
        <input class='form-check-input' value='F' type='radio' id='femenino' name='genero' checked>
        <label class='form-check-label' for='femenino'>
          Femenino
        </label>
      </div>
      <div class='form-check'>
        <input class='form-check-input' value='M' type='radio' id='masculino' name='genero'>
        <label class='form-check-label' for='masculino'>
          Masculino
        </label>
      </div>
      <div class='container'>
        <button id='guardar_perfil' class='perfil-button'>Guardar</button>
      </div>
    </div>";
    }

    
  }
  else
  {
     $respuesta['header'] = EmptyPage('Usuario No Existe');
  }


  echo json_encode($respuesta);

}

function mi_perfil_juridico()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $respuesta =
  [
     'titulo'=> 'PERFIL',
     'header'=> '',
     'information'=>''
  ];

  if($UserID)
  {  
    $UserData = UserData($UserID);
    $ComercioData = ComercioData($UserID);

    foreach($UserData as $user)
    {
      $correo = $user['Correo'];
      $user_name = $user['User_name'];
      $nivel = WriteLevel($AdminLevel);
      $inicial = substr($user_name, 0, 1);
      $actualizado = $user['Actualizado'];
    }
    $foto = SearchProfilePhoto($UserID);

    if(!$foto)
    {
      $foto = ProfilePhoto($inicial);
    }
 

    $respuesta['header'] = 
    "
    <div class='header-profile'>
    <img id='foto_perfil' src='$foto' alt='Foto de Perfil'>
    <input type='file' accept='image/*' id='input_fp' class='file-selector'>
    <label for='input_fp' class='file-selector-label'>
    <span class='file-selector-span'><i class='fas fa-camera'></i></span>
    </label>
    </div>
    ";

    if($ComercioData)
    {
       foreach($ComercioData as $comercio)
       {
         $razon_social = $comercio['Razon_social'];
         $tipo_id = $comercio['Tipo_id'];
         $rif = $comercio['Rif'];
         $telefono = $comercio['Telefono'];
       }
       
       $TypeIDList = TypeIDList($tipo_id);
       $options = '';

       foreach($TypeIDList as $type)
       {
          $options .=
          "
          <option value='$type'>$type</option>
          ";
       }

       $respuesta['information'] = 
       "
       <div class='personal-data'>
       <label class='form-label' for='nombre'>Razon_social<span class='text-danger'>*</span></label>
       <input class='form-control perfil-input' type='text' id='razon_social' name='razon_social' value='$razon_social'>
       <label class='form-label' for='correo'>Correo Electrónico<span class='text-danger'>*</span></label>
       <input readonly class='form-control perfil-input' type='text' id='correo' name='correo' value='$correo'>
       <label class='form-label' for='cedula'>Cédula de Identidad<span class='text-danger'>*</span></label>
       <div class='input-group'>
         <select class='form-select perfil-select' id='tipo_id_juridico' name='tipo_id_juridico'>
           <option value='$tipo_id'>$tipo_id</option>
           $options
         </select>
         <input class='form-control perfil-input' type='number' id='rif' name='rif' value='$rif'>
       </div>
       <label class='form-label' for='telefono'>Celular<span class='text-danger'>*</span></label>
       <input class='form-control perfil-input' type='number' id='telefono_juridico' name='telefono_juridico' value='$telefono'>
       <div class='container'>
         <button id='guardar_comercio' class='perfil-button'>Guardar</button>
       </div>
     </div>";
    }
    else
    {
      $respuesta['information'] = 
      "
      <div class='personal-data'>
      <label class='form-label' for='nombre'>Razon_social<span class='text-danger'>*</span></label>
      <input class='form-control perfil-input' type='text' id='razon_social' name='razon_social' value=''>
      <label class='form-label' for='correo'>Correo Electrónico<span class='text-danger'>*</span></label>
      <input readonly class='form-control perfil-input' type='text' id='correo' name='correo' value='$correo'>
      <label class='form-label' for='cedula'>Cédula de Identidad<span class='text-danger'>*</span></label>
      <div class='input-group'>
        <select class='form-select perfil-select' id='tipo_id_juridico' name='tipo_id_juridico'>
          <option value='J'>J</option>
          <option value='G'>G</option>
          <option value='V'>V</option>
          <option value='E'>E</option>
          <option value='P'>P</option>
        </select>
        <input class='form-control perfil-input' type='number' id='rif' name='rif' value=''>
      </div>
      <label class='form-label' for='telefono'>Celular<span class='text-danger'>*</span></label>
      <input class='form-control perfil-input' type='number' id='telefono_juridico' name='telefono_juridico' value=''>
      <div class='container'>
        <button id='guardar_comercio' class='perfil-button'>Guardar</button>
      </div>
    </div>";
    }

    
  }
  else
  {
     $respuesta['header'] = EmptyPage('Usuario No Existe');
  }


  echo json_encode($respuesta);

}

function mi_perfil_conductor()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $respuesta =
  [
     'titulo'=> 'PERFIL',
     'header'=> '',
     'information'=>''
  ];

  if($UserID)
  {  
    $UserData = UserData($UserID);
    $DriverData = DriverData($UserID);
    $ClientData = ClientData($UserID);
    $f = '';
    $m = '';

    if($ClientData)
    {
      foreach($ClientData as $client)
      {
         $genero = $client['Genero'];
      }

      switch ($genero) {
        case "F":
          $f = 'checked';
          break;
        case "M":
          $m = 'checked';
          break;
        default:
          $f = '';
          $m = '';
      }
    }

    foreach($UserData as $user)
    {
      $correo = $user['Correo'];
      $user_name = $user['User_name'];
      $nivel = WriteLevel($AdminLevel);
      $inicial = substr($user_name, 0, 1);
      $actualizado = $user['Actualizado'];
    }
    $foto = SearchProfilePhoto($UserID);

    if(!$foto)
    {
      $foto = ProfilePhoto($inicial);
    }
 

    $respuesta['header'] = 
    "
    <div class='header-profile'>
    <img id='foto_perfil' src='$foto' alt='Foto de Perfil'>
    <input type='file' accept='image/*' id='input_fp' class='file-selector'>
    <label for='input_fp' class='file-selector-label'>
    <span class='file-selector-span'><i class='fas fa-camera'></i></span>
    </label>
    </div>
    ";

    if($DriverData)
    {
       foreach($DriverData as $driver)
       {
          $nombre = $driver['Nombre'];
          $apellido = $driver['Apellido'];
          $tipo_id = $driver['Tipo_id'];
          $cedula = $driver['Cedula'];
          $telefono = $driver['Telefono'];
       }

       $respuesta['information'] = 
       "
       <div class='personal-data'>
       <label class='form-label' for='nombre'>Nombres<span class='text-danger'>*</span></label>
       <input readonly class='form-control perfil-input' type='text' id='nombre' name='nombre' value='$nombre'>
       <label class='form-label' for='apellido'>Apellidos<span class='text-danger'>*</span></label>
       <input readonly class='form-control perfil-input' type='text' id='apellido' name='apellido' value='$apellido'>
       <label class='form-label' for='correo'>Correo Electrónico<span class='text-danger'>*</span></label>
       <input readonly class='form-control perfil-input' type='text' id='correo' name='correo' value='$correo'>
       <label class='form-label' for='cedula'>Cédula de Identidad<span class='text-danger'>*</span></label>
       <div class='input-group'>
         <select class='form-select perfil-select' id='tipo_id' name='tipo_id'>
           <option value='$tipo_id'>$tipo_id</option>
         </select>
         <input readonly class='form-control perfil-input' type='number' id='cedula' name='cedula' value='$cedula'>
       </div>
       <label class='form-label' for='telefono'>Celular<span class='text-danger'>*</span></label>
       <input readonly class='form-control perfil-input' type='number' id='telefono' name='telefono' value='$telefono'>

       <label class='form-label' for='genero'>Genero<span class='text-danger'>*</span></label>
       <div class='form-check'>
         <input $f class='form-check-input' value='F' type='radio' id='femenino' name='genero'>
         <label class='form-check-label' for='femenino'>
           Femenino
         </label>
       </div>
       <div class='form-check'>
         <input $m class='form-check-input' value='M' type='radio' id='masculino' name='genero'>
         <label class='form-check-label' for='masculino'>
           Masculino
         </label>
       </div>
       <div class='container'>
       <button id='guardar_perfil' class='perfil-button'>Guardar</button>
     </div>
     </div>";
    }    
  }
  else
  {
     $respuesta['header'] = EmptyPage('Usuario No Existe');
  }


  echo json_encode($respuesta);

}
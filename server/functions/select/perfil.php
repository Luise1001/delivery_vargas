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
       $v = '';
       $e = '';
       $p = '';
       $f = '';
       $m = '';

       switch ($tipo_id) {
        case "V":
          $v = 'selected';
          break;
        case "E":
          $e = 'selected';
          break;
        case "P":
         $p = 'selected';
          break;
        default:
          $v = '';
          $e = '';
          $p = '';
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

       $respuesta['information'] = 
       "
       <div class='personal-data'>
       <label class='form-label' for='nombre'>Nombres</label>
       <input class='form-control perfil-input' type='text' id='nombre' name='nombre' value='$nombre'>
       <label class='form-label' for='apellido'>Apellidos</label>
       <input class='form-control perfil-input' type='text' id='apellido' name='apellido' value='$apellido'>
       <label class='form-label' for='correo'>Correo Electrónico</label>
       <input class='form-control perfil-input' type='text' id='correo' name='correo' value='$correo' disabled>
       <label class='form-label' for='cedula'>Cédula de Identidad</label>
       <div class='input-group'>
         <select class='form-select perfil-select' id='tipo_id' name='tipo_id'>
           <option $v value='V'>V</option>
           <option $e value='E'>E</option>
           <option $p value='P'>P</option>
         </select>
         <input class='form-control perfil-input' type='number' id='cedula' name='cedula' value='$cedula'>
       </div>
       <label class='form-label' for='telefono'>Celular</label>
       <input class='form-control perfil-input' type='number' id='telefono' name='telefono' value='$telefono'>
       <label class='form-label' for='genero'>Genero</label>
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
      <label class='form-label' for='nombre'>Nombres</label>
      <input class='form-control perfil-input' type='text' id='nombre' name='nombre'>
      <label class='form-label' for='apellido'>Apellidos</label>
      <input class='form-control perfil-input' type='text' id='apellido' name='apellido'>
      <label class='form-label' for='correo'>Correo Electrónico</label>
      <input class='form-control perfil-input' type='text' id='correo' name='correo' value='$correo' disabled>
      <label class='form-label' for='cedula'>Cédula de Identidad</label>
      <div class='input-group'>
        <select class='form-select perfil-select' id='tipo_id' name='tipo_id'>
          <option value='V'>V</option>
          <option value='E'>E</option>
          <option value='P'>P</option>
        </select>
        <input class='form-control perfil-input' type='number' id='cedula' name='cedula'>
      </div>
      <label class='form-label' for='telefono'>Celular</label>
      <input class='form-control perfil-input' type='number' id='telefono' name='telefono'>
      <label class='form-label' for='genero'>Genero</label>
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


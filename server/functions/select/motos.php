<?php

function lista_de_motos()
{
    include_once '../conexion.php';
    $admin = $_SESSION['DLV']['admin'];
    $UserID = UserID($admin);
    $AdminLevel = AdminLevel($UserID);
    $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
    $MotorcycleList = MotorcycleList();
    $respuesta = 
    [
      'titulo'=> $back_btn.'MOTOS',
      'motos'=> '',
    ];
    
    if($MotorcycleList)
    { 
        foreach($MotorcycleList as $moto)
        {
            $id = $moto['Id'];
            $marca = $moto['Marca'];
            $modelo = $moto['Modelo'];
            $placa = $moto['Placa'];
            $year = $moto['Year_moto'];
            $id_conductor = $moto['Id_conductor'];
            $id_usuario = $moto['Id_usuario'];
            $nombre = $moto['Nombre'];
            $apellido = $moto['Apellido'];
            $estado = $moto['Disponible'];
            $fecha = DateFormat($moto['Fecha']);
            $actualizado = $moto['Actualizado'];
            $fecha_actual = CurrentTime();
            $actualizado = TimeDifference($actualizado, $fecha_actual);
            $foto = SearchProfilePhoto($id_usuario);

            if($estado)
            {
               $estado = "<i class='fa-solid fa-check'></i>";
            }
            else
            {
              $estado = "<i class='fa-solid fa-ban text-danger'></i>";
            }

            $respuesta['motos'] .= 
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
              <div class='card-list-title'>$nombre $apellido $estado</div>
              <div class='list-text'>
              <div>$marca $modelo</div>
              <div>$placa</div>
              <div>$year</div>
              <div class='list-links'>
              <a class='list-link' href='editar_moto?moto=$id&conductor=$id_conductor'>Editar</a>
               <a class='list-link eliminar-moto' moto='$id'>Eliminar </a>
                </div>
              </div>
            </div>
          </div>
          </div>
          ";

        }
    }
    else
    {
        $respuesta['motos'] = EmptyPage('Sin motos en la Base de Datos.');
    }
   
    echo json_encode($respuesta);
}

function detalle_moto()
{
   include_once '../conexion.php';
   $admin = $_SESSION['DLV']['admin'];
   $UserID = UserID($admin);
   $AdminLevel = AdminLevel($UserID);
   $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
   $respuesta = 
   [
     'titulo'=> $back_btn.'EDITAR MOTO',
     'moto'=> '',
   ];

   if(isset($_POST['id_moto']) && isset($_POST['id_conductor']))
   {
      $id_moto = $_POST['id_moto'];
      $id_conductor = $_POST['id_conductor'];
      $MotoData = MotoData($id_conductor);

      if($MotoData)
      {
        foreach($MotoData as $moto)
        {
          $marca = $moto['Marca'];
          $modelo = $moto['Modelo'];
          $placa = $moto['Placa'];
          $year = $moto['Year_moto'];
          $cedula = $moto['Cedula'];
        }

        $respuesta['moto'] =
        "
        <div class='personal-data'>
        <label class='form-label' for='marca'>Marca<span class='text-danger'>*</span></label>
        <input class='form-control perfil-input' type='text' id='marca' name='marca' value='$marca'>
        <label class='form-label' for='modelo'>Modelo<span class='text-danger'>*</span></label>
        <input class='form-control perfil-input' type='text' id='modelo' name='modelo' value='$modelo'>
        <label class='form-label' for='placa'>Placa<span class='text-danger'>*</span></label>
        <input class='form-control perfil-input' type='text' id='placa' name='placa' value='$placa'>
        <label class='form-label' for='year'>Año<span class='text-danger'>*</span></label>
        <input class='form-control perfil-input' type='number' id='year' name='year' value='$year'>
        <label class='form-label' for='cedula'>Cédula Del Conductor<span class='text-danger'>*</span></label>
        <input class='form-control perfil-input' type='text' id='cedula' name='cedula' value='$cedula'>
        <span class='red-alert'></span>

        <div class='container'>
        <button id='guardar_moto' class='perfil-button'>Guardar</button>
      </div>
      </div>
      ";

      }
      else
      {
         $respuesta['moto'] = EmptyPage('Sin Datos De La Moto En la Base de Datos');
      }

      echo json_encode($respuesta);
   }
}


function mi_moto()
{
    require '../conexion.php';
    $admin = $_SESSION['DLV']['admin'];
    $id_usuario = UserID($admin);
    $cedula = DriverCedula($id_usuario);
    $id_conductor = DriverID($cedula);
    $resultado = '';
    if($id_conductor)
    { 
       $datos_conductor = DriverData($id_conductor);
  
      foreach($datos_conductor as $driver)
      {
         $marca = $driver['Marca'];
         $modelo = $driver['Modelo'];
         $year = $driver['Year_moto'];
         $placa = $driver['Placa'];
      }
  
      $resultado = 
      "
      <ul>
      <div class='opciones'>
          <a  class='btn menu_opciones moto-data' title='Información Del Vehículo'>
          <i class='fas fa-motorcycle'></i> Información Del Vehículo
         </i> <i id='arrow_mt' class='fas fa-angle-down'></i>
          </a>
    <div class='dropdown-container'>
    <li>
      <p>Marca: $marca</p>
      <p>Modelo: $modelo</p>
      <p>Año: $year</p>
      <p>Placa: $placa</p>
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
         </i> <i id='arrow_mt'  class='fas fa-angle-down'></i>
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

    echo $resultado;
}
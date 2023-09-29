<?php

function lista_de_motos()
{
    include_once 'conexion.php';

    $lista_de_motos = MotorcycleList();
    $boton = 
    '
      <a class="nav-link" data-toggle="modal" data-target="#nueva_moto" title="Agregar una Nueva Moto">
         <i class="fas fa-plus-circle"></i>
      </a>
    ';
    $resp = 
    [
      'botones'=> $boton,
      'motos'=> '',
    ];
    
    if($lista_de_motos)
    {
        foreach($lista_de_motos as $moto)
        {
            $id = $moto['Id'];
            $marca = $moto['Marca'];
            $modelo = $moto['Modelo'];
            $placa = $moto['Placa'];
            $year = $moto['Year_moto'];
            $id_conductor = $moto['Id_conductor'];
            $conductor = $moto['Nombre'].' '.$moto['Apellido'];
            $estatus = $moto['Disponible'];
            $cedula = $moto['Cedula'];
            $fecha = DateFormat($moto['Fecha']);
            $estatus_bg = '';

            $driver_data = DriverData($id_conductor);
            $user_driver_id = $driver_data[0]['Id_usuario'];
            $user_data = UserData($user_driver_id);
            $user_name = $user_data[0]['User_name'];
            $foto = substr($user_name, 0,1);
    
            if($estatus)
            {
                $estatus = 'Disponible';
                $estatus_bg = 'bg-success';
            }
            else 
            {
                $estatus = 'No Disponible';
                $estatus_bg = 'bg-danger';
            }

            $perfil = SearchProfilePhoto($user_driver_id, 'perfil');
            if($perfil === true)
            {
              $foto = "../../img/profile/users/$user_driver_id/photo/perfil.jpg";
            }
            else
            {
              ProfilePhoto($foto);
              $foto = "../../img/profile/letters/$foto.jpg";
            }
            
            $resp['motos'] .=
            "
            <ul>
            <div class='orden-pedido opciones dropdown img-fondo-blanco'>
              <a class=' orden-pedido-link btn menu_opciones'>
              <img class='img-pedido-comercio' align='left' src='$foto' alt='logo'>
               <div class='container'>
                <p class='pedido-tag-p'>$conductor</p>
                <p class='pedido-tag-p'>Moto</p>
      
                <div class='progress'>
                <div class='progress-bar $estatus_bg text-dark' role='progressbar' aria-label='Example with label'
                  style='width:100%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$estatus</div>
                 </div>
               </div>
              </a>
                 <div class='dropdown-container'>
                 <div class='pedido-info p-2'>
                 <li><h6 style='display :inline-block;'>Marca:</h6> $marca</li>
                 <li><h6 style='display :inline-block;'>Modelo:</h6> $modelo</li>
                 <li><h6 style='display :inline-block;'>Placa:</h6> $placa</li>
                 <li><h6 style='display :inline-block;'>Año:</h6> $year</li>
                 <li><h6 style='display :inline-block;'>Ingreso:</h6> $fecha</li>
    
                 <li class='list-group-item text-center'>
                 <a class='btn' id='editar_moto_btn' moto='$id' marca='$marca' modelo='$modelo' placa='$placa' year='$year' cedula='$cedula' 
                 title='Editar Moto' data-toggle='modal' data-target='#editar_moto' >
                 <i class='fas fa-edit'></i>
                 </a>
                 <a class='btn' id='eliminar_moto_btn' moto='$id'><i class='fas fa-trash'></i></a>
                 </li>
                  
                 </div>
                
                  </div>
             
             </div>
            </ul>
            ";

        }
        echo json_encode($resp);
    }
    else
    {
        $resp['motos'] = EmptyPage('Sin motos en la Base de Datos.');
        echo json_encode($resp);
    }
   

}

function mi_moto()
{
    require 'conexion.php';
    $id_usuario = UserID($_SESSION['admin']);
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
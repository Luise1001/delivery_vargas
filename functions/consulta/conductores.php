<?php

function lista_de_conductores()
{  
    include_once 'conexion.php';
    $lista_de_conductores = DriverList();
    $boton = 
    '
      <a class="nav-link" data-toggle="modal" data-target="#nuevo_conductor" title="Agregar un Nuevo Conductor">
        <i class="fas fa-plus-circle"></i>
      </a>
    ';

    $resp = 
    [
      'conductores'=> '',
      'botones'=> $boton

    ];

    if($lista_de_conductores)
    {
      foreach($lista_de_conductores as $conductor)
      {
          $id = $conductor['Id'];
          $user_id = $conductor['Id_usuario'];
          $nombre = $conductor['Nombre'];
          $apellido = $conductor['Apellido'];
          $tipo_id = $conductor['Tipo_id'];
          $cedula =  $conductor['Cedula'];
          $num_cedula = $tipo_id.'-'.$cedula;
          $telefono = $conductor['Telefono'];
          $direccion = $conductor['Direccion'];
          $estatus = $conductor['Disponible'];
          $correo = $conductor['Correo'];
          $user_name = $conductor['User_name'];
          $fecha = DateFormat($conductor['Fecha']);
          $estatus_bg = '';
          $foto = substr($user_name, 0,1);
          $movimiento = $conductor['U_movimiento'];
  
          if($estatus)
          {
              $estatus = 'Libre';
              $estatus_bg = 'bg-success';
          }
          else 
          {
              $estatus = 'Ocupado';
              $estatus_bg = 'bg-danger';
          }
  
          $perfil = SearchProfilePhoto($user_id, 'perfil');
          if($perfil === true)
          {
            $foto = "../../img/profile/users/$user_id/photo/perfil.jpg";
          }
          else
          {
            ProfilePhoto($foto);
            $foto = "../../img/profile/letters/$foto.jpg";
          }
  
          $resp['conductores'] .=
          "
          <ul>
          <div class='orden-pedido opciones dropdown img-fondo-blanco'>
            <a class=' orden-pedido-link btn menu_opciones'>
            <img class='img-pedido-comercio' align='left' src='$foto' alt='logo'>
             <div class='container'>
              <p class='pedido-tag-p'>$nombre $apellido</p>
              <p class='pedido-tag-p'>Conductor</p>
    
              <div class='progress'>
              <div class='progress-bar $estatus_bg text-dark' role='progressbar' aria-label='Example with label'
                style='width:100%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$estatus</div>
               </div>
             </div>
            </a>
               <div class='dropdown-container'>
               <div class='pedido-info p-2'>
               <li><h6 style='display :inline-block;'>Cédula:</h6> $num_cedula</li>
               <li><h6 style='display :inline-block;'>Teléfono:</h6> $telefono</li>
               <li><h6 style='display :inline-block;'>Correo:</h6> $correo</li>
               <li><h6 style='display :inline-block;'>Dirección:</h6> $direccion</li>
               <li><h6 style='display :inline-block;'>Ingreso:</h6> $fecha</li>
  
               <li class='list-group-item text-center'>
               <a class='btn' id='editar_conductor_btn'
                conductor='$id' nombre='$nombre' usuario='$correo' apellido='$apellido' letra='$tipo_id' cedula='$cedula' telefono='$telefono' direccion='$direccion'
                title='Editar Conductor' data-toggle='modal' data-target='#editar_conductor'>
                <i class='fas fa-user-edit'></i>
                </a>
              
                <a id='eliminar_conductor_btn' class='btn p-0' title='Eliminar Conductor' conductor='$id'>
                <i class='fas fa-user-times'></i>
               </a>
           
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
       $resp['conductores'] = EmptyPage('Sin Conductores en la Base de Datos.');
       echo json_encode($resp);
    }


}


function conductores_disponibles()
{
  include_once 'conexion.php';
  
  if(isset($_POST['pedido']))
  {
    $nro_pedido = $_POST['pedido'];
    $id_route = RouteID($nro_pedido);
    $ruta = RouteData($id_route);
    $salida = $ruta[0]['Salida'];
    $lista_de_conductores = DriverListForDelivery(1);

    $conductores = [];
    $i = 0;

    if($lista_de_conductores)
    {
      foreach($lista_de_conductores  as $conductor)
      {
        $ubicacion = $conductor['Ubicacion'];
        $distancia = getDistance($salida, $ubicacion);
        $distancia = round($distancia, 2);
      
        if($i < 5)
        {
          $conductores[$i] =
          [
            'Id' => $conductor[0],
            'Nombre' => $conductor['Nombre'].' '.$conductor['Apellido'],
             'Distancia'=> $distancia
          ];
      
          $i++;
        }
        else
        {
          return;
        }
     
      }
  
      function compareDistance($a, $b) 
      {
       return $a['Distancia'] - $b['Distancia'];
      }
   
     usort($conductores, "compareDistance");
      
     $respuesta = 
     "
      <option value ='0' >Seleccionar </option>
     ";
      foreach($conductores  as $conductor)
      {
         $id = $conductor['Id'];
         $nombre = $conductor['Nombre'];
         $distancia = $conductor['Distancia'];
   
       $respuesta .=
       "
       <option value='$id'>$nombre : $distancia KM.</option>
       ";
      }

    }
    else
    {
      $respuesta = 
      "
       <option value ='0' >Sin Conductores Disponible. </option>
      ";
    }

  }

  echo $respuesta;
  
}
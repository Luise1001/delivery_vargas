<?php

function lista_de_comercios()
{
  include_once 'conexion.php';
  $lista_de_comercios = BusinessList();

  if($lista_de_comercios)
  {
     echo EmptyPage('Listado de Comercios Afiliados');
    $i = count($lista_de_comercios);

    foreach($lista_de_comercios as $comercio)
    {
      $id_usuario_comercio = $comercio['Id_usuario'];
      $id_comercio = $comercio['Id'];
      $razon_social = $comercio['Razon_social'];
      $tipo_id = $comercio['Tipo_id'];
      $rif = $comercio['Rif'];
      $telefono = $comercio['Telefono'];
      $fecha = DateFormat($comercio['Fecha']);
      $perfil = SearchProfilePhoto($id_usuario_comercio, 'perfil');
      $user_data = UserData($id_usuario_comercio);
      $comercio_user_name = $user_data[0]['User_name'];
      $direcciones = MyStaticLocations($id_usuario_comercio);

      if($perfil === true)
      {
        $foto = "../../img/profile/users/$id_usuario_comercio/photo/perfil.jpg";
      }
      else
      {
        $letra = substr($comercio_user_name, 0,1);

        $foto = "../../img/profile/letters/$letra.jpg";
      }
      
      $comercios =
      "
      <ul>
      <div class='orden-pedido opciones dropdown img-fondo-blanco'>
        <a class=' orden-pedido-link btn menu_opciones'>
        <img class='img-pedido-comercio' align='left' src='$foto' alt='logo'>
         <div class='container'>
          <p class='pedido-tag-p'>$razon_social</p>
          <p class='pedido-tag-p'>$tipo_id-$rif</p>

          <div class='progress d-none'>
          <div class='progress-bar bg-transparent text-dark' role='progressbar' aria-label='Example with label'
            style='width:100%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>Comercio Afiliado</div>
           </div>
         </div>
        </a>
           <div class='dropdown-container'>
           <div class='pedido-info p-2'>
           <li><h6>Telefono:</h6> $telefono</li>
           ";

           if($direcciones)
           { $p = 1;
             foreach($direcciones as $direccion)
             {
               $adress = $direccion['Ubicacion'];
               $comercios .= 
               "
               <li><h6>Dirección $p:</h6> $adress</li>
               ";
               $p++;
             }
           }
           else
           {
            $comercios .= 
            "
            <li><h6>Dirección:</h6> Sin Dirección Por El Momento.</li>
            ";
           }
           $comercios .= 
           "
           <li><h6>Registrado:</h6> $fecha</li>
            
           </div>
          
            </div>
       
       </div>
      </ul>
      ";

      echo $comercios;
       $i--;
    }
  }
  else
  {
     echo EmptyPage('Sin Comercios Para Mostrar.');
  }
}
<?php

function CheckClient()
{
   include_once '../conexion.php';
   $admin =  $_SESSION['DLV']['admin'];
   $UserID = UserID($admin);
   $AdminLevel = AdminLevel($UserID);
   $ClientData = ClientData($UserID);

   if($ClientData)
   {
      echo true;
   }
   else
   {
      echo false;
   }
}

function lista_de_clientes()
{
  include_once '../conexion.php';
  $lista_de_clientes = ClientList();

  if($lista_de_clientes)
  {
     echo EmptyPage('Listado de Clientes');
    $i = count($lista_de_clientes);

    foreach($lista_de_clientes as $cliente)
    {
       $id_cliente = $cliente['Id'];
       $id_usuario_cliente = $cliente['Id_usuario'];
       $nombre = $cliente['Nombre'];
       $apellido = $cliente['Apellido'];
       $tipo_id = $cliente['Tipo_id'];
       $cedula = $cliente['Cedula'];
       $telefono = $cliente['Telefono'];
       $fecha = DateFormat($cliente['Fecha']);
       $perfil = SearchProfilePhoto($id_usuario_cliente, 'perfil');
       $user_data = UserData($id_usuario_cliente);
       $cliente_user_name = $user_data[0]['User_name'];
       $direcciones = MyStaticLocations($id_usuario_cliente);
 
       if($perfil === true)
       {
         $foto = "../../server/images/profile/users/$id_usuario_cliente/photo/perfil.jpg";
       }
       else
       {
         $letra = substr($cliente_user_name, 0,1);
 
         $foto = "../../server/images/profile/letters/$letra.jpg";
       }
       
       $clientes =
       "
       <ul>
       <div class='orden-pedido opciones dropdown img-fondo-blanco'>
         <a class=' orden-pedido-link btn menu_opciones'>
         <img class='img-pedido-comercio' align='left' src='$foto' alt='logo'>
          <div class='container'>
           <p class='pedido-tag-p'>$nombre $apellido</p>
           <p class='pedido-tag-p'>$tipo_id-$cedula</p>
 
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
                $clientes .= 
                "
                <li><h6>Dirección $p:</h6> $adress</li>
                ";
                $p++;
              }
            }
            else
            {
             $clientes .= 
             "
             <li><h6>Dirección:</h6> Sin Dirección Por El Momento.</li>
             ";
            }
            $clientes .= 
            "
            <li><h6>Registrado:</h6> $fecha</li>
             
            </div>
           
             </div>
        
        </div>
       </ul>
       ";
 
       echo $clientes;
        $i--;
    }
  }
  else
  {
     echo EmptyPage('Sin Clientes Para Mostrar.');
  }
}
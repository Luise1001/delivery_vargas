<?php

function mis_envios()
{
  $mis_envios = 
  [
    'pendientes'=> '',
    'asignados'=> '',
    'transito' =>'',
    'completados'=> ''
  ];

   $mis_envios['pendientes'] = envios_pendientes();
   $mis_envios['asignados'] = envios_asignados();
   $mis_envios['transito'] = envios_en_curso();
   $mis_envios['completados'] =  envios_completados();

   echo json_encode($mis_envios);
}

function envios_pendientes()
{ 
   include_once '../conexion.php';
   $admin = $_SESSION['DLV']['admin'];
   $id_usuario = UserID($admin);
   $nivel = AdminLevel($id_usuario);
   $resp = '';
  
   if($nivel === '1')
   {
    $lista_de_envios = ListDelivery(0,0,0);
   if($lista_de_envios)
   { 
     foreach($lista_de_envios as $envio)
     {
        $id = $envio['Id'];
        $id_comercio = $envio['Id_comercio'];
        $comercio = $envio['Razon_social'];
        $cliente = $envio['Nombre'].' '.$envio['Apellido'];
        $salida = $envio['Salida'];
        $destino = $envio['Destino'];
        $nro_pedido = $envio['Nro_pedido'];
        $distancia = $envio['Distancia'];
        $tiempo = $envio['Tiempo'];
        $movimiento = $envio['U_movimiento'];
        $dia = DateDay($movimiento);
        $hora = DateHour($movimiento);
        $fecha = DateFormat($movimiento);
        $orderDetail = OrderDetail($nro_pedido);
        $orderStatus = OrderStatus($nro_pedido);
        $metodo_pago = $orderDetail[0]['Categoria'];
        $pago = $orderStatus[0]['Pagado'];
        $ComercioData = ComercioData($id_comercio);
        $foto = SearchProfilePhoto($ComercioData[0]['Id'], 'perfil');

        if(!$foto)
        {
           $foto = "../../server/images/profile/letters/c.jpg";
        }

        if($pago)
        {
           $pagado = 'Pagado';
        }
        else
        {
           $pagado = 'Por Pagar';
        }

       
      $resp .=
      "
      <div class='' role='alert' aria-live='assertive' aria-atomic='true'>
      <div class='toast-header'>
      <img src='$foto' class='img-option-2 me-2' alt='Foto de Perfil'>
    <strong class='me-auto' data-bs-toggle='collapse' data-bs-target='.toast_$id' data-bs-auto-close='true'>
    $comercio
     </strong>
    <small></small>
      <button class=' button-option-2' data-bs-toggle='dropdown' data-bs-auto-close='true' aria-expanded='false'>
       <span><i class='fas fa-ellipsis-v'></i></span>
      </button>
      <ul class='dropdown-menu card-menu'>
      <li class='dropdown-item card-menu-item'><a class='editar_admin_btn' 
      admin='$id' user='' correo='' nivel='' data-toggle='modal' data-target='#editar_admin'>
      <i class='fa-solid fa-edit'></i> Editar</a></li>
      <li class='dropdown-item card-menu-item'><a class='eliminar_admin_btn' id='$id'>
      <i class='fa-solid fa-trash'></i> Eliminar</a></li>
     </ul>
  </div>
  <div class='toast-body toast_$id collapse'>
  <li class='list-group-item'><h6>Cliente:</h6> $cliente</li>
  <li class='list-group-item'><h6>Método de Pago:</h6> $metodo_pago</li>
  <li class='list-group-item'><h6>Estado del Pago:</h6> $pagado</li>
  <li class='list-group-item'><h6>Salida:</h6> $salida</li>
  <li class='list-group-item'><h6>Destino:</h6> $destino</li>
  <li class='list-group-item'><h6>Distancia:</h6> $distancia KM.</li>
  <li class='list-group-item'><h6>Tiempo Estimado:</h6> $tiempo </li>
  </div>
</div>
 ";
   
     }

     return $resp;
   }
   else
   {
      $resp =  EmptyPage('Sin Envíos Pendientes Por Asignar.');
      return $resp;
   }
  }

  if($nivel === '2')
  {
     $cedula = DriverCedula($id_usuario);
     $id_conductor = DriverID($cedula);
     $lista_de_envios = ListDeliveryByDriver(1,0,0, $id_conductor);

     if($lista_de_envios)
     { 
       foreach($lista_de_envios as $envio)
       {
          $id = $envio['Id'];
          $comercio = $envio['Razon_social'];
          $cliente = $envio['Nombre'].' '.$envio['Apellido'];
          $telefono = $envio['Telefono'];
          $salida = $envio['Salida'];
          $destino = $envio['Destino'];
          $nro_pedido = $envio['Nro_pedido'];
          $distancia = $envio['Distancia'];
          $tiempo = $envio['Tiempo'];
          $ruta = $envio['Url_ruta'];
          $movimiento = $envio['U_movimiento'];
          $dia = DateDay($movimiento);
          $hora = DateHour($movimiento);
          $fecha = DateFormat($movimiento);
          $orderDetail = OrderDetail($nro_pedido);
          $orderStatus = OrderStatus($nro_pedido);
          $metodo_pago = $orderDetail[0]['Categoria'];
          $pago = $orderStatus[0]['Pagado'];
  
          if($pago)
          {
             $pagado = 'Pagado';
          }
          else
          {
             $pagado = 'Por Pagar';
          }
          
         
        $resp .=
        "
        <div class='' role='alert' aria-live='assertive' aria-atomic='true'>
        <div class='toast-header'>
          <img src='../../server/images/logos/deliveryvargas.png' class='img-option-2 me-2' alt='...'>
          <strong class='me-auto' data-bs-toggle='collapse' data-bs-target='.toast_$id' data-bs-auto-close='true'>
          $comercio
           </strong>
          <small></small>
            <button class=' button-option-2' data-bs-toggle='dropdown' data-bs-auto-close='true' aria-expanded='false'>
             <span><i class='fas fa-ellipsis-v'></i></span>
            </button>
        </div>
        <div class='toast-body toast_$id collapse'>
        <li class='list-group-item'><h6>Cliente:</h6> $cliente</li>
        <li class='list-group-item'><h6>Método de Pago:</h6> $metodo_pago</li>
        <li class='list-group-item'><h6>Estado del Pago:</h6> $pagado</li>
        <li class='list-group-item'><h6>Salida:</h6> $salida</li>
        <li class='list-group-item'><h6>Destino:</h6> $destino</li>
        <li class='list-group-item'><h6>Distancia:</h6> $distancia KM.</li>
        <li class='list-group-item'><h6>Tiempo Estimado:</h6> $tiempo </li>
        </div>
      </div>
        
        ";
     
       }

       return $resp;
     }
     else
     {
       $resp = EmptyPage('Sin Envíos Pendientes Por Aceptar.');
       return $resp;
     }
  }



}

function envios_asignados()
{ 
   include_once '../conexion.php';
   $admin = $_SESSION['DLV']['admin'];
   $id_usuario = UserID($admin);
   $nivel = AdminLevel($id_usuario);
   $resp = '';

   if($nivel === '1')
   {
     $lista_de_envios = ListDelivery(1,0,0);
   if($lista_de_envios)
   { 
     foreach($lista_de_envios as $envio)
     {
        $id = $envio['Id'];
        $comercio = $envio['Razon_social'];
        $cliente = $envio['Nombre'].' '.$envio['Apellido'];
        $salida = $envio['Salida'];
        $destino = $envio['Destino'];
        $nro_pedido = $envio['Nro_pedido'];
        $distancia = $envio['Distancia'];
        $tiempo = $envio['Tiempo'];
        $id_conductor = $envio['Id_conductor'];
        $DriverData = DriverData($id_conductor);
        $movimiento = $envio['U_movimiento'];
        $dia = DateDay($movimiento);
        $hora = DateHour($movimiento);
        $fecha = DateFormat($movimiento);
        $orderDetail = OrderDetail($nro_pedido);
        $orderStatus = OrderStatus($nro_pedido);
        $metodo_pago = $orderDetail[0]['Categoria'];
        $pago = $orderStatus[0]['Pagado'];

        if($pago)
        {
           $pagado = 'Pagado';
        }
        else
        {
           $pagado = 'Por Pagar';
        }

        foreach($DriverData as $driver)
        {
           $conductor = $driver['Nombre'].' '.$driver['Apellido'];
           $moto = $driver['Marca'].' '.$driver['Modelo'];
           $placa = $driver['Placa'];
        }
       
      $resp .=
      "
      <div class='' role='alert' aria-live='assertive' aria-atomic='true'>
      <div class='toast-header'>
        <img src='../../server/images/logos/deliveryvargas.png' class='img-option-2 me-2' alt='...'>
        <strong class='me-auto' data-bs-toggle='collapse' data-bs-target='.toast_$id' data-bs-auto-close='true'>
        $comercio
         </strong>
        <small></small>
          <button class=' button-option-2' data-bs-toggle='dropdown' data-bs-auto-close='true' aria-expanded='false'>
           <span><i class='fas fa-ellipsis-v'></i></span>
          </button>
      </div>
      <div class='toast-body toast_$id collapse'>
      <li class='list-group-item'><h6>Cliente:</h6> $cliente</li>
      <li class='list-group-item'><h6>Método de Pago:</h6> $metodo_pago</li>
      <li class='list-group-item'><h6>Estado del Pago:</h6> $pagado</li>
      <li class='list-group-item'><h6>Salida:</h6> $salida</li>
      <li class='list-group-item'><h6>Destino:</h6> $destino</li>
      <li class='list-group-item'><h6>Distancia:</h6> $distancia KM.</li>
      <li class='list-group-item'><h6>Tiempo Estimado:</h6> $tiempo </li>
      </div>
    </div>
      
      ";
   
     }

     return $resp;
   }
   else
   {
     $resp = EmptyPage('Sin Envíos Pendientes Por Re-Asignar.');
     return $resp;
   }
  }

  if($nivel === '2')
  {
     $resp = EmptyPage('Sin Envíos Pendientes Por Re-Asignar.');
     return $resp;
  }
}

function envios_en_curso()
{ 
   include_once '../conexion.php';
   $admin = $_SESSION['DLV']['admin'];
   $id_usuario = UserID($admin);
   $nivel = AdminLevel($id_usuario);
   $resp = '';

   if($nivel === '1')
   {
     $lista_de_envios = ListDelivery(1,1,0);
   if($lista_de_envios)
   { 
     foreach($lista_de_envios as $envio)
     {
        $id = $envio['Id'];
        $comercio = $envio['Razon_social'];
        $cliente = $envio['Nombre'].' '.$envio['Apellido'];
        $salida = $envio['Salida'];
        $destino = $envio['Destino'];
        $nro_pedido = $envio['Nro_pedido'];
        $distancia = $envio['Distancia'];
        $tiempo = $envio['Tiempo'];
        $id_conductor = $envio['Id_conductor'];
        $DriverData = DriverData($id_conductor);
        $movimiento = $envio['U_movimiento'];
        $dia = DateDay($movimiento);
        $hora = DateHour($movimiento);
        $fecha = DateFormat($movimiento);
        $orderDetail = OrderDetail($nro_pedido);
        $orderStatus = OrderStatus($nro_pedido);
        $metodo_pago = $orderDetail[0]['Categoria'];
        $pago = $orderStatus[0]['Pagado'];

        if($pago)
        {
           $pagado = 'Pagado';
        }
        else
        {
           $pagado = 'Por Pagar';
        }

        foreach($DriverData as $driver)
        {
           $conductor = $driver['Nombre'].' '.$driver['Apellido'];
           $moto = $driver['Marca'].' '.$driver['Modelo'];
           $placa = $driver['Placa'];
        }
       
      $resp .=
      "
      <div class='' role='alert' aria-live='assertive' aria-atomic='true'>
      <div class='toast-header'>
        <img src='../../server/images/logos/deliveryvargas.png' class='img-option-2 me-2' alt='...'>
        <strong class='me-auto' data-bs-toggle='collapse' data-bs-target='.toast_$id' data-bs-auto-close='true'>
        $comercio
         </strong>
        <small></small>
          <button class=' button-option-2' data-bs-toggle='dropdown' data-bs-auto-close='true' aria-expanded='false'>
           <span><i class='fas fa-ellipsis-v'></i></span>
          </button>
      </div>
      <div class='toast-body toast_$id collapse'>
      <li class='list-group-item'><h6>Cliente:</h6> $cliente</li>
      <li class='list-group-item'><h6>Método de Pago:</h6> $metodo_pago</li>
      <li class='list-group-item'><h6>Estado del Pago:</h6> $pagado</li>
      <li class='list-group-item'><h6>Salida:</h6> $salida</li>
      <li class='list-group-item'><h6>Destino:</h6> $destino</li>
      <li class='list-group-item'><h6>Distancia:</h6> $distancia KM.</li>
      <li class='list-group-item'><h6>Tiempo Estimado:</h6> $tiempo </li>
      </div>
    </div>
      
      ";
   
     }

     return $resp;
   }
   else
   {
     $resp = EmptyPage('Sin Envíos En Transito.');
     return $resp;
   }
  }

  if($nivel === '2')
  {
     $cedula = DriverCedula($id_usuario);
     $id_conductor = DriverID($cedula);
     $lista_de_envios = ListDeliveryByDriver(1,1,0, $id_conductor);

    if($lista_de_envios)
    { 
      foreach($lista_de_envios as $envio)
      {
         $id = $envio['Id'];
         $comercio = $envio['Razon_social'];
         $cliente = $envio['Nombre'].' '.$envio['Apellido'];
         $telefono = $envio['Telefono'];
         $salida = $envio['Salida'];
         $destino = $envio['Destino'];
         $nro_pedido = $envio['Nro_pedido'];
         $distancia = $envio['Distancia'];
         $tiempo = $envio['Tiempo'];
         $id_conductor = $envio['Id_conductor'];
         $DriverData = DriverData($id_conductor);
         $ruta = $envio['Url_ruta'];
         $movimiento = $envio['U_movimiento'];
         $dia = DateDay($movimiento);
         $hora = DateHour($movimiento);
         $fecha = DateFormat($movimiento);
         $orderDetail = OrderDetail($nro_pedido);
         $orderStatus = OrderStatus($nro_pedido);
         $metodo_pago = $orderDetail[0]['Categoria'];
         $pago = $orderStatus[0]['Pagado'];
 
         if($pago)
         {
            $pagado = 'Pagado';
         }
         else
         {
            $pagado = 'Por Pagar';
         }
 
         foreach($DriverData as $driver)
         {
            $conductor = $driver['Nombre'].' '.$driver['Apellido'];
            $moto = $driver['Marca'].' '.$driver['Modelo'];
            $placa = $driver['Placa'];
         }
        
       $resp .=
       "
       <div class='' role='alert' aria-live='assertive' aria-atomic='true'>
       <div class='toast-header'>
         <img src='../../server/images/logos/deliveryvargas.png' class='img-option-2 me-2' alt='...'>
         <strong class='me-auto' data-bs-toggle='collapse' data-bs-target='.toast_$id' data-bs-auto-close='true'>
         $comercio
          </strong>
         <small></small>
           <button class=' button-option-2' data-bs-toggle='dropdown' data-bs-auto-close='true' aria-expanded='false'>
            <span><i class='fas fa-ellipsis-v'></i></span>
           </button>
       </div>
       <div class='toast-body toast_$id collapse'>
       <li class='list-group-item'><h6>Cliente:</h6> $cliente</li>
       <li class='list-group-item'><h6>Método de Pago:</h6> $metodo_pago</li>
       <li class='list-group-item'><h6>Estado del Pago:</h6> $pagado</li>
       <li class='list-group-item'><h6>Salida:</h6> $salida</li>
       <li class='list-group-item'><h6>Destino:</h6> $destino</li>
       <li class='list-group-item'><h6>Distancia:</h6> $distancia KM.</li>
       <li class='list-group-item'><h6>Tiempo Estimado:</h6> $tiempo </li>
       </div>
     </div>
       ";
    
      }

      return $resp;
    }
    else
    {
      $resp = EmptyPage('Sin Envíos En Transito.');
      return $resp;
    }
  }

}

function envios_completados()
{ 
   include_once '../conexion.php';
   $admin = $_SESSION['DLV']['admin'];
   $id_usuario = UserID($admin);
   $nivel = AdminLevel($id_usuario);
   $resp = '';

   if($nivel === '1')
   {
    $lista_de_envios = ListDelivery(1,1,1);
   if($lista_de_envios)
   { 
     $lista_de_envios = array_reverse($lista_de_envios);
     foreach($lista_de_envios as $envio)
     {
        $id = $envio['Id'];
        $comercio = $envio['Razon_social'];
        $cliente = $envio['Nombre'].' '.$envio['Apellido'];
        $salida = $envio['Salida'];
        $destino = $envio['Destino'];
        $nro_pedido = $envio['Nro_pedido'];
        $distancia = $envio['Distancia'];
        $tiempo = $envio['Tiempo'];
        $id_conductor = $envio['Id_conductor'];
        $DriverData = DriverData($id_conductor);
        $movimiento = $envio['U_movimiento'];
        $dia = DateDay($movimiento);
        $hora = DateHour($movimiento);
        $fecha = DateFormat($movimiento);
        $orderDetail = OrderDetail($nro_pedido);
        $orderStatus = OrderStatus($nro_pedido);
        $metodo_pago = $orderDetail[0]['Categoria'];
        $pago = $orderStatus[0]['Pagado'];

        if($pago)
        {
           $pagado = 'Pagado';
        }
        else
        {
           $pagado = 'Por Pagar';
        }

        foreach($DriverData as $driver)
        {
           $conductor = $driver['Nombre'].' '.$driver['Apellido'];
           $moto = $driver['Marca'].' '.$driver['Modelo'];
           $placa = $driver['Placa'];
        }
       
      $resp .=
      "
      <div class='' role='alert' aria-live='assertive' aria-atomic='true'>
      <div class='toast-header'>
        <img src='../../server/images/logos/deliveryvargas.png' class='img-option-2 me-2' alt='...'>
        <strong class='me-auto' data-bs-toggle='collapse' data-bs-target='.toast_$id' data-bs-auto-close='true'>
        $comercio
         </strong>
        <small></small>
          <button class=' button-option-2' data-bs-toggle='dropdown' data-bs-auto-close='true' aria-expanded='false'>
           <span><i class='fas fa-ellipsis-v'></i></span>
          </button>
      </div>
      <div class='toast-body toast_$id collapse'>
      <li class='list-group-item'><h6>Cliente:</h6> $cliente</li>
      <li class='list-group-item'><h6>Método de Pago:</h6> $metodo_pago</li>
      <li class='list-group-item'><h6>Estado del Pago:</h6> $pagado</li>
      <li class='list-group-item'><h6>Salida:</h6> $salida</li>
      <li class='list-group-item'><h6>Destino:</h6> $destino</li>
      <li class='list-group-item'><h6>Distancia:</h6> $distancia KM.</li>
      <li class='list-group-item'><h6>Tiempo Estimado:</h6> $tiempo </li>
      </div>
    </div>
      
      ";
   
     }

     return $resp;
   }
   else
   {
     $resp = EmptyPage('Sin Envíos Completados.');
     return $resp;
   }
  }

  if($nivel === '2')
  {
     $cedula = DriverCedula($id_usuario);
     $id_conductor = DriverID($cedula);
     $lista_de_envios = ListDeliveryByDriver(1,1,1,$id_conductor);
    
    if($lista_de_envios)
    { 
      $lista_de_envios = array_reverse($lista_de_envios);
      foreach($lista_de_envios as $envio)
      {
         $id = $envio['Id'];
         $comercio = $envio['Razon_social'];
         $cliente = $envio['Nombre'].' '.$envio['Apellido'];
         $salida = $envio['Salida'];
         $destino = $envio['Destino'];
         $nro_pedido = $envio['Nro_pedido'];
         $distancia = $envio['Distancia'];
         $tiempo = $envio['Tiempo'];
         $id_conductor = $envio['Id_conductor'];
         $DriverData = DriverData($id_conductor);
         $movimiento = $envio['U_movimiento'];
         $dia = DateDay($movimiento);
         $hora = DateHour($movimiento);
         $fecha = DateFormat($movimiento);
         $orderDetail = OrderDetail($nro_pedido);
         $orderStatus = OrderStatus($nro_pedido);
         $metodo_pago = $orderDetail[0]['Categoria'];
         $pago = $orderStatus[0]['Pagado'];
 
         if($pago)
         {
            $pagado = 'Pagado';
         }
         else
         {
            $pagado = 'Por Pagar';
         }
 
         foreach($DriverData as $driver)
         {
            $conductor = $driver['Nombre'].' '.$driver['Apellido'];
            $moto = $driver['Marca'].' '.$driver['Modelo'];
            $placa = $driver['Placa'];
         }
        
       $resp .=
       "
       <div class='' role='alert' aria-live='assertive' aria-atomic='true'>
       <div class='toast-header'>
         <img src='../../server/images/logos/deliveryvargas.png' class='img-option-2 me-2' alt='...'>
         <strong class='me-auto' data-bs-toggle='collapse' data-bs-target='.toast_$id' data-bs-auto-close='true'>
         $comercio
          </strong>
         <small></small>
           <button class=' button-option-2' data-bs-toggle='dropdown' data-bs-auto-close='true' aria-expanded='false'>
            <span><i class='fas fa-ellipsis-v'></i></span>
           </button>
       </div>
       <div class='toast-body toast_$id collapse'>
       <li class='list-group-item'><h6>Cliente:</h6> $cliente</li>
       <li class='list-group-item'><h6>Método de Pago:</h6> $metodo_pago</li>
       <li class='list-group-item'><h6>Estado del Pago:</h6> $pagado</li>
       <li class='list-group-item'><h6>Salida:</h6> $salida</li>
       <li class='list-group-item'><h6>Destino:</h6> $destino</li>
       <li class='list-group-item'><h6>Distancia:</h6> $distancia KM.</li>
       <li class='list-group-item'><h6>Tiempo Estimado:</h6> $tiempo </li>
       </div>
     </div>
       
       ";
    
      }

      return $resp;
    }
    else
    {
      $resp = EmptyPage('Sin Envíos Completados.');
      return $resp;
    }
  }

}
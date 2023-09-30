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
   include_once 'conexion.php';
   $id_usuario = UserID($_SESSION['admin']);
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
      <div class=' card-envios card'>
      <div class='card-header'>
      <i class='fas fa-motorcycle'></i> Pendiente
      </div>
      <div class='card-body bg-transparent'>
        <h6 class='card-title'>$comercio</h6>
        <p class='card-text'></p>
        <ul class='list-group list-group-flush'>
        <div id='detalle_$id' class='m-0 dropdown-container'>
        <li class='list-group-item'><h6>Cliente:</h6> $cliente</li>
        <li class='list-group-item'><h6>Método de Pago:</h6> $metodo_pago</li>
        <li class='list-group-item'><h6>Estado del Pago:</h6> $pagado</li>
        <li class='list-group-item'><h6>Salida:</h6> $salida</li>
        <li class='list-group-item'><h6>Destino:</h6> $destino</li>
        <li class='list-group-item'><h6>Distancia:</h6> $distancia KM.</li>
        <li class='list-group-item'><h6>Tiempo Estimado:</h6> $tiempo </li>
        </div>
      </ul>
      <a  id='$id' class='btn envio-detalle'>
      <i class='fas fa-info-circle'></i> Ver Detalle</a>

      <button id='$nro_pedido' data-toggle='modal' data-target='#asignar_conductor' class='card-btn asignar-conductor'>
      <i class='fas fa-motorcycle'></i> Asignar</button>
      </div>
      <div class='card-footer text-body-secondary'>
       Última Actividad $dia $fecha a las $hora
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
        <div class=' card-envios card'>
        <div class='card-header'>
        <i class='fas fa-motorcycle'></i> Pendiente
        </div>
        <div class='card-body bg-transparent'>
          <h6 class='card-title'>$comercio</h6>
          <p class='card-text'></p>
          <ul class='list-group list-group-flush'>
          
          <div id='detalle_$id' class=' m-0 dropdown-container'>
          <li class='list-group-item'><h6>Cliente:</h6> $cliente <button telefono='$telefono' class='btn ws-btn-envios'><i class='fab fa-whatsapp'></i></button>
          </li>
          <li class='list-group-item'><h6>Método de Pago:</h6> $metodo_pago</li>
          <li class='list-group-item'><h6>Estado del Pago:</h6> $pagado</li>
          <li class='list-group-item'><h6>Salida:</h6> $salida</li>
          <li class='list-group-item'><h6>Destino:</h6> $destino</li>
          <li class='list-group-item'><h6>Distancia:</h6> $distancia KM.</li>
          <li class='list-group-item'><h6>Tiempo Estimado:</h6> $tiempo </li>
          </div>
        </ul>

        <button pedido='$nro_pedido' ruta='$ruta' class='card-btn aceptar-envio'>
        <i class='fas fa-motorcycle'></i> Aceptar</button>

        <button  ruta='$ruta' class='card-btn revisar-ruta'>
        <i class='fas fa-motorcycle'></i> Ver Ruta</button>

        <a  id='$id' class='btn envio-detalle'>
        <i class='fas fa-info-circle'></i> Ver Detalle</a>
        </div>
        <div class='card-footer text-body-secondary'>
          Última Actividad $dia $fecha a las $hora
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
   include_once 'conexion.php';
   $id_usuario = UserID($_SESSION['admin']);
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
      <div class=' card-envios card'>
      <div class='card-header'>
      <i class='fas fa-motorcycle'></i> Asignado
      </div>
      <div class='card-body bg-transparent'>
        <h6 class='card-title'>$comercio</h6>
        <p class='card-text'></p>
        <ul class='list-group list-group-flush'>
        <li class='list-group-item'><h6>Conductor:</h6> $conductor </li>
        <li class='list-group-item'><h6>Vehículo:</h6> $moto </li>
        <li class='list-group-item'><h6>Placa:</h6> $placa </li>

        <div id='detalle_$id' class='m-0 dropdown-container'>
        <li class='list-group-item'><h6>Cliente:</h6> $cliente</li>
        <li class='list-group-item'><h6>Método de Pago:</h6> $metodo_pago</li>
        <li class='list-group-item'><h6>Estado del Pago:</h6> $pagado</li>
        <li class='list-group-item'><h6>Salida:</h6> $salida</li>
        <li class='list-group-item'><h6>Destino:</h6> $destino</li>
        <li class='list-group-item'><h6>Distancia:</h6> $distancia KM.</li>
        <li class='list-group-item'><h6>Tiempo Estimado:</h6> $tiempo </li>
        </div>
      </ul>
      <a  id='$id' class='btn envio-detalle'>
      <i class='fas fa-info-circle'></i> Ver Detalle</a>

      <button id='$nro_pedido' data-toggle='modal' data-target='#asignar_conductor' class='card-btn asignar-conductor'>
      <i class='fas fa-motorcycle'></i> Re-Asignar</button>
      </div>
      <div class='card-footer text-body-secondary'>
        Última Actividad $dia $fecha a las $hora
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
   include_once 'conexion.php';
   $id_usuario = UserID($_SESSION['admin']);
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
      <div class=' card-envios card'>
      <div class='card-header'>
      <i class='fas fa-motorcycle'></i> En Transito
      </div>
      <div class='card-body bg-transparent'>
        <h6 class='card-title'>$comercio</h6>
        <p class='card-text'></p>
        <ul class='list-group list-group-flush'>
        <li class='list-group-item'><h6>Conductor:</h6> $conductor </li>
        <li class='list-group-item'><h6>Vehículo:</h6> $moto </li>
        <li class='list-group-item'><h6>Placa:</h6> $placa </li>

        <div id='detalle_$id' class='m-0 dropdown-container'>
        <li class='list-group-item'><h6>Cliente:</h6> $cliente</li>
        <li class='list-group-item'><h6>Método de Pago:</h6> $metodo_pago</li>
        <li class='list-group-item'><h6>Estado del Pago:</h6> $pagado</li>
        <li class='list-group-item'><h6>Salida:</h6> $salida</li>
        <li class='list-group-item'><h6>Destino:</h6> $destino</li>
        <li class='list-group-item'><h6>Distancia:</h6> $distancia KM.</li>
        <li class='list-group-item'><h6>Tiempo Estimado:</h6> $tiempo </li>
        </div>
      </ul>
      <a  id='$id' class='btn envio-detalle'>
      <i class='fas fa-info-circle'></i> Ver Detalle</a>

      <button id='$nro_pedido' data-toggle='modal' data-target='#asignar_conductor' class='card-btn asignar-conductor'>
      <i class='fas fa-motorcycle'></i> Re-Asignar</button>
      </div>
      <div class='card-footer text-body-secondary'>
        Última Actividad $dia $fecha a las $hora
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
       <div class=' card-envios card'>
       <div class='card-header'>
       <i class='fas fa-motorcycle'></i> En Tránsito
       </div>
       <div class='card-body bg-transparent'>
         <h6 class='card-title'>$comercio</h6>
         <p class='card-text'></p>
         <ul class='list-group list-group-flush'>
         <div id='detalle_$id' class='m-0 dropdown-container''>
         <li class='list-group-item'><h6>Cliente:</h6> $cliente <button telefono='$telefono' class='btn ws-btn-envios'><i class='fab fa-whatsapp'></i></button></li>
         <li class='list-group-item'><h6>Método de Pago:</h6> $metodo_pago</li>
         <li class='list-group-item'><h6>Estado del Pago:</h6> $pagado</li>
         <li class='list-group-item'><h6>Salida:</h6> $salida</li>
         <li class='list-group-item'><h6>Destino:</h6> $destino</li>
         <li class='list-group-item'><h6>Distancia:</h6> $distancia KM.</li>
         <li class='list-group-item'><h6>Tiempo Estimado:</h6> $tiempo </li>
         </div>
       </ul> 
       <button  pedido='$nro_pedido' class='card-btn ruta-completada'>
       <i class='fas fa-motorcycle'></i> Completado</button>

       <button  ruta='$ruta' class='card-btn revisar-ruta'>
       <i class='fas fa-motorcycle'></i> Ver Ruta</button>

       <a  id='$id' class='btn envio-detalle'>
       <i class='fas fa-info-circle'></i> Ver Detalle</a>
       </div>
       <div class='card-footer text-body-secondary'>
         Última Actividad $dia $fecha a las $hora
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
   include_once 'conexion.php';
   $id_usuario = UserID($_SESSION['admin']);
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
      <div class=' card-envios card'>
      <div class='card-header'>
      <i class='fas fa-motorcycle'></i> Completado
      </div>
      <div class='card-body bg-transparent'>
        <h6 class='card-title'>$comercio</h6>
        <p class='card-text'></p>
        <ul class='list-group list-group-flush'>
        <li class='list-group-item'><h6>Conductor:</h6> $conductor </li>
        <li class='list-group-item'><h6>Vehículo:</h6> $moto </li>
        <li class='list-group-item'><h6>Placa:</h6> $placa </li>

        <div id='detalle_$id' class='m-0 dropdown-container'>
        <li class='list-group-item'><h6>Cliente:</h6> $cliente</li>
        <li class='list-group-item'><h6>Método de Pago:</h6> $metodo_pago</li>
        <li class='list-group-item'><h6>Estado del Pago:</h6> $pagado</li>
        <li class='list-group-item'><h6>Salida:</h6> $salida</li>
        <li class='list-group-item'><h6>Destino:</h6> $destino</li>
        <li class='list-group-item'><h6>Distancia:</h6> $distancia KM.</li>
        <li class='list-group-item'><h6>Tiempo Estimado:</h6> $tiempo </li>
        </div>
      </ul>
      <a id='$id' class='btn envio-detalle'>
      <i class='fas fa-info-circle'></i> Ver Detalle</a>

      </div>
      <div class='card-footer text-body-secondary'>
        Última Actividad $dia $fecha a las $hora
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
       <div class=' card-envios card'>
       <div class='card-header'>
       <i class='fas fa-motorcycle'></i> Completado
       </div>
       <div class='card-body bg-transparent'>
         <h6 class='card-title'>$comercio</h6>
         <p class='card-text'></p>
         <ul class='list-group list-group-flush'> 
         <div id='detalle_$id' class='m-0 dropdown-container'>
         <li class='list-group-item'><h6>Cliente:</h6> $cliente</li>
         <li class='list-group-item'><h6>Método de Pago:</h6> $metodo_pago</li>
         <li class='list-group-item'><h6>Estado del Pago:</h6> $pagado</li>
         <li class='list-group-item'><h6>Salida:</h6> $salida</li>
         <li class='list-group-item'><h6>Destino:</h6> $destino</li>
         <li class='list-group-item'><h6>Distancia:</h6> $distancia KM.</li>
         <li class='list-group-item'><h6>Tiempo Estimado:</h6> $tiempo </li>
         </div>
       </ul>
       <a  id='$id' class='btn envio-detalle'>
       <i class='fas fa-info-circle'></i> Ver Detalle</a>
 
       </div>
       <div class='card-footer text-body-secondary'>
         Última Actividad $dia $fecha a las $hora
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
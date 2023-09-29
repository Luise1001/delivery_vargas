<?php

function mis_pedidos()
{
    include_once 'conexion.php';
    $id_usuario = UserID($_SESSION['admin']);
    $nivel = AdminLevel($id_usuario);

    if(!$nivel)
    {
       ClientOrders($id_usuario, $nivel);
    }

    if($nivel == '3')
    {
       BusinessOrders($id_usuario, $nivel);
    }
}

function ClientOrders($id_usuario, $nivel)
{
  $cedula_cliente = ClientCedula($id_usuario);
  $id_cliente = ClientID($cedula_cliente);
  $cliente_data = ClientData($id_cliente);
  $nombre = $cliente_data[0]['Nombre'];
  $apellido = $cliente_data[0]['Apellido'];
  $mis_pedidos = 
  [
     'pendientes' => '',
     'completados'=> '',
     'anulados' => ''
  ];

  $MyOrders = MyOrders($id_cliente, $nivel);

  if($MyOrders)
  {
     foreach($MyOrders as $order)
     {
      $id_comercio = $order['Id_comercio'];
      $comercioData = ComercioData($id_comercio);
      $id_usuario_comercio = $comercioData[0]['Id_usuario'];
      $comercio_user_data = UserData($id_usuario_comercio);
      $comercio_user_name = $comercio_user_data[0]['User_name'];
      $email_comercio = UserEmail($id_usuario_comercio);
      $razon_social = $order['Razon_social'];
      $nro_pedido = $order['Nro_pedido'];
      $total = $order['Total'];

      $OrderDetail = OrderDetail($nro_pedido);

      $perfil = SearchProfilePhoto($id_usuario_comercio, 'perfil');
      if($perfil === true)
      {
        $foto = "../../img/profile/users/$id_usuario_comercio/photo/perfil.jpg";
      }
      else
      {
        $letra = substr($comercio_user_name, 0,1);

        $foto = "../../img/profile/letters/$letra.jpg";
      }

      $resultado = OrderStatus($nro_pedido);
      $estatus = ProcessOrderStatus($resultado);
      $estado = $estatus['estado'];
      $conductor = $estatus['conductor'];
      $movimiento = $estatus['movimiento'];
      $background = $estatus['background'];
      $progreso = $estatus['progreso'];
      $display_botones = $estatus['botones'];

      if($conductor)
      {
        foreach($conductor as $dato)
        {
           $nombre_conductor = $dato['Nombre'];
           $apellido_conductor = $dato['Apellido'];
           $marca = $dato['Marca'];
           $modelo = $dato['Modelo'];
           $placa = $dato['Placa'];

        }

        $informacion = 
        "
        <li><h6>Información del Conductor</h6></li>
        <li><h6>Nombre:</h6> $nombre_conductor $apellido_conductor</li>
        <li><h6>Detalles del Vehículo</h6></li>
        <li><h6>Marca:</h6> $marca</li>
        <li><h6>Modelo:</h6> $modelo</li>
        <li><h6>Placa:</h6> $placa</li>
        ";
      }
      else
      {
        $informacion = '';
      }

      if($display_botones)
      {
        $botones = 
        "
        <div class='container pedido-botones'>
        <button comercio='$id_comercio'  pedido='$nro_pedido' data-toggle='modal' data-target='#datos_bancarios'  class='btn btn-primary pagar-pedido'>Confirmar</button>
        <button  pedido='$nro_pedido' class='btn btn-primary anular-pedido'>Anular</button>
        </div>
        ";
      }
      else
      {
        $botones = '';
      }
      
        if($estado != 'Entregado' && $estado != 'Anulado')
        {
          $mis_pedidos['pendientes'] .= 
          "
          <ul>
          <div class='orden-pedido opciones dropdown img-fondo-blanco'>
            <a class=' orden-pedido-link btn menu_opciones'>
            <img class='img-pedido-comercio' align='left' src='$foto' alt='logo'>
             <div class='container'>
              <p class='pedido-tag-p'>$razon_social</p>
              <p class='pedido-tag-p'>$nombre $apellido</p>
             
              <div class='progress'>
              <div class='progress-bar $background' role='progressbar' aria-label='Example with label'
                style='width:$progreso%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$estado</div>
               </div>
             </div>
            </a>
               <div class='dropdown-container'>
               <div class='pedido-info'>
                $informacion
               </div>
               <div class='pedido-detalle'>
               <li><h6>Detalle del Pedido</h6></li>
               ";  

            foreach($OrderDetail as $detail)
            {
              $cantidad = $detail['Cantidad'];
              $producto = $detail['Descripcion'];

              $mis_pedidos['pendientes'] .= 
              "
              <li>
              $cantidad - $producto
              </li>
              ";

            }
              
            $mis_pedidos['pendientes'] .=
            "
            </div>
            <div class='pedido-footer'>
            Total: $.$total
            </div>

            $botones
             </div>
        
        </div>
       </ul>
       ";

      }

        if($estado === 'Entregado')
        {
          $mis_pedidos['completados'] .= 
          "
          <ul>
          <div class='orden-pedido opciones dropdown img-fondo-blanco'>
            <a class=' orden-pedido-link btn menu_opciones'>
            <img class='img-pedido-comercio' align='left' src='$foto' alt='logo'>
             <div class='container'>
              <p class='pedido-tag-p'>$razon_social</p>
              <p class='pedido-tag-p'>$nombre $apellido</p>
             
              <div class='progress'>
              <div class='progress-bar $background' role='progressbar' aria-label='Example with label'
                style='width:$progreso%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$estado</div>
               </div>
             </div>
            </a>
               <div class='dropdown-container'>
               <div class='pedido-info'>
                $informacion
               </div>
               <div class='pedido-detalle'>
               <li><h6>Detalle del Pedido</h6></li>
               ";  

            foreach($OrderDetail as $detail)
            {
              $cantidad = $detail['Cantidad'];
              $producto = $detail['Descripcion'];

              $mis_pedidos['completados'] .= 
              "
              <li>
              $cantidad - $producto
              </li>
              ";

            }
              
            $mis_pedidos['completados'] .=
            "
            </div>
            <div class='pedido-footer'>
            Total: $.$total
            </div>

            $botones
             </div>
        
        </div>
       </ul>
       ";

      }

        if($estado === 'Anulado')
        {
          $mis_pedidos['anulados'] .= 
          "
          <ul>
          <div class='orden-pedido opciones dropdown img-fondo-blanco'>
            <a class=' orden-pedido-link btn menu_opciones'>
            <img class='img-pedido-comercio' align='left' src='$foto' alt='logo'>
             <div class='container'>
              <p class='pedido-tag-p'>$razon_social</p>
              <p class='pedido-tag-p'>$nombre $apellido</p>
             
              <div class='progress'>
              <div class='progress-bar $background' role='progressbar' aria-label='Example with label'
                style='width:$progreso%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$estado</div>
               </div>
             </div>
            </a>
               <div class='dropdown-container'>
               <div class='pedido-info'>
                $informacion
               </div>
               <div class='pedido-detalle'>
               <li><h6>Detalle del Pedido</h6></li>
               ";  

            foreach($OrderDetail as $detail)
            {
              $cantidad = $detail['Cantidad'];
              $producto = $detail['Descripcion'];

              $mis_pedidos['anulados'] .= 
              "
              <li>
              $cantidad - $producto
              </li>
              ";

            }
              
            $mis_pedidos['anulados'] .=
            "
            </div>
            <div class='pedido-footer'>
            Total: $.$total
            </div>

            $botones
             </div>
        
        </div>
       </ul>
       ";

      }
    
     }
     echo json_encode($mis_pedidos);

  }

}


function BusinessOrders($id_usuario, $nivel)
{
  $rif_comercio = ComercioRif($id_usuario);
  $id_comercio = ComercioID($rif_comercio);
  $MyOrders = MyOrders($id_comercio, $nivel);
  $mis_pedidos = 
  [
    'pendientes' => '',
    'completados'=> '',
    'anulados'=> ''
  ];

  if($MyOrders)
  {
     foreach($MyOrders as $order)
     {
      $OrderStatus = $order['Recibido'];
      if($OrderStatus)
      {
        $id_cliente = $order['Id_cliente'];
        $clienteData = ClientData($id_cliente);
        $id_usuario_cliente = $clienteData[0]['Id_usuario'];
        $cliente_user_data = UserData($id_usuario_cliente);
        $cliente_user_name = $cliente_user_data[0]['User_name'];
        $email_cliente = UserEmail($id_usuario_cliente);
        $razon_social = $order['Razon_social'];
        $nombre = $clienteData[0]['Nombre'];
        $apellido = $clienteData[0]['Apellido'];
        $telefono_cliente = $clienteData[0]['Telefono'];
        $nro_pedido = $order['Nro_pedido'];
        $total = $order['Total'];
  
        $OrderDetail = OrderDetail($nro_pedido);
  
        $perfil = SearchProfilePhoto($id_usuario_cliente, 'perfil');
        if($perfil === true)
        {
          $foto = "../../img/profile/users/$id_usuario_cliente/photo/perfil.jpg";
        }
        else
        {
          $letra = substr($cliente_user_name, 0,1);
  
          $foto = "../../img/profile/letters/$letra.jpg";
        }
  
        $resultado = OrderStatus($nro_pedido);
        $estatus = ProcessOrderStatus($resultado);
        $estado = $estatus['estado'];
        $conductor = $estatus['conductor'];
        $movimiento = $estatus['movimiento'];
        $background = $estatus['background'];
        $progreso = $estatus['progreso'];
        $display_botones = $estatus['botones'];
  
        if($conductor)
        {
          foreach($conductor as $dato)
          {
             $nombre_conductor = $dato['Nombre'];
             $apellido_conductor = $dato['Apellido'];
             $marca = $dato['Marca'];
             $modelo = $dato['Modelo'];
             $placa = $dato['Placa'];
  
          }
  
          $informacion = 
          "
          <li><h6>Información del Conductor</h6></li>
          <li><h6>Nombre:</h6> $nombre_conductor $apellido_conductor</li>
          <li><h6>Detalles del Vehículo</h6></li>
          <li><h6>Marca:</h6> $marca</li>
          <li><h6>Modelo:</h6> $modelo</li>
          <li><h6>Placa:</h6> $placa</li>
          ";
        }
        else
        {
          $informacion = '';
        }
  
        if($estado === 'Creado' || $estado === 'Recibido' || $estado === 'Pagado')
        {
          $botones = 
          "
          <div class='container pedido-botones'>
          <button  pedido='$nro_pedido'  class='btn btn-primary retirar-pedido'>Delivery</button>
          <button  pedido='$nro_pedido' class='btn btn-primary anular-pedido'>Anular</button>
          </div>
          ";
        }
  
        if($estado === 'Asignado' || $estado === 'Aceptado' || $estado === 'Enviado' || $estado === 'Entregado' || $estado === 'Por Retirar' || $estado === 'Anulado')
        {
          $botones = '';
        }
  
       if($estado != 'Entregado' && $estado != 'Anulado')
       {
        $mis_pedidos['pendientes'] .= 
        "
        <ul>
        <div class='orden-pedido opciones dropdown img-fondo-blanco'>
          <a class=' orden-pedido-link btn menu_opciones'>
          <img class='img-pedido-comercio' align='left' src='$foto' alt='logo'>
           <div class='container'>
            <p>$nombre $apellido <button telefono='$telefono_cliente' class='btn ws-btn-pedidos'><i class='fab fa-whatsapp fa-2x'></i></button></p>
            <div class='progress'>
            <div class='progress-bar $background' role='progressbar' aria-label='Example with label'
              style='width:$progreso%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$estado</div>
             </div>
           </div>
          </a>
             <div class='dropdown-container'>
             <div class='pedido-info'>
              $informacion
             </div>
             <div class='pedido-detalle'>
             <li><h6>Detalle del Pedido</h6></li>
             ";
             
 
             foreach($OrderDetail as $detail)
             {
               $cantidad = $detail['Cantidad'];
               $producto = $detail['Descripcion'];
 
               $mis_pedidos['pendientes'] .= 
               "
               <li>
               $cantidad - $producto
               </li>
               ";
 
             }
               
             $mis_pedidos['pendientes'] .=
             "
             </div>
             <div class='pedido-footer'>
             Total: $.$total
             </div>
 
             $botones
              </div>
         
         </div>
        </ul>
        ";
 
       }

       if($estado === 'Entregado')
       {
        $mis_pedidos['completados'] .= 
        "
        <ul>
        <div class='orden-pedido opciones dropdown img-fondo-blanco'>
          <a class=' orden-pedido-link btn menu_opciones'>
          <img class='img-pedido-comercio' align='left' src='$foto' alt='logo'>
           <div class='container'>
            <p>$nombre $apellido <button telefono='$telefono_cliente' class='btn ws-btn-pedidos'><i class='fab fa-whatsapp fa-2x'></i></button></p>
            <div class='progress'>
            <div class='progress-bar $background' role='progressbar' aria-label='Example with label'
              style='width:$progreso%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$estado</div>
             </div>
           </div>
          </a>
             <div class='dropdown-container'>
             <div class='pedido-info'>
              $informacion
             </div>
             <div class='pedido-detalle'>
             <li><h6>Detalle del Pedido</h6></li>
             ";
             
 
             foreach($OrderDetail as $detail)
             {
               $cantidad = $detail['Cantidad'];
               $producto = $detail['Descripcion'];
 
               $mis_pedidos['completados'] .= 
               "
               <li>
               $cantidad - $producto
               </li>
               ";
 
             }
               
             $mis_pedidos['completados'] .=
             "
             </div>
             <div class='pedido-footer'>
             Total: $.$total
             </div>
 
             $botones
              </div>
         
         </div>
        </ul>
        ";
 
       }

       if($estado === 'Anulado')
       {
        $mis_pedidos['anulados'] .= 
        "
        <ul>
        <div class='orden-pedido opciones dropdown img-fondo-blanco'>
          <a class=' orden-pedido-link btn menu_opciones'>
          <img class='img-pedido-comercio' align='left' src='$foto' alt='logo'>
           <div class='container'>
            <p>$nombre $apellido <button telefono='$telefono_cliente' class='btn ws-btn-pedidos'><i class='fab fa-whatsapp fa-2x'></i></button></p>
            <div class='progress'>
            <div class='progress-bar $background' role='progressbar' aria-label='Example with label'
              style='width:$progreso%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$estado</div>
             </div>
           </div>
          </a>
             <div class='dropdown-container'>
             <div class='pedido-info'>
              $informacion
             </div>
             <div class='pedido-detalle'>
             <li><h6>Detalle del Pedido</h6></li>
             ";
             
 
             foreach($OrderDetail as $detail)
             {
               $cantidad = $detail['Cantidad'];
               $producto = $detail['Descripcion'];
 
               $mis_pedidos['anulados'] .= 
               "
               <li>
               $cantidad - $producto
               </li>
               ";
 
             }
               
             $mis_pedidos['anulados'] .=
             "
             </div>
             <div class='pedido-footer'>
             Total: $.$total
             </div>
 
             $botones
              </div>
         
         </div>
        </ul>
        ";
 
       }
       
      }

     }
     echo json_encode($mis_pedidos);

  }
}

function ProcessOrderStatus($resultado)
{
    foreach($resultado as $pedido)
    {
      $creado = $pedido['Creado'];
      $recibido = $pedido['Recibido'];
      $pagado = $pedido['Pagado'];
      $retirar = $pedido['Retirar'];
      $asignado = $pedido['Asignado'];
      $aceptado = $pedido['Aceptado'];
      $enviado = $pedido['Enviado'];
      $entregado = $pedido['Entregado'];
      $anulado = $pedido['Anulado'];
      $id_conductor = $pedido['Id_conductor'];
      $movimiento = $pedido['U_movimiento'];
    }
  
    $background = 'bg-primary';
  
    if($creado)
    {
      $estatus = 'Creado';
      $botones = 1;
      $progress = 12;
    }
    if($recibido)
    {
      $estatus = 'Recibido';
      $botones = 0;
      $progress = 24;
    }
    if($pagado)
    {
      $estatus = 'Pagado';
      $botones = 0;
      $progress = 36;
    }
    if($retirar)
    {
      $estatus = 'Por Retirar';
      $botones = 0;
      $progress = 48;
    }
    if($asignado)
    {
      $estatus = 'Asignado';
      $botones = 0;
      $progress = 60;
    }
    if($aceptado)
    {
      $estatus = 'En Tránsito';
      $botones = 0;
      $progress = 72;
    }
    if($enviado)
    {
      $estatus = 'Enviado';
      $botones = 0;
      $progress = 84;
    }
    if($entregado)
    {
      $estatus = 'Entregado';
      $background = 'bg-success';
      $botones = 0;
      $progress = 100;
    }
    if($anulado)
    {
      $estatus = 'Anulado';
      $background = 'bg-danger';
      $botones = 0;
      $progress = 100;
    }
  
    if($id_conductor)
    {
      $conductor = DriverData($id_conductor);
    }
    else
    {
      $conductor = false;
    }
  
    $estado =
    [
      'estado'=> $estatus,
      'conductor'=> $conductor,
      'movimiento'=> $movimiento,
      'background'=> $background,
      'botones'=> $botones,
      'progreso'=> $progress
    ];

    return $estado;
  }
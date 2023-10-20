<?php

function mis_pedidos()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  
  if($AdminLevel != '3')
  {
    $ClientData = ClientData($UserID);

    if ($ClientData) {
      $id_cliente = $ClientData[0]['Id'];
      ClientOrders($id_cliente);
    }
    else
    {
      $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
      $mis_pedidos =
      [
        'titulo' => $back_btn . 'MIS PEDIDOS',
        'pendientes' => EmptyPage('Cliente No Registrado'),
        'completados' => EmptyPage('Cliente No Registrado'),
        'anulados' => EmptyPage('Cliente No Registrado')
      ];
  
      echo json_encode($mis_pedidos);
    }
  }
  else
  {
     $ComercioData = ComercioData($UserID);

     if($ComercioData)
     {
       $id_comercio = $ComercioData[0]['Id'];
       BusinessOrders($id_comercio);
     }
     else
     {
      $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
      $mis_pedidos =
      [
        'titulo' => $back_btn . 'MIS PEDIDOS',
        'pendientes' => EmptyPage('Comercio No Registrado'),
        'completados' => EmptyPage('Comercio  No Registrado'),
        'anulados' => EmptyPage('Comercio  No Registrado')
      ];
  
      echo json_encode($mis_pedidos);
     }
  }
}

function ClientOrders($id_cliente)
{
  $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
  $mis_pedidos =
    [
      'titulo' => $back_btn . 'MIS PEDIDOS',
      'pendientes' => '',
      'completados' => '',
      'anulados' => ''
    ];

  $MyOrders = MyOrders('Id_cliente', $id_cliente);

  if ($MyOrders) {

    foreach ($MyOrders as $order) {
      $nro_pedido = $order['Nro_pedido'];
      $ProcessOrderStatus = ProcessOrderStatus($nro_pedido);
      $progreso = $ProcessOrderStatus['progreso'];
      $estado = $ProcessOrderStatus['estado'];
      $links = $ProcessOrderStatus['enlaces'];
      $fecha = DateFormat($order['Fecha']);
      $actualizado = $order['Actualizado'];
      $fecha_actual = CurrentTime();
      $id_usuario = $order['Usuario_comercio'];
      $razon_social = $order['Razon_social'];
      $telefono = $order['Telefono_comercio'];
      $nombre_cliente = $order['Nombre_cliente'];
      $apellido_cliente = $order['Apellido_cliente'];
      $metodo_pago = $order['Metodo_pago'];
      $actualizado = TimeDifference($actualizado, $fecha_actual);
      $foto = SearchProfilePhoto($id_usuario);

      if ($estado != 'Entregado' && $estado != 'Anulado') {
        $mis_pedidos['pendientes'] .=
          "
          <div class='card-order'>
          <div class='order-header'>
            <strong class='me-auto'>$fecha</strong>
            <small>$actualizado</small>
          </div>
          <div class='card-order-body'>
            <div class='order-img'>
             <img class='img-order' src='$foto' alt='Foto de Perfil'>
            </div>
            <div class='order-data'>
            <div class='order-title'><a href='detalle_pedido?pedido=$nro_pedido' class='order-title'>$razon_social</a> <a href='https://wa.me/$telefono' target='_blank'><i class='fa-brands fa-whatsapp'></i></a></div>
            <div class='order-text'>$nombre_cliente $apellido_cliente</div>
            <div $links class='order-links'>
            <a class='order-link' href='detalle_pedido?pedido=$nro_pedido'>Confirmar</a>
            <a class='order-link anular-pedido' pedido='$nro_pedido'>Anular</a>
            </div>
            </div>
          </div>
          <div class='order-progess'>
          <div class='progress'>
            <div class='progress-bar bg-primary' role='progressbar' aria-label='Example with label'
              style='width:$progreso%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$estado</div>
            </div>
          </div>
        </div>
        </div>
        </div>
          ";
      }

      if ($estado === 'Entregado') {
        $mis_pedidos['completados'] .=
          "
        <div class='card-order'>
        <div class='order-header'>
          <strong class='me-auto'>$fecha</strong>
          <small>$actualizado</small>
        </div>
        <div class='card-order-body'>
          <div class='order-img'>
           <img class='img-order' src='$foto' alt='Foto de Perfil'>
          </div>
          <div class='order-data'>
          <div class='order-title'> <a href='detalle_pedido?pedido=$nro_pedido' class='order-title'>$razon_social</a></div>
          <div class='order-text'>$nombre_cliente $apellido_cliente</div>
          <div $links class='order-links'>
          <a class='order-link' href='#'>Confirmar</a>
          <a class='order-link anular-pedido' pedido='$nro_pedido'>Anular</a>
          </div>
          </div>
        </div>
        <div class='order-progess'>
        <div class='progress'>
          <div class='progress-bar bg-primary' role='progressbar' aria-label='Example with label'
            style='width:$progreso%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$estado</div>
          </div>
        </div>
      </div>
      </div>
      </div>
        ";
      }

      if ($estado === 'Anulado') {
        $mis_pedidos['anulados'] .=
          "
        <div class='card-order'>
        <div class='order-header'>
          <strong class='me-auto'>$fecha</strong>
          <small>$actualizado</small>
        </div>
        <div class='card-order-body'>
          <div class='order-img'>
           <img class='img-order' src='$foto' alt='Foto de Perfil'>
          </div>
          <div class='order-data'>
          <div class='order-title'> <a href='detalle_pedido?pedido=$nro_pedido' class='order-title'>$razon_social</a></div>
          <div class='order-text'>$nombre_cliente $apellido_cliente</div>
          <div $links class='order-links'>
          <a class='order-link' href='#'>Confirmar</a>
          <a class='order-link anular-pedido' pedido='$nro_pedido'>Anular</a>
          </div>
          </div>
        </div>
        <div class='order-progess'>
        <div class='progress'>
          <div class='progress-bar bg-danger' role='progressbar' aria-label='Example with label'
            style='width:$progreso%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$estado</div>
          </div>
        </div>
      </div>
      </div>
      </div>
        ";
      }
    }
  } else {
    $mis_pedidos =
      [
        'titulo' => $back_btn . 'MIS PEDIDOS',
        'pendientes' => EmptyPage('Sin Pedidos Para Mostrar'),
        'completados' => EmptyPage('Sin Pedidos Para Mostrar'),
        'anulados' => EmptyPage('Sin Pedidos Para Mostrar')
      ];
  }


  echo json_encode($mis_pedidos);
}

function detalle_pedido()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
  $mi_pedido =
    [
      'titulo' => $back_btn . 'MI PEDIDO',
      'contenido' => ''
    ];

  if (isset($_POST['nro_pedido'])) {
    $nro_pedido = $_POST['nro_pedido'];
    $nro_pedido = filter_var($nro_pedido, FILTER_SANITIZE_NUMBER_INT);
    $OrderDetail = OrderDetail($nro_pedido);

    if ($OrderDetail) {
      $Usuario_comercio = $OrderDetail[0]['Usuario_comercio'];
      $Usuario_cliente = $OrderDetail[0]['Usuario_cliente'];
      $foto_comercio = SearchProfilePhoto($Usuario_comercio);
      $foto_cliente = SearchProfilePhoto($Usuario_cliente);

      $mi_pedido['contenido'] =
        "
      <div class='detalle-pedido-header'>
        <div class='container-img-header'>
         <img class='detalle-img-header' src='$foto_cliente' alt='Foto de Perfil'>
        </div>
        <hr class='detalle-divider'>
        <div class='container-img-header'>
         <img class='detalle-img-header' src='$foto_comercio' alt='Foto de Perfil'>
        </div>
     </div>
      ";
      foreach ($OrderDetail as $order) {
        $id_cliente = $order['Id_cliente'];
        $id_comercio = $order['Id_comercio'];
        $id_producto = $order['Id_producto'];
        $descripcion = $order['Descripcion'];
        $cantidad = $order['Cantidad'];
        $pciva = $order['P_civa'];
        $psiva = $order['P_siva'];
        $iva = $pciva - $psiva;
        $subtotal = $order['Subtotal'];
        $alicuota = $order['Iva'];
        $total = $order['Total'];
        $foto = SearchProductPhoto($id_comercio, $id_producto);

        $mi_pedido['contenido'] .=
          "
        <div class='card-product'>
         <div class='product-img-car'>
           <img class='product-img' src='$foto' alt='$descripcion'><span class='badge detail-badge bg-primary'>$cantidad</span>
         </div>
         <div class='card-product-title'>
           $descripcion $id_producto
         </div>
         <div class='card-product-price'>
           <p class='card-product-main-price'>$. $pciva</p>
           <p class='card-product-text'>$. $psiva</p>
           <p class='card-product-text'>I.V.A $. $iva</p>
         </div>
         </div>
        ";
      }

      $ProcessOrderStatus = ProcessOrderStatus($nro_pedido);
      $progreso = $ProcessOrderStatus['progreso'];
      $estado = $ProcessOrderStatus['estado'];

      if($AdminLevel != '3')
      {
        if($estado === 'Creado')
        {
          $boton_confirmar = "<a href='finalizar_compra?cliente=$id_cliente&comercio=$id_comercio&pedido=$nro_pedido' class='finalizar-compra-button' id='finalizar_compra'>Finalizar Compra</a>";
        }
        else
        {
          if($estado != 'Anulado')
          { 
            $background = 'bg-primary';
          }
          else
          {
             $background = 'bg-danger';
          }
  
          $boton_confirmar = 
          "
          <div class='order-progess w-100'>
          <div class='progress'>
            <div class='progress-bar $background' role='progressbar' aria-label='Example with label'
              style='width:$progreso%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$estado</div>
            </div>
          </div>
          ";
  
        }
      }
      else
      {
        if($estado === 'Recibido')
        {
          $boton_confirmar =
           "
           <div class='order-links'>
           <a class='order-link retirar-pedido' pedido='$nro_pedido'>Pedido Listo</a>
           <a class='order-link anular-pedido' pedido='$nro_pedido'>Anular</a>
           </div>
           ";
        }
        else
        {
          if($estado != 'Anulado')
          { 
            $background = 'bg-primary';
          }
          else
          {
             $background = 'bg-danger';
          }
  
          $boton_confirmar = 
          "
          <div class='order-progess w-100'>
          <div class='progress'>
            <div class='progress-bar $background' role='progressbar' aria-label='Example with label'
              style='width:$progreso%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$estado</div>
            </div>
          </div>
          ";
  
        }
      } 
      
      if($AdminLevel != '3')
      {
         $class = 'amount-footer';
      }
      else
      {
         $class = '';
      }


      $mi_pedido['contenido'] .=
        "
              <div class='container-amount'>
              <div class='amount-item'>
                  <p class='amount'>Subtotal:</p> <p class='amount'>$.$subtotal</p>
              </div>
              <div class='amount-item'>
                 <p class='amount'>I.V.A:</p> <p class='amount'>$.$alicuota</p>
              </div>
              <div class='amount-item'>
                <p class='amount'>Total:</p> <p class='amount'>$.$total</p>
              </div>
              <div class='$class'>
                $boton_confirmar
              </div>
              </div>";
    } else {
      $mi_pedido['contenido'] = EmptyPage('Sin Detalles Para Mostrar');
    }

    echo json_encode($mi_pedido);
  }
}

function finalizar_compra()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
  $compra =
    [
      'titulo' => $back_btn . 'FINALIZAR COMPRA',
      'metodos' => '',
      'montos' => '',
      'salida' => '',
      'destino' => ''
    ];

  if (isset($_POST['id_cliente']) && isset($_POST['id_comercio']) && isset($_POST['nro_pedido'])) {

    $id_cliente = $_POST['id_cliente'];
    $id_comercio = $_POST['id_comercio'];
    $nro_pedido = $_POST['nro_pedido'];

    $id_cliente = filter_var($id_cliente, FILTER_SANITIZE_NUMBER_INT);
    $id_comercio = filter_var($id_comercio, FILTER_SANITIZE_NUMBER_INT);
    $nro_pedido = filter_var($nro_pedido, FILTER_SANITIZE_NUMBER_INT);

    if ($id_cliente && $id_comercio && $nro_pedido) {
      $Usuario_comercio = UserTableID('comercios', $id_comercio);
      $Usuario_cliente = UserTableID('clientes', $id_cliente);

      $OptionsPaymentMethods = OptionsPaymentMethods($id_comercio);
      $direcciones_comercio = MyStaticLocations($Usuario_comercio);
      $direcciones_cliente = MyStaticLocations($Usuario_cliente);
      $MyCurrentLocation = MyCurrentLocation($Usuario_cliente);
      $OrderDetail = OrderDetail($nro_pedido);

      if ($OptionsPaymentMethods && $direcciones_comercio && $MyCurrentLocation && $OrderDetail) {
        foreach ($OptionsPaymentMethods as $method) {
          $id_metodo = $method['Id_metodo'];
          $nombre = $method['Categoria'];

          $compra['metodos'] .=
            "
                 <option value='$id_metodo'>$nombre</option>
             ";
        }

        foreach ($direcciones_comercio as $comdir) {
          $id_comdir = $comdir['Id'];
          $nombre_comdir = $comdir['Nombre'];
          $ubicacion_comdir = $comdir['Ubicacion'];

          $compra['salida'] .=
            "
             <option value='$ubicacion_comdir'>$nombre_comdir</option>
             ";
        }

        foreach ($MyCurrentLocation as $location) {
          $id_location = $location['Id'];
          $location_name = $location['Ubicacion'];

          $compra['destino'] .=
            "
             <option value='$location_name'>$location_name</option>
             ";
        }
        foreach ($direcciones_cliente as $clientdir) {
          $id_clientdir = $clientdir['Id'];
          $nombre_clientdir = $clientdir['Nombre'];
          $ubicacion_clientdir = $clientdir['Ubicacion'];

          $compra['destino'] .=
            "
             <option value='$ubicacion_clientdir'>$nombre_clientdir</option>
             ";
        }

        foreach($OrderDetail as $order)
        {
           $usd = $order['Total'];
           $tasa = TasaDD();
           $bs = $usd * $tasa;
           

           $compra['montos'] =
           "
           <div class='card-db'>
           <ul class='card-db-items'>
           <li class='card-db-item'>Total Divisas: $usd</li>
           <li class='card-db-item'>Total BS: $bs</li>
           </ul>
           </div>
           ";
        }
      }
    } else {
      $compra['metodos'] = EmptyPage('Sin Datos Para Mostrar');
    }

    echo json_encode($compra);
  }
}

function BusinessOrders($id_comercio)
{
  $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
  $mis_pedidos =
    [
      'titulo' => $back_btn . 'MIS PEDIDOS',
      'pendientes' => '',
      'completados' => '',
      'anulados' => ''
    ];

  $MyOrders = MyOrders('Id_comercio', $id_comercio);

  if ($MyOrders) {

    foreach ($MyOrders as $order) {
      $nro_pedido = $order['Nro_pedido'];
      $ProcessOrderStatus = ProcessOrderStatus($nro_pedido);
      $progreso = $ProcessOrderStatus['progreso'];
      $estado = $ProcessOrderStatus['estado'];
      $links = $ProcessOrderStatus['enlaces'];
      $fecha = DateFormat($order['Fecha']);
      $actualizado = $order['Actualizado'];
      $fecha_actual = CurrentTime();
      $id_usuario = $order['Usuario_cliente'];
      $razon_social = $order['Razon_social'];
      $telefono = $order['Telefono_cliente'];
      $nombre_cliente = $order['Nombre_cliente'];
      $apellido_cliente = $order['Apellido_cliente'];
      $metodo_pago = $order['Metodo_pago'];
      $actualizado = TimeDifference($actualizado, $fecha_actual);
      $foto = SearchProfilePhoto($id_usuario);

      if($estado === 'Recibido')
      {
         $links = '';
      }

      if ($estado != 'Creado' && $estado != 'Entregado' && $estado != 'Anulado') {
        $mis_pedidos['pendientes'] .=
          "
          <div class='card-order'>
          <div class='order-header'>
            <strong class='me-auto'>$fecha</strong>
            <small>$actualizado</small>
          </div>
          <div class='card-order-body'>
            <div class='order-img'>
             <img class='img-order' src='$foto' alt='Foto de Perfil'>
            </div>
            <div class='order-data'>
            <div class='order-title'><a href='detalle_pedido?pedido=$nro_pedido' class='order-title'>$nombre_cliente $apellido_cliente</a> <a href='https://wa.me/$telefono' target='_blank'><i class='fa-brands fa-whatsapp'></i></a></div>
            <div class='order-text'>$razon_social</div>
            <div $links class='order-links'>
            <a class='order-link retirar-pedido' pedido='$nro_pedido'>Pedido Listo</a>
            <a class='order-link anular-pedido' pedido='$nro_pedido'>Anular</a>
            </div>
            </div>
          </div>
          <div class='order-progess'>
          <div class='progress'>
            <div class='progress-bar bg-primary' role='progressbar' aria-label='Example with label'
              style='width:$progreso%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$estado</div>
            </div>
          </div>
        </div>
        </div>
        </div>
          ";
      }

      if ($estado === 'Entregado') {
        $mis_pedidos['completados'] .=
          "
        <div class='card-order'>
        <div class='order-header'>
          <strong class='me-auto'>$fecha</strong>
          <small>$actualizado</small>
        </div>
        <div class='card-order-body'>
          <div class='order-img'>
           <img class='img-order' src='$foto' alt='Foto de Perfil'>
          </div>
          <div class='order-data'>
          <div class='order-title'> <a href='detalle_pedido?pedido=$nro_pedido' class='order-title'>$nombre_cliente $apellido_cliente</a></div>
          <div class='order-text'>$razon_social</div>
          </div>
        </div>
        <div class='order-progess'>
        <div class='progress'>
          <div class='progress-bar bg-primary' role='progressbar' aria-label='Example with label'
            style='width:$progreso%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$estado</div>
          </div>
        </div>
      </div>
      </div>
      </div>
        ";
      }

      if ($estado === 'Anulado') {
        $mis_pedidos['anulados'] .=
          "
        <div class='card-order'>
        <div class='order-header'>
          <strong class='me-auto'>$fecha</strong>
          <small>$actualizado</small>
        </div>
        <div class='card-order-body'>
          <div class='order-img'>
           <img class='img-order' src='$foto' alt='Foto de Perfil'>
          </div>
          <div class='order-data'>
          <div class='order-title'> <a href='detalle_pedido?pedido=$nro_pedido' class='order-title'>$nombre_cliente $apellido_cliente</a></div>
          <div class='order-text'>$razon_social</div>
          </div>
        </div>
        <div class='order-progess'>
        <div class='progress'>
          <div class='progress-bar bg-danger' role='progressbar' aria-label='Example with label'
            style='width:$progreso%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$estado</div>
          </div>
        </div>
      </div>
      </div>
      </div>
        ";
      }
    }
  } else {
    $mis_pedidos =
      [
        'titulo' => $back_btn . 'MIS PEDIDOS',
        'pendientes' => EmptyPage('Sin Pedidos Para Mostrar'),
        'completados' => EmptyPage('Sin Pedidos Para Mostrar'),
        'anulados' => EmptyPage('Sin Pedidos Para Mostrar')
      ];
  }


  echo json_encode($mis_pedidos);
}
<?php

function mis_pedidos()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);

  if ($AdminLevel != '3') {
    $ClientData = ClientData($UserID);
    if ($ClientData) {
      $id_cliente = $ClientData[0]['Id'];
      ClientOrders($id_cliente);
    }
  } else {
    BusinessOrders($UserID, $AdminLevel);
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
            <div class='order-title'>$razon_social <a href='https://wa.me/$telefono' target='_blank'><i class='fa-brands fa-whatsapp'></i></a></div>
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
          <div class='order-title'>$razon_social</div>
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
          <div class='order-title'>$razon_social</div>
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
              <div class='amount-footer'>
                <a href='finalizar_compra?cliente=$id_cliente&comercio=$id_comercio&pedido=$nro_pedido' class='finalizar-compra-button' id='finalizar_compra'>Finalizar Compra</a>
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
      'datos'=> '',
      'salida'=> '',
      'destino'=> ''
    ];

    if(isset($_POST['id_cliente']) && isset($_POST['id_comercio']) && isset($_POST['nro_pedido']))
    {

      $id_cliente = $_POST['id_cliente'];
      $id_comercio = $_POST['id_comercio'];
      $nro_pedido = $_POST['nro_pedido'];

      $id_cliente = filter_var($id_cliente, FILTER_SANITIZE_NUMBER_INT);
      $id_comercio = filter_var($id_comercio, FILTER_SANITIZE_NUMBER_INT);
      $nro_pedido = filter_var($nro_pedido, FILTER_SANITIZE_NUMBER_INT);

      if($id_cliente && $id_comercio && $nro_pedido)
      {
        $Usuario_comercio = UserTableID('comercios', $id_comercio);
        $Usuario_cliente = UserTableID('clientes', $id_cliente);

        $OptionsPaymentMethods = OptionsPaymentMethods($id_comercio);
        $direcciones_comercio = MyStaticLocations($Usuario_comercio);
        $direcciones_cliente = MyStaticLocations($Usuario_cliente);
        $MyCurrentLocation = MyCurrentLocation($Usuario_cliente);

        if($OptionsPaymentMethods && $direcciones_comercio && $MyCurrentLocation)
        {
          $compra['metodos'] =
          "
          <label class='form-label' for='metodos'>Métodos de Pago</label>
          <select class='form-select perfil-select' id='metodos' name='metodos'>";
          foreach($OptionsPaymentMethods as $method)
          {
             $id_metodo = $method['Id_metodo'];
             $nombre = $method['Categoria'];

             $compra['metodos'] .= 
             "
                 <option value='$id_metodo'>$nombre</option>
             ";
          }

          $compra['metodos'] .=
          "
          </select>
          ";

          $compra['salida'] =
          "
          <label class='form-label' for='from'>Dirección</label>
          <select class='form-select perfil-select' id='from' name='from'>";
          foreach($direcciones_comercio as $comdir)
          {
             $id_comdir = $comdir['Id'];
             $nombre_comdir = $comdir['Nombre'];
             $ubicacion_comdir = $comdir['Ubicacion'];

             $compra['salida'] .=
             "
             <option value='$ubicacion_comdir'>$nombre_comdir</option>
             ";

          }          
          $compra['salida'] .=
          "    
          </select>
          ";
          
          $compra['destino'] =
          "
          <label class='form-label' for='to'>Mis Direcciones</label>
          <select class='form-select perfil-select' id='to' name='to'>";
          foreach($MyCurrentLocation as $location)
          {
            $id_location = $location['Id'];
            $location_name = $location['Ubicacion'];

             $compra['destino'] .=
             "
             <option value='$location_name'>$location_name</option>
             ";

          }          
          foreach($direcciones_cliente as $clientdir)
          {
             $id_clientdir = $clientdir['Id'];
             $nombre_clientdir = $clientdir['Nombre'];
             $ubicacion_clientdir = $clientdir['Ubicacion'];

             $compra['destino'] .=
             "
             <option value='$ubicacion_clientdir'>$nombre_clientdir</option>
             ";

          }          
          $compra['destino'] .=
          "    
          </select>
          ";
        }
      }
      else
      {
         $compra['metodos'] = EmptyPage('Sin Datos Para Mostrar');
      }

      echo json_encode($compra);
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
      'completados' => '',
      'anulados' => ''
    ];

  if ($MyOrders) {

    foreach ($MyOrders as $order) {
      $OrderStatus = $order['Recibido'];
      if ($OrderStatus) {
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
        $metodo_pago = $OrderDetail[0]['Categoria'];

        $perfil = SearchProfilePhoto($id_usuario_cliente, 'perfil');
        if ($perfil === true) {
          $foto = "../../server/images/profile/users/$id_usuario_cliente/photo/perfil.jpg";
        } else {
          $letra = substr($cliente_user_name, 0, 1);

          $foto = "../../server/images/profile/letters/$letra.jpg";
        }

        $resultado = OrderStatus($nro_pedido);
        $estatus = ProcessOrderStatus($resultado);
        $estado = $estatus['estado'];
        $conductor = $estatus['conductor'];
        $movimiento = $estatus['movimiento'];
        $background = $estatus['background'];
        $progreso = $estatus['progreso'];
        $display_botones = $estatus['botones'];
        $pagado = $estatus['pagado'];

        if ($conductor) {
          foreach ($conductor as $dato) {
            $nombre_conductor = $dato['Nombre'];
            $apellido_conductor = $dato['Apellido'];
            $marca = $dato['Marca'];
            $modelo = $dato['Modelo'];
            $placa = $dato['Placa'];
          }

          $informacion =
            "
          <li><h6>Detalles del Conductor</h6></li>
          <li><h6>Nombre:</h6> $nombre_conductor $apellido_conductor</li>
          <li><h6>Detalles del Vehículo</h6></li>
          <li><h6>Marca:</h6> $marca</li>
          <li><h6>Modelo:</h6> $modelo</li>
          <li><h6>Placa:</h6> $placa</li>
          ";
        } else {
          $informacion = '';
        }

        if ($estado === 'Creado' || $estado === 'Recibido' || $estado === 'Pagado') {
          $botones =
            "
          <div class='container pedido-botones'>
          <button  pedido='$nro_pedido'  class='btn btn-primary retirar-pedido'>Delivery</button>
          <button  pedido='$nro_pedido' class='btn btn-primary anular-pedido'>Anular</button>
          </div>
          ";
        }

        if ($estado === 'Asignado' || $estado === 'Aceptado' || $estado === 'Enviado' || $estado === 'Entregado' || $estado === 'Por Retirar' || $estado === 'Anulado') {
          $botones = '';
        }

        if ($estado != 'Entregado' && $estado != 'Anulado') {
          $mis_pedidos['pendientes'] .=
            "
        <div class='orden-pedido opciones dropdown img-fondo-blanco'>
          <a class=' orden-pedido-link btn menu_opciones'>
          <img class='img-pedido-comercio' align='left' src='$foto' alt='logo'>
           <div class='container' data-bs-toggle='collapse' data-bs-target='.toast_$nro_pedido' data-bs-auto-close='true'>
            <p>$nombre $apellido <button telefono='$telefono_cliente' class='btn ws-btn-pedidos'><i class='fab fa-whatsapp fa-2x'></i></button></p>
            <div class='progress'>
            <div class='progress-bar $background' role='progressbar' aria-label='Example with label'
              style='width:$progreso%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$estado</div>
             </div>
           </div>
          </a>
             <div class='toast_$nro_pedido collapse'>
             <div class='pedido-info'>
              $informacion
             </div>
             <div class='pedido-info'>
             <li><h6>Detalles del Pago:</h6> $metodo_pago</li>
             <li><h6>Estatus:</h6> $pagado</li>
             </div>
             <div class='pedido-detalle'>
             <li><h6>Contenido del Pedido</h6></li>
             ";


          foreach ($OrderDetail as $detail) {
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
        ";
        }

        if ($estado === 'Entregado') {
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
             <div class='pedido-info'>
             <li><h6>Detalles del Pago:</h6> $metodo_pago</li>
             <li><h6>Estatus:</h6> $pagado</li>
             </div>
             <div class='pedido-detalle'>
             <li><h6>Detalle del Pedido</h6></li>
             ";


          foreach ($OrderDetail as $detail) {
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

        if ($estado === 'Anulado') {
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
             <div class='pedido-info'>
             <li><h6>Detalles del Pago:</h6> $metodo_pago</li>
             <li><h6>Estatus:</h6> $pagado</li>
             </div>
             <div class='pedido-detalle'>
             <li><h6>Detalle del Pedido</h6></li>
             ";


          foreach ($OrderDetail as $detail) {
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

<?php

function mis_envios()
{
  $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
  $mis_envios =
    [
      'titulo' => $back_btn . 'DELIVERIES',
      'pendientes' => '',
      'asignados' => '',
      'transito' => '',
      'completados' => ''
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
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $respuesta = '';

  if ($AdminLevel === '1') {
    $ListDelivery = ListDelivery(0, 0, 0);
    if ($ListDelivery) {
      foreach ($ListDelivery as $envio) {
        $id_envio = $envio['Id_envio'];
        $id_comercio = $envio['Id_comercio'];
        $id_cliente = $envio['Id_cliente'];
        $usuario_comercio = $envio['Usuario_comercio'];
        $usuario_cliente = $envio['Usuario_cliente'];
        $razon_social = $envio['Razon_social'];
        $nombre_cliente = $envio['Nombre_cliente'];
        $apellido_cliente = $envio['Apellido_cliente'];
        $telefono_comercio = $envio['Telefono_comercio'];
        $telefono_cliente = $envio['Telefono_cliente'];
        $fecha = $envio['Fecha'];
        $actualizado = $envio['Actualizado'];
        $fecha_actual = CurrentTime();
        $actualizado = TimeDifference($actualizado, $fecha_actual);
        $foto_comercio = SearchProfilePhoto($usuario_comercio);
        $foto_cliente = SearchProfilePhoto($usuario_cliente);
        $nro_pedido = $envio['Nro_pedido'];

        $respuesta .=
          "
          <div class='card-delivery'>
          <div class='card-delivery-header'>
            <strong class='me-auto'>$fecha</strong>
            <small>$actualizado</small>
          </div>
          <div class='card-delivery-body'>
            <div class='delivery-img'>
             <img class='img-delivery' src='$foto_comercio' alt='Foto de Perfil'>
            </div>
            <div class='delivery-data'>
            <div class='card-delivery-title'><a href='detalle_envio?pedido=$nro_pedido' class='order-title'>$razon_social</a>
             <a href='https://wa.me/$telefono_comercio' target='_blank'><i class='fa-brands fa-whatsapp'></i></a></div>
            <div class='delivery-text'>$nombre_cliente $apellido_cliente 
            <a href='https://wa.me/$telefono_cliente' target='_blank'><i class='fa-brands fa-whatsapp'></i></a></div>
            <div  class='delivery-links'>
            <a class='delivery-link' href='detalle_envio?envio=$id_envio&pedido=$nro_pedido'>Detalle</a>
            <a id='$nro_pedido' data-toggle='modal' data-target='#asignar_conductor' class='asignar-conductor delivery-link'>
             Asignar</a>
            </div>
            </div>
          </div>
        </div>
        </div>
          ";
      }

      return $respuesta;
    } else {
      $respuesta =  EmptyPage('Sin Envíos Pendientes Por Asignar.');
      return $respuesta;
    }
  }

  if ($AdminLevel === '2') {
    $DriverData = DriverData($UserID);
    $id_conductor = $DriverData[0]['Id_conductor'];
    $ListDeliveryByDriver = ListDeliveryByDriver(1, 0, 0, $id_conductor);

    if ($ListDeliveryByDriver) {
      foreach ($ListDeliveryByDriver as $envio) {
        $id_envio = $envio['Id_envio'];
        $id_comercio = $envio['Id_comercio'];
        $id_cliente = $envio['Id_cliente'];
        $usuario_comercio = $envio['Usuario_comercio'];
        $usuario_cliente = $envio['Usuario_cliente'];
        $razon_social = $envio['Razon_social'];
        $nombre_cliente = $envio['Nombre_cliente'];
        $apellido_cliente = $envio['Apellido_cliente'];
        $telefono_comercio = $envio['Telefono_comercio'];
        $telefono_cliente = $envio['Telefono_cliente'];
        $fecha = $envio['Fecha'];
        $actualizado = $envio['Actualizado'];
        $fecha_actual = CurrentTime();
        $actualizado = TimeDifference($actualizado, $fecha_actual);
        $foto_comercio = SearchProfilePhoto($usuario_comercio);
        $foto_cliente = SearchProfilePhoto($usuario_cliente);
        $nro_pedido = $envio['Nro_pedido'];

        $respuesta .=
          "
          <div class='card-delivery'>
          <div class='card-delivery-header'>
            <strong class='me-auto'>$fecha</strong>
            <small>$actualizado</small>
          </div>
          <div class='card-delivery-body'>
            <div class='delivery-img'>
             <img class='img-delivery' src='$foto_comercio' alt='Foto de Perfil'>
            </div>
            <div class='delivery-data'>
            <div class='card-delivery-title'><a href='detalle_envio?pedido=$nro_pedido' class='order-title'>$razon_social</a>
             <a href='https://wa.me/$telefono_comercio' target='_blank'><i class='fa-brands fa-whatsapp'></i></a></div>
            <div class='delivery-text'>$nombre_cliente $apellido_cliente 
            <a href='https://wa.me/$telefono_cliente' target='_blank'><i class='fa-brands fa-whatsapp'></i></a></div>
            <div  class='delivery-links'>
            <a class='delivery-link' href='detalle_envio?envio=$id_envio&pedido=$nro_pedido'>Detalle</a>
            <a pedido='$nro_pedido'  class='delivery-link aceptar-envio'>
              Aceptar</a>
            </div>
            </div>
          </div>
        </div>
        </div>
          ";
      }

      return $respuesta;
    } else {
      $respuesta = EmptyPage('Sin Envíos Pendientes Por Aceptar.');
      return $respuesta;
    }
  }
}

function envios_asignados()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $ListDelivery = ListDelivery(1, 0, 0);
  $respuesta = '';

  if ($AdminLevel === '1') {
    
    if ($ListDelivery) {
      foreach ($ListDelivery as $envio) {
        $id_envio = $envio['Id_envio'];
        $id_comercio = $envio['Id_comercio'];
        $id_cliente = $envio['Id_cliente'];
        $usuario_comercio = $envio['Usuario_comercio'];
        $usuario_cliente = $envio['Usuario_cliente'];
        $razon_social = $envio['Razon_social'];
        $nombre_cliente = $envio['Nombre_cliente'];
        $apellido_cliente = $envio['Apellido_cliente'];
        $telefono_comercio = $envio['Telefono_comercio'];
        $telefono_cliente = $envio['Telefono_cliente'];
        $fecha = $envio['Fecha'];
        $actualizado = $envio['Actualizado'];
        $fecha_actual = CurrentTime();
        $actualizado = TimeDifference($actualizado, $fecha_actual);
        $foto_comercio = SearchProfilePhoto($usuario_comercio);
        $foto_cliente = SearchProfilePhoto($usuario_cliente);
        $nro_pedido = $envio['Nro_pedido'];

        $respuesta .=
          "
          <div class='card-delivery'>
          <div class='card-delivery-header'>
            <strong class='me-auto'>$fecha</strong>
            <small>$actualizado</small>
          </div>
          <div class='card-delivery-body'>
            <div class='delivery-img'>
             <img class='img-delivery' src='$foto_comercio' alt='Foto de Perfil'>
            </div>
            <div class='delivery-data'>
            <div class='card-delivery-title'><a href='detalle_envio?pedido=$nro_pedido' class='order-title'>$razon_social</a>
             <a href='https://wa.me/$telefono_comercio' target='_blank'><i class='fa-brands fa-whatsapp'></i></a></div>
            <div class='delivery-text'>$nombre_cliente $apellido_cliente 
            <a href='https://wa.me/$telefono_cliente' target='_blank'><i class='fa-brands fa-whatsapp'></i></a></div>
            <div  class='delivery-links'>
            <a class='delivery-link' href='detalle_envio?envio=$id_envio&pedido=$nro_pedido'>Detalle</a>
            <a id='$nro_pedido' data-toggle='modal' data-target='#asignar_conductor' class='asignar-conductor delivery-link'>
             Re-Asignar</a>
            </div>
            </div>
          </div>
        </div>
        </div>
          ";
      }

      return $respuesta;
    } else {
      $respuesta = EmptyPage('Sin Envíos Pendientes Por Re-Asignar.');
      return $respuesta;
    }
  }
}

function envios_en_curso()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $ListDelivery = ListDelivery(1, 1, 0);
  $respuesta = '';

  if ($AdminLevel === '1') {
    
    if ($ListDelivery) {
      foreach ($ListDelivery as $envio) {
        $id_envio = $envio['Id_envio'];
        $id_comercio = $envio['Id_comercio'];
        $id_cliente = $envio['Id_cliente'];
        $usuario_comercio = $envio['Usuario_comercio'];
        $usuario_cliente = $envio['Usuario_cliente'];
        $razon_social = $envio['Razon_social'];
        $nombre_cliente = $envio['Nombre_cliente'];
        $apellido_cliente = $envio['Apellido_cliente'];
        $telefono_comercio = $envio['Telefono_comercio'];
        $telefono_cliente = $envio['Telefono_cliente'];
        $fecha = $envio['Fecha'];
        $actualizado = $envio['Actualizado'];
        $fecha_actual = CurrentTime();
        $actualizado = TimeDifference($actualizado, $fecha_actual);
        $foto_comercio = SearchProfilePhoto($usuario_comercio);
        $foto_cliente = SearchProfilePhoto($usuario_cliente);
        $nro_pedido = $envio['Nro_pedido'];

        $respuesta .=
          "
          <div class='card-delivery'>
          <div class='card-delivery-header'>
            <strong class='me-auto'>$fecha</strong>
            <small>$actualizado</small>
          </div>
          <div class='card-delivery-body'>
            <div class='delivery-img'>
             <img class='img-delivery' src='$foto_comercio' alt='Foto de Perfil'>
            </div>
            <div class='delivery-data'>
            <div class='card-delivery-title'><a href='detalle_envio?pedido=$nro_pedido' class='order-title'>$razon_social</a>
             <a href='https://wa.me/$telefono_comercio' target='_blank'><i class='fa-brands fa-whatsapp'></i></a></div>
            <div class='delivery-text'>$nombre_cliente $apellido_cliente 
            <a href='https://wa.me/$telefono_cliente' target='_blank'><i class='fa-brands fa-whatsapp'></i></a></div>
            <div  class='delivery-links'>
            <a class='delivery-link' href='detalle_envio?envio=$id_envio&pedido=$nro_pedido'>Detalle</a>
            </div>
            </div>
          </div>
        </div>
        </div>
          ";
      }

      return $respuesta;
    } else {
      $respuesta = EmptyPage('Sin Envíos En Transito.');
      return $respuesta;
    }
  }

  if ($AdminLevel === '2') {
    $DriverData = DriverData($UserID);
    $id_conductor = $DriverData[0]['Id_conductor'];
    $ListDeliveryByDriver = ListDeliveryByDriver(1, 1, 0, $id_conductor);

    if ($ListDeliveryByDriver) {
      foreach ($ListDeliveryByDriver as $envio) {
        $id_envio = $envio['Id_envio'];
        $id_comercio = $envio['Id_comercio'];
        $id_cliente = $envio['Id_cliente'];
        $usuario_comercio = $envio['Usuario_comercio'];
        $usuario_cliente = $envio['Usuario_cliente'];
        $razon_social = $envio['Razon_social'];
        $nombre_cliente = $envio['Nombre_cliente'];
        $apellido_cliente = $envio['Apellido_cliente'];
        $telefono_comercio = $envio['Telefono_comercio'];
        $telefono_cliente = $envio['Telefono_cliente'];
        $fecha = $envio['Fecha'];
        $actualizado = $envio['Actualizado'];
        $fecha_actual = CurrentTime();
        $actualizado = TimeDifference($actualizado, $fecha_actual);
        $foto_comercio = SearchProfilePhoto($usuario_comercio);
        $foto_cliente = SearchProfilePhoto($usuario_cliente);
        $nro_pedido = $envio['Nro_pedido'];

        $respuesta .=
          "
          <div class='card-delivery'>
          <div class='card-delivery-header'>
            <strong class='me-auto'>$fecha</strong>
            <small>$actualizado</small>
          </div>
          <div class='card-delivery-body'>
            <div class='delivery-img'>
             <img class='img-delivery' src='$foto_comercio' alt='Foto de Perfil'>
            </div>
            <div class='delivery-data'>
            <div class='card-delivery-title'><a href='detalle_envio?pedido=$nro_pedido' class='order-title'>$razon_social</a>
             <a href='https://wa.me/$telefono_comercio' target='_blank'><i class='fa-brands fa-whatsapp'></i></a></div>
            <div class='delivery-text'>$nombre_cliente $apellido_cliente 
            <a href='https://wa.me/$telefono_cliente' target='_blank'><i class='fa-brands fa-whatsapp'></i></a></div>
            <div  class='delivery-links'>
            <a class='delivery-link' href='detalle_envio?envio=$id_envio&pedido=$nro_pedido'>Detalle</a>
            <a  pedido='$nro_pedido' class='delivery-link ruta-completada'>
             Completado</a>
            </div>
            </div>
          </div>
        </div>
        </div>
          ";
      }

      return $respuesta;
    } else {
      $respuesta = EmptyPage('Sin Envíos En Transito.');
      return $respuesta;
    }
  }
}

function envios_completados()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $ListDelivery = ListDelivery(1, 1, 1);
  $respuesta = '';

  if ($AdminLevel=== '1') {
    if ($ListDelivery) {
      $ListDelivery = array_reverse($ListDelivery);
      foreach ($ListDelivery as $envio) {
        $id_envio = $envio['Id_envio'];
        $id_comercio = $envio['Id_comercio'];
        $id_cliente = $envio['Id_cliente'];
        $usuario_comercio = $envio['Usuario_comercio'];
        $usuario_cliente = $envio['Usuario_cliente'];
        $razon_social = $envio['Razon_social'];
        $nombre_cliente = $envio['Nombre_cliente'];
        $apellido_cliente = $envio['Apellido_cliente'];
        $telefono_comercio = $envio['Telefono_comercio'];
        $telefono_cliente = $envio['Telefono_cliente'];
        $fecha = $envio['Fecha'];
        $actualizado = $envio['Actualizado'];
        $fecha_actual = CurrentTime();
        $actualizado = TimeDifference($actualizado, $fecha_actual);
        $foto_comercio = SearchProfilePhoto($usuario_comercio);
        $foto_cliente = SearchProfilePhoto($usuario_cliente);
        $nro_pedido = $envio['Nro_pedido'];

        $respuesta .=
          "
          <div class='card-delivery'>
          <div class='card-delivery-header'>
            <strong class='me-auto'>$fecha</strong>
            <small>$actualizado</small>
          </div>
          <div class='card-delivery-body'>
            <div class='delivery-img'>
             <img class='img-delivery' src='$foto_comercio' alt='Foto de Perfil'>
            </div>
            <div class='delivery-data'>
            <div class='card-delivery-title'><a href='detalle_envio?pedido=$nro_pedido' class='order-title'>$razon_social</a>
             <a href='https://wa.me/$telefono_comercio' target='_blank'><i class='fa-brands fa-whatsapp'></i></a></div>
            <div class='delivery-text'>$nombre_cliente $apellido_cliente 
            <a href='https://wa.me/$telefono_cliente' target='_blank'><i class='fa-brands fa-whatsapp'></i></a></div>
            <div  class='delivery-links'>
            <a class='delivery-link' href='detalle_envio?envio=$id_envio&pedido=$nro_pedido'>Detalle</a>
            </div>
            </div>
          </div>
        </div>
        </div>
          ";
      }

      return $respuesta;
    } else {
      $respuesta = EmptyPage('Sin Envíos Completados.');
      return $respuesta;
    }
  }

  if ($AdminLevel === '2') {
    $DriverData = DriverData($UserID);
    $id_conductor = $DriverData[0]['Id_conductor'];
    $ListDeliveryByDriver = ListDeliveryByDriver(1, 1, 1, $id_conductor);

    if ($ListDeliveryByDriver) {
      foreach ($ListDeliveryByDriver as $envio) {
        $id_envio = $envio['Id_envio'];
        $id_comercio = $envio['Id_comercio'];
        $id_cliente = $envio['Id_cliente'];
        $usuario_comercio = $envio['Usuario_comercio'];
        $usuario_cliente = $envio['Usuario_cliente'];
        $razon_social = $envio['Razon_social'];
        $nombre_cliente = $envio['Nombre_cliente'];
        $apellido_cliente = $envio['Apellido_cliente'];
        $telefono_comercio = $envio['Telefono_comercio'];
        $telefono_cliente = $envio['Telefono_cliente'];
        $fecha = $envio['Fecha'];
        $actualizado = $envio['Actualizado'];
        $fecha_actual = CurrentTime();
        $actualizado = TimeDifference($actualizado, $fecha_actual);
        $foto_comercio = SearchProfilePhoto($usuario_comercio);
        $foto_cliente = SearchProfilePhoto($usuario_cliente);
        $nro_pedido = $envio['Nro_pedido'];

        $respuesta .=
          "
          <div class='card-delivery'>
          <div class='card-delivery-header'>
            <strong class='me-auto'>$fecha</strong>
            <small>$actualizado</small>
          </div>
          <div class='card-delivery-body'>
            <div class='delivery-img'>
             <img class='img-delivery' src='$foto_comercio' alt='Foto de Perfil'>
            </div>
            <div class='delivery-data'>
            <div class='card-delivery-title'><a href='detalle_envio?pedido=$nro_pedido' class='order-title'>$razon_social</a>
             <a href='https://wa.me/$telefono_comercio' target='_blank'><i class='fa-brands fa-whatsapp'></i></a></div>
            <div class='delivery-text'>$nombre_cliente $apellido_cliente 
            <a href='https://wa.me/$telefono_cliente' target='_blank'><i class='fa-brands fa-whatsapp'></i></a></div>
            <div  class='delivery-links'>
            <a class='delivery-link' href='detalle_envio?envio=$id_envio&pedido=$nro_pedido'>Detalle</a>
            </div>
            </div>
          </div>
        </div>
        </div>
          ";
      }

      return $respuesta;
    } else {
      $respuesta = EmptyPage('Sin Envíos Completados.');
      return $respuesta;
    }
  }
}



function detalle_envio()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
  $mi_pedido =
    [
      'titulo' => $back_btn . 'DETALLE ENVÍO',
      'contenido' => ''
    ];

  if (isset($_POST['nro_pedido']) && isset($_POST['id_envio'])) {
    $nro_pedido = $_POST['nro_pedido'];
    $id_envio = $_POST['id_envio'];
    $nro_pedido = filter_var($nro_pedido, FILTER_SANITIZE_NUMBER_INT);
    $OrderDetail = OrderDetail($nro_pedido);
    $DeliveryDetail = DeliveryDetail($id_envio);
    $DeliverDriver = DeliveryDriver($id_envio);


    if ($OrderDetail) {
      $Usuario_comercio = $OrderDetail[0]['Usuario_comercio'];
      $Usuario_cliente = $OrderDetail[0]['Usuario_cliente'];
      $foto_comercio = SearchProfilePhoto($Usuario_comercio);
      $foto_cliente = SearchProfilePhoto($Usuario_cliente);

      if($DeliveryDetail)
      {
        foreach($DeliveryDetail as $delivery)
        {
          $razon_social = $delivery['Razon_social'];
          $nombre_cliente = $delivery['Nombre_cliente'];
          $apellido_cliente = $delivery['Apellido_cliente'];
          $salida = $delivery['Salida'];
          $destino = $delivery['Destino'];
          $url_ruta = $delivery['Url_ruta'];
        }
  
        $mi_pedido['contenido'] .=
        "
        <div class='delivery-detail'>

         <div class='delivery-header'>
            <div class='container-img-header'>
              <img class='detalle-img-header' src='$foto_comercio' alt='Foto de Perfil'>
            </div>
            <div class='delivery-name'>$razon_social </div>
        </div>

        <div class='delivery-directions'>
        <div class='delivery-direction-title'>Salida:</div>
        <div class='delivery-direction-body'>$salida</div>
      </div>

         <div class='delivery-header'>
            <div class='container-img-header'>
              <img class='detalle-img-header' src='$foto_cliente' alt='Foto de Perfil'>
            </div>
            <div class='delivery-name'>$nombre_cliente $apellido_cliente </div>
        </div>

        <div class='delivery-directions'>
         <div class='delivery-direction-title'>Destino:</div>
         <div class='delivery-direction-body'>$destino</div>
        </div>

        <div class='delivery-directions'>
         <div class='delivery-direction-title'>Ruta En Mapa:</div>
         <div class='delivery-direction-body'><a class='delivery-link' href='$url_ruta'>Ver Ruta</a></div>
        </div>
     </div>
        ";
      }

      if($DeliverDriver)
      {
         foreach($DeliverDriver as $driver)
         {
            $usuario_conductor = $driver['Usuario_conductor'];
            $nombre_conductor = $driver['Nombre_conductor'];
            $apellido_conductor = $driver['Apellido_conductor'];
            $telefono = $driver['Telefono_conductor'];
            $moto_marca = $driver['Marca'];
            $moto_modelo = $driver['Modelo'];
            $moto_placa = $driver['Placa'];
            $foto_conductor = SearchProfilePhoto($usuario_conductor);

         }

         $mi_pedido['contenido'] .=
         "
         <div class='delivery-detail'>
   
          <div class='delivery-header'>
             <div class='container-img-header'>
               <img class='detalle-img-header' src='$foto_conductor' alt='Foto de Perfil'>
             </div>
             <div class='delivery-name'>$nombre_conductor $apellido_conductor </div>
         </div>
   
         <div class='delivery-directions'>
         <div class='delivery-direction-title'>Marca:</div>
         <div class='delivery-direction-body'>$moto_marca</div>
       </div>
   
         <div class='delivery-directions'>
          <div class='delivery-direction-title'>Modelo:</div>
          <div class='delivery-direction-body'>$moto_modelo</div>
         </div>
   
         <div class='delivery-directions'>
          <div class='delivery-direction-title'>Placa:</div>
          <div class='delivery-direction-body'>$moto_placa</div>
         </div>
      </div>
         ";
      }


    

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
        $OrderPayment = OrderPayment($nro_pedido);
        $metodo_pago = $OrderPayment[0]['Categoria'];
        $OrderPaymentStatus = OrderPaymentStatus($nro_pedido);
        $ProcessOrderStatus = ProcessOrderStatus($nro_pedido);
        $estado = $ProcessOrderStatus['estado'];

        if($estado === 'Aceptado' || $estado === 'Enviado' || $estado === 'Entregado' || $estado === 'Anulado')
        {
           $hidden = 'hidden';
        }
        else
        {
           $hidden = '';
        }

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

      $action_button = '';

      if($AdminLevel === '1')
      {
         $action_button = 
         "<button $hidden  id='$nro_pedido' data-toggle='modal' data-target='#asignar_conductor' class='asignar-conductor asignar-conductor-button'>
         <i class='fas fa-motorcycle'></i> Asignar</button>
         ";
      }
      if($AdminLevel === '2')
      {
        if($estado === 'Asignado')
        {
          $action_button = 
          "<button $hidden pedido='$nro_pedido'  class='aceptar-delivery-button aceptar-envio'>
          Aceptar</button>
          ";
        }
        else if($estado === 'Aceptado')
        {
          $action_button = 
          "<button  pedido='$nro_pedido' class='aceptar-delivery-button ruta-completada'>
          Completado</button>
          ";
        }
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
              <div class='amount-item'>
                <p class='amount'>Pago:</p> <p class='amount'>$metodo_pago</p>
              </div>
              <div class='amount-item'>
                <p class='amount'>Pagado:</p> <p class='amount'>$OrderPaymentStatus</p>
              </div>
               $action_button
              </div>";
    } else {
      $mi_pedido['contenido'] = EmptyPage('Sin Detalles Para Mostrar');
    }

    echo json_encode($mi_pedido);
  }
}
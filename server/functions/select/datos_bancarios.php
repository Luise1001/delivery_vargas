<?php

function mis_datos_bancarios()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $comercioData = ComercioData($UserID);
  $id_comercio = $comercioData[0]['Id'];
  $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
  $plus_btn = "<a  href='agregar_db' class='back-button' ><i class='fa-solid fa-plus-circle'></i></a>";
  $respuesta =
    [
      'titulo' => $back_btn . 'DATOS BANCARIOS',
      'botones'=> $plus_btn,
      'pm' => '',
      'tr' => '',
      'zl' => ''
    ];
  $pago_movil = PagoMovil($id_comercio);
  $transferencia = Transferencia($id_comercio);
  $zelle = Zelle($id_comercio);

  if ($pago_movil) {
    foreach ($pago_movil as $pm) {
      $id = $pm['Id'];
      $banco = $pm['Banco'];
      $telefono = $pm['Telefono'];
      $fecha = $pm['Fecha'];
      $tipo_id = $pm['Tipo_id'];
      $documento = $pm['Documento'];
      $actualizado = $pm['Actualizado'];
      $fecha_actual = CurrentTime();
      $actualizado = TimeDifference($actualizado, $fecha_actual);

      $respuesta['pm'] .=
        "
         <div class='card-direction' >
         <div class='card-direction-header'>
           <div class='card-direction-title'>
           <i class='fa-solid fa-money-bill-wave'></i>
           $banco
           </div>
           <div class='card-time'>$actualizado</div>
         </div>
         <div class='card-direction-body'>
           <p>$tipo_id-$documento</p>
           <p>$telefono</p>
         </div>
         <div class='card-direction-links'>
         <a href='editar_db?tipo=pm&id=$id' class='card-direction-link'>Editar</a>
         <a tabla='pago_movil' dato='$id' class='card-direction-link eliminar-db'>Eliminar</a>
         </div>
       </div>
         ";
    }
  } else {
    $respuesta['pm'] = EmptyPage('Sin Datos de Pago Movil');
  }

  if ($transferencia) {
    foreach ($transferencia as $tr) {
      $id = $tr['Id'];
      $banco = $tr['Banco'];
      $cuenta = $tr['Cuenta'];
      $fecha = $tr['Fecha'];
      $tipo_id = $tr['Tipo_id'];
      $documento = $tr['Documento'];
      $actualizado = $tr['Actualizado'];
      $fecha_actual = CurrentTime();
      $actualizado = TimeDifference($actualizado, $fecha_actual);

      $respuesta['tr'] .=
        "
         <div class='card-direction' >
         <div class='card-direction-header'>
           <div class='card-direction-title'>
           <i class='fa-solid fa-money-bill-wave'></i>
           $banco
           </div>
           <div class='card-time'>$actualizado</div>
         </div>
         <div class='card-direction-body'>
         <p>$tipo_id-$documento</p>
         <p>$cuenta</p>
         </div>
         <div class='card-direction-links'>
         <a href='editar_db?tipo=tr&id=$id' class='card-direction-link'>Editar</a>
         <a tabla='transferencia' dato='$id' class='card-direction-link eliminar-db'>Eliminar</a>
         </div>
       </div>
         ";
    }
  } else {
    $respuesta['tr'] = EmptyPage('Sin Datos de Transferencia');
  }

  if ($zelle) {
    foreach ($zelle as $zl) {
      $id = $zl['Id'];
      $titular = $zl['Titular'];
      $correo = $zl['Correo'];

      $respuesta['zl'] .=
        "
        <div class='card-direction' >
        <div class='card-direction-header'>
          <div class='card-direction-title'>
          <i class='fa-solid fa-money-bill-wave'></i>
          $titular
          </div>
          <div class='card-time'>$actualizado</div>
        </div>
        <div class='card-direction-body'>
        <p>$correo</p>
        </div>
        <div class='card-direction-links'>
        <a href='editar_db?tipo=zl&id=$id' class='card-direction-link'>Editar</a>
        <a tabla='zelle' dato='$id' class='card-direction-link eliminar-db'>Eliminar</a>
        </div>
      </div>
        ";
    }
  } else {
    $respuesta['zl'] = EmptyPage('Sin Datos de Zelle');
  }



  echo json_encode($respuesta);
}

function datos_bancarios()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel(($UserID));
  $respuesta =
    [
      'titulo'=> '',
      'datos' => ''
    ];

  if ($AdminLevel != '3') {
    if (isset($_POST['id_comercio']) && isset($_POST['metodo'])) {
      $id_comercio = $_POST['id_comercio'];
      $metodo = $_POST['metodo'];
      $IdentifyMethod = IdentifyMethod($metodo, $id_comercio);

      if ($IdentifyMethod) {
        $respuesta['datos'] = $IdentifyMethod;
      }
    }
  } else {
    if (isset($_POST['tabla']) && isset($_POST['id'])) {
      $table = $_POST['tabla'];
      $id_datos = $_POST['id'];
      $bancos = '';
      $tipo_id_options = '';
      $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
      $respuesta['titulo'] = $back_btn.'EDITAR DATOS BANCARIOS';

      $MethodForEdit = MethodForEdit($table, $id_datos);
      $BanckList = BankList();
      $tipo_id_array = array('V', 'E', 'P', 'J', 'G');
      

      if ($MethodForEdit) { 
        if($table === 'pago_movil')
        {
          foreach ($MethodForEdit as $metodo) {
            $id_banco = $metodo['Id_banco'];
            $banco = $metodo['Banco'];
            $tipo_id = $metodo['Tipo_id'];
            $documento = $metodo['Documento'];
            $telefono = $metodo['Telefono'];
          }
  
          foreach ($BanckList as $bank) {
            $id = $bank['Id'];
            $bank_name = $bank['Banco'];
  
            if ($id != $id_banco) {
              $bancos .=
                "
               <option value='$id'>$bank_name</option>
               ";
            }
          }
  
          foreach($tipo_id_array as $option)
          {
             if($tipo_id != $option)
             {
               $tipo_id_options .=
               "
               <option value='$option'>$option</option>
               ";
             }
          }
  
          $respuesta['datos'] .=
            "
           <label class='form-label' for='bancos'>Bancos<span class='text-danger'>*</span></label>
           <div class='input-group'>
               <select class='form-select perfil-select' id='bancos' name='bancos'>
               <option value='$id_banco'>$banco</option>
               $bancos
               </select>
           </div>
  
           <label class='form-label' for='documento'>Documento de Identidad<span class='text-danger'>*</span></label>
           <div class='input-group'>
               <select class='form-select perfil-select' id='tipo_id' name='tipo_id'>
                   <option value='$tipo_id'>$tipo_id</option>
                   $tipo_id_options
               </select>
               <input class='form-control perfil-input' type='number' id='documento' name='documento' value='$documento'>
           </div>
  
           <label class='form-label' for='telefono'>Telefono<span class='text-danger'>*</span></label>
           <input class='form-control perfil-input' type='number' id='telefono' name='telefono' value='$telefono'>
           
           <div class='container'>
           <button id='guardar_pm' class='perfil-button'>Guardar</button>
          </div>
           ";
        }

        if($table === 'transferencia')
        {
          foreach ($MethodForEdit as $metodo) {
            $id_banco = $metodo['Id_banco'];
            $banco = $metodo['Banco'];
            $tipo_id = $metodo['Tipo_id'];
            $documento = $metodo['Documento'];
            $cuenta = $metodo['Cuenta'];
          }
  
          foreach ($BanckList as $bank) {
            $id = $bank['Id'];
            $bank_name = $bank['Banco'];
  
            if ($id != $id_banco) {
              $bancos .=
                "
               <option value='$id'>$bank_name</option>
               ";
            }
          }
  
          foreach($tipo_id_array as $option)
          {
             if($tipo_id != $option)
             {
               $tipo_id_options .=
               "
               <option value='$option'>$option</option>
               ";
             }
          }
  
          $respuesta['datos'] .=
            "
           <label class='form-label' for='bancos'>Bancos<span class='text-danger'>*</span></label>
           <div class='input-group'>
               <select class='form-select perfil-select' id='bancos' name='bancos'>
               <option value='$id_banco'>$banco</option>
               $bancos
               </select>
           </div>
  
           <label class='form-label' for='documento'>Documento de Identidad<span class='text-danger'>*</span></label>
           <div class='input-group'>
               <select class='form-select perfil-select' id='tipo_id' name='tipo_id'>
                   <option value='$tipo_id'>$tipo_id</option>
                   $tipo_id_options
               </select>
               <input class='form-control perfil-input' type='number' id='documento' name='documento' value='$documento'>
           </div>
  
           <label class='form-label' for='cuenta'>Número de Cuenta<span class='text-danger'>*</span></label>
           <input class='form-control perfil-input' type='number' id='cuenta' name='cuenta' value='$cuenta'>
           
           <div class='container'>
           <button id='guardar_tr' class='perfil-button'>Guardar</button>
          </div>
           ";
        }

        if($table === 'zelle')
        {
          foreach ($MethodForEdit as $metodo) {
            $id = $metodo['Id'];
            $titular = $metodo['Titular'];
            $correo = $metodo['Correo'];
          }
 
          $respuesta['datos'] .=
            "
           <label class='form-label' for='titular'>Titular<span class='text-danger'>*</span></label>
           <input class='form-control perfil-input' type='text' id='titular' name='titular' value='$titular'>
           <label class='form-label' for='correo'>Correo<span class='text-danger'>*</span></label>
           <input class='form-control perfil-input' type='email' id='correo' name='correo' value='$correo'>
           
           <div class='container'>
           <button id='guardar_zl' class='perfil-button'>Guardar</button>
          </div>
           ";
        }
      }
    }
  }

  echo json_encode($respuesta);
}

function lista_de_bancos()
{
  include_once '../conexion.php';

  $bancos = BankList();
  $options = '';

  foreach ($bancos as $banco) {
    $id_banco = $banco['Id'];
    $banco = $banco['Banco'];
    $options .=
      "
        <option value='$id_banco'>$banco</option>       
        ";
  }

  echo $options;
}



function metodos_de_pago()
{
  include_once '../conexion.php';
  if (isset($_POST['nro_pedido'])) {
    $nro_pedido = $_POST['nro_pedido'];
    $OrderDetail = OrderDetail($nro_pedido);
    $id_comercio = $OrderDetail[0]['Id_comercio'];
    $metodos_de_pago = OptionsPaymentMethods($id_comercio);

    $respuesta =
      "
        <option value='0'>Seleccionar</option>
      ";

    if ($metodos_de_pago) {
      foreach ($metodos_de_pago  as $metodo) {
        $id_metodo = $metodo['Id'];
        $metodo_name = $metodo['Categoria'];

        if ($metodo_name == 'Efectivo en Bolivares') {
          $respuesta .=
            "
              <option value='$id_metodo'>$metodo_name</option>
            ";
        }

        if ($metodo_name == 'Efectivo en Dolares') {
          $respuesta .=
            "
              <option value='$id_metodo'>$metodo_name</option>
            ";
        }

        if ($metodo_name == 'Pago Movil') {
          $pago_movil = PagoMovil($id_comercio);
          if ($pago_movil) {
            $respuesta .=
              "
                <option value='$id_metodo'>$metodo_name</option>
              ";
          }
        }

        if ($metodo_name == 'Transferencia Bancaria') {
          $transferencia = Transferencia($id_comercio);
          if ($transferencia) {
            $respuesta .=
              "
                <option value='$id_metodo'>$metodo_name</option>
              ";
          }
        }

        if ($metodo_name == 'Zelle') {
          $zelle = Zelle($id_comercio);
          if ($zelle) {
            $respuesta .=
              "
                <option value='$id_metodo'>$metodo_name</option>
              ";
          }
        }
      }
    } else {
      echo 'Sin Datos Bancarios Agregados.';
    }



    echo $respuesta;
  }
}

function datos_pago_pedido()
{
  include_once '../conexion.php';

  if (isset($_POST['nro_pedido'])) {
    $nro_pedido = $_POST['nro_pedido'];
    $opcion = $_POST['opcion'];
    $OrderDetail = OrderDetail($nro_pedido);
    $id_comercio = $OrderDetail[0]['Id_comercio'];
    $tasa = TasaDD();

    $referencia =
      "
    <div class='div-referencia-pago'>
    <label for='referencia_pago' class='form-label'>Referencia<span class='text-danger'>*</span></label>
     <input type='number' id='referencia_pago' name='referencia_pago'  class='input-opcion-4' placeholder='Últimos 6 Dígitos.'>
    </div>
    ";

    foreach ($OrderDetail as $detalle) {
      $monto = number_format($detalle['Total'], 2);
      $monto_bs = number_format($monto * $tasa, 2,);
    }

    if ($opcion === '1') {
      echo
      "
       <div class='div-monto-pagar'>
       <p class='card-text'>Divisa: $.$monto</p>
       <p class='card-text'>Bolivares: Bs.$monto_bs</p>
       </div>
       ";
    }

    if ($opcion === '2') {
      echo
      "
      <div class='div-monto-pagar'>
      <p class='card-text'>Divisa: $.$monto</p>
      </div>
      
      ";
    }

    if ($opcion === '3') {
      echo
      "
      <div class='div-monto-pagar'>
      <p class='card-text'>Divisa: $.$monto</p>
      <p class='card-text'>Bolivares: Bs.$monto_bs</p>
      </div>
      
      ";

      $pago_movil = PagoMovil($id_comercio);

      foreach ($pago_movil as $detalle) {
        $banco = $detalle['Banco'];
        $documento = $detalle['Tipo_id'] . '-' . $detalle['Documento'];
        $telefono = $detalle['Telefono'];

        echo
        "
        <div class='div-datos-pagar'>
        <p class='card-text'>Banco: $banco</p>
        <p class='card-text'>Documento: $documento</p>
        <p class='card-text'> Teléfono: $telefono</p>
        </div>
        
        ";
      }

      echo $referencia;
    }

    if ($opcion === '4') {
      echo
      "
      <div class='div-monto-pagar'>
      <p class='card-text'>Divisa: $.$monto</p>
      <p class='card-text'>Bolivares: Bs.$monto_bs</p>
      </div>
      
      ";

      $transferencia = Transferencia($id_comercio);

      foreach ($transferencia as $detalle) {
        $banco = $detalle['Banco'];
        $documento = $detalle['Tipo_id'] . '-' . $detalle['Documento'];
        $cuenta = $detalle['Cuenta'];

        echo
        "
        <div class='div-datos-pagar'>
        <p class='card-text'>Banco: $banco</p>
        <p class='card-text'>Documento: $documento</p>
        <p class='card-text'> Cuenta: $cuenta</p>
        </div>
        
        ";
      }
      echo $referencia;
    }

    if ($opcion === '5') {
      $referencia =
        "
      <div class='div-referencia-pago'>
      <label for='referencia_pago' class='form-label'>Referencia<span class='text-danger'>*</span</label>
       <input type='text' id='referencia_pago' name='referencia_pago'  class='input-opcion-4' placeholder='Últimos 6 Dígitos.'>
      </div>
      ";

      echo
      "
      <div class='div-monto-pagar'>
      <p class='card-text'>Divisa: $.$monto</p>
      </div>
      
      ";

      $zelle = Zelle($id_comercio);

      foreach ($zelle as $detalle) {
        $correo = $detalle['Correo'];
        $titular = $detalle['Titular'];

        echo
        "
        <div class='div-datos-pagar'>
        <p class='card-text'>Correo: $correo</p>
        <p class='card-text'>Titular: $titular</p>
        </div>
        
        ";
      }
      echo $referencia;
    }
  }
}

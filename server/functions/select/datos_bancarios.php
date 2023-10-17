<?php

function datos_bancarios()
{
   include_once '../conexion.php';
   $admin = $_SESSION['DLV']['admin'];
   $UserID = UserID($admin);
   $AdminLevel = AdminLevel(($UserID));
   $respuesta =
   [
     'datos'=> ''
   ];

   if(isset($_POST['id_comercio']) && isset($_POST['metodo']))
   {
     $id_comercio = $_POST['id_comercio'];
     $metodo = $_POST['metodo'];
     $IdentifyMethod = IdentifyMethod($metodo, $id_comercio);

     if($IdentifyMethod)
     {
       $respuesta['datos'] = $IdentifyMethod;
     }

      echo json_encode($respuesta);
   }
}

 function lista_de_bancos()
{
    include_once '../conexion.php';

    $bancos = BankList();
    $options = '';

    foreach($bancos as $banco)
    {
        $id_banco = $banco['Id'];
        $banco = $banco['Banco'];
        $options .= 
        "
        <option value='$id_banco'>$banco</option>       
        ";
    }

    echo $options;
   
}

function mis_datos_bancarios()
{
    include_once '../conexion.php';
    $admin = $_SESSION['DLV']['admin'];
    $id_usuario = UserID($admin);
    $rif_comercio = ComercioRif($id_usuario);
    $id_comercio = ComercioID($rif_comercio);
    $comercioData = ComercioData($id_comercio);
    $razon_social = $comercioData[0]['Razon_social'];

    $pago_movil = PagoMovil($id_comercio);
    $transferencia = Transferencia($id_comercio);
    $zelle = Zelle($id_comercio);

    $boton = 
    '
    <a class="nav-link" data-toggle="modal" data-target="#nuevo_datos_banco" title="Datos Bancarios">
    <i class="fas fa-plus-circle"></i>
    </a>
    ';

    $mis_datos = 
    [
      'botones'=> $boton,
      'datos'=> ''
    ];


    if($pago_movil) 
    { 
        foreach($pago_movil as $pm)
        {
            $id = $pm['Id'];
            $tipo_id = $pm['Tipo_id'];
            $documento = $pm['Documento'];
            $banco = $pm['Banco'];
            $id_banco = $pm['Id_banco'];
            $telefono = $pm['Telefono'];

            $mis_datos['datos'] .=
            "
            <div class=' card-datos-bancarios'>
            <div class='card-header'>
            </div>
            <div class='card-body bg-transparent'>
              <ul class='list-group list-group-flush'>
              <li class='list-group-item'><h6><i class='fas fa-mobile-alt'></i> Pago Móvil</h6></li>
              <li class='list-group-item'>$razon_social</li>
              <li class='list-group-item'>$tipo_id-$documento</li>
              <li class='list-group-item'>$banco</li>
              <li class='list-group-item'>$telefono</li>
            </ul>
         
            </div>
            <div class='card-footer text-body-secondary'>

            <a class='btn edit-pm-btn' id='edit_pm_$id'
            pm='$id' tipo='$tipo_id' documento='$documento' banco='$id_banco' bcname='$banco'  telefono='$telefono'
            title='Editar' data-toggle='modal' data-target='#editar_datos_banco'>
            <i class='fas fa-edit'></i>
            </a>

            <a tabla='pm' comercio='$id_comercio' class='btn eliminar-datos-bancarios' id='$id'>
            <i class='fas fa-trash-alt text-danger'></i>
            </a>
            </div>
          </div>
            
            ";
        }

    }
    else
    {
        $mis_datos['datos'] .=
        "
        <div class=' card-datos-bancarios'>
        <div class='card-header'>
        </div>
        <div class='card-body bg-transparent'>
          <ul class='list-group list-group-flush'>
          <li class='list-group-item'><h6><i class='fas fa-mobile-alt'></i> Sin Datos Registrados</h6></li>
          <li class='list-group-item'></li>
          <li class='list-group-item'></li>
        </ul>
     
        </div>
        <div class='card-footer text-body-secondary'>
        </div>
      </div>
        
        ";
    }

    if($transferencia)
    {
        foreach($transferencia as $tr)
        {
            $id = $tr['Id'];
            $tipo_id = $tr['Tipo_id'];
            $documento = $tr['Documento'];
            $banco = $tr['Banco'];
            $id_banco = $tr['Id_banco'];
            $cuenta = $tr['Cuenta'];

            $mis_datos['datos'] .=
            "
            <div class=' card-datos-bancarios'>
            <div class='card-header'>
            </div>
            <div class='card-body bg-transparent'>
              <ul class='list-group list-group-flush'>
              <li class='list-group-item'><h6><i class='fas fa-exchange-alt'></i> Transferencia</h6></li>
              <li class='list-group-item'>$razon_social</li>
              <li class='list-group-item'>$tipo_id-$documento</li>
              <li class='list-group-item'>$banco</li>
              <li class='list-group-item'>$cuenta</li>
            </ul>
         
            </div>
            <div class='card-footer text-body-secondary'>

            <a class='btn edit-tr-btn' id='edit_tr_$id'
            tr='$id' tipo='$tipo_id' documento='$documento' banco='$id_banco' bcname='$banco' cuenta='$cuenta'
            title='Editar' data-toggle='modal' data-target='#editar_datos_banco'>
            <i class='fas fa-edit'></i>
            </a>

            <a tabla='tr' comercio='$id_comercio' class='btn eliminar-datos-bancarios' id='$id'>
            <i class='fas fa-trash-alt text-danger'></i>
            </a>
            </div>
          </div>
            
            ";
        }
    }
    else
    {
      $mis_datos['datos'] .=
        "
        <div class=' card-datos-bancarios'>
        <div class='card-header'>
        </div>
        <div class='card-body bg-transparent'>
          <ul class='list-group list-group-flush'>
          <li class='list-group-item'><h6><i class='fas fa-exchange-alt'></i> Sin Datos Registrados</h6></li>
          <li class='list-group-item'></li>
          <li class='list-group-item'></li>
        </ul>
     
        </div>
        <div class='card-footer text-body-secondary'>
        </div>
      </div>
        
        ";
    }
    if($zelle)
    {
        
      foreach($zelle as $dato)
      {
        $id = $dato['Id'];
        $correo = $dato['Correo'];
        $titular = $dato['Titular'];
        
        $mis_datos['datos'] .=
        "
        <div class=' card-datos-bancarios'>
        <div class='card-header'>
        </div>
        <div class='card-body bg-transparent'>
          <ul class='list-group list-group-flush'>
          <li class='list-group-item'><h6><i class='fas fa-comment-dollar'></i> Zelle</h6></li>
          <li class='list-group-item'>$razon_social</li>
          <li class='list-group-item'>$correo</li>
          <li class='list-group-item'>$titular</li>
        </ul>
     
        </div>
        <div class='card-footer text-body-secondary'>

        <a class='btn edit-zl-btn' id='edit_zelle_$id'
        zelle='$id' correo='$correo' titular='$titular'
        title='Editar' data-toggle='modal' data-target='#editar_datos_banco'>
        <i class='fas fa-edit'></i>
        </a>

        <a tabla='zelle' comercio='$id_comercio' class='btn eliminar-datos-bancarios' id='$id'>
        <i class='fas fa-trash-alt text-danger'></i>
        </a>
        </div>
      </div>
        
        ";
      }
    }
    else
    {
      $mis_datos['datos'] .=
        "
        <div class=' card-datos-bancarios'>
        <div class='card-header'>
        </div>
        <div class='card-body bg-transparent'>
          <ul class='list-group list-group-flush'>
          <li class='list-group-item'><h6><i class='fas fa-comment-dollar'></i> Sin Datos Registrados</h6></li>
          <li class='list-group-item'></li>
          <li class='list-group-item'></li>
        </ul>
     
        </div>
        <div class='card-footer text-body-secondary'>
        </div>
      </div>
        
        ";
    }

    echo json_encode($mis_datos);

}

function metodos_de_pago()
{
    include_once '../conexion.php';
    if(isset($_POST['nro_pedido']))
    {
      $nro_pedido = $_POST['nro_pedido'];
      $OrderDetail = OrderDetail($nro_pedido);
      $id_comercio = $OrderDetail[0]['Id_comercio'];
      $metodos_de_pago = OptionsPaymentMethods($id_comercio);
      
      $respuesta =
      "
        <option value='0'>Seleccionar</option>
      ";

      if($metodos_de_pago)
      {
        foreach($metodos_de_pago  as $metodo)
        {
           $id_metodo = $metodo['Id'];
           $metodo_name = $metodo['Categoria'];
           
           if($metodo_name == 'Efectivo en Bolivares')
           {
            $respuesta .=
            "
              <option value='$id_metodo'>$metodo_name</option>
            ";
           }
  
           if($metodo_name == 'Efectivo en Dolares')
           {
            $respuesta .=
            "
              <option value='$id_metodo'>$metodo_name</option>
            ";
           }
  
           if($metodo_name == 'Pago Movil')
           { 
              $pago_movil = PagoMovil($id_comercio);
             if($pago_movil)
             {
              $respuesta .=
              "
                <option value='$id_metodo'>$metodo_name</option>
              ";
             }
           }
  
           if($metodo_name == 'Transferencia Bancaria')
           { 
              $transferencia = Transferencia($id_comercio);
             if($transferencia)
             {
              $respuesta .=
              "
                <option value='$id_metodo'>$metodo_name</option>
              ";
             }
           }
  
           if($metodo_name == 'Zelle')
           { 
              $zelle = Zelle($id_comercio);
             if($zelle)
             {
              $respuesta .=
              "
                <option value='$id_metodo'>$metodo_name</option>
              ";
             }
           }
  
  
        }
      }
      else
      {
         echo 'Sin Datos Bancarios Agregados.';
      }



      echo $respuesta;
    }


}

function datos_pago_pedido()
{
  include_once '../conexion.php';

  if(isset($_POST['nro_pedido']))
  {
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

    foreach($OrderDetail as $detalle)
    {
      $monto = number_format($detalle['Total'], 2);
      $monto_bs = number_format($monto * $tasa, 2,);
    }

    if($opcion === '1')
    {
       echo 
       "
       <div class='div-monto-pagar'>
       <p class='card-text'>Divisa: $.$monto</p>
       <p class='card-text'>Bolivares: Bs.$monto_bs</p>
       </div>
       ";
    }

    if($opcion === '2')
    {
      echo 
      "
      <div class='div-monto-pagar'>
      <p class='card-text'>Divisa: $.$monto</p>
      </div>
      
      ";
    }

    if($opcion === '3')
    {
      echo 
      "
      <div class='div-monto-pagar'>
      <p class='card-text'>Divisa: $.$monto</p>
      <p class='card-text'>Bolivares: Bs.$monto_bs</p>
      </div>
      
      ";

      $pago_movil = PagoMovil($id_comercio);

      foreach($pago_movil as $detalle)
      {
        $banco = $detalle['Banco'];
        $documento = $detalle['Tipo_id'].'-'. $detalle['Documento'];
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

    if($opcion === '4')
    {
      echo 
      "
      <div class='div-monto-pagar'>
      <p class='card-text'>Divisa: $.$monto</p>
      <p class='card-text'>Bolivares: Bs.$monto_bs</p>
      </div>
      
      ";

      $transferencia = Transferencia($id_comercio);

      foreach($transferencia as $detalle)
      {
        $banco = $detalle['Banco'];
        $documento = $detalle['Tipo_id'].'-'. $detalle['Documento'];
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

    if($opcion === '5')
    {
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

      foreach($zelle as $detalle)
      {
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


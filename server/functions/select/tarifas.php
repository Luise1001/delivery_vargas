<?php

function lista_de_tarifas()
{
    include_once '../conexion.php';
    $lista_de_tarifas = ListaTarifas();
    $boton = 
    '
      <a class="nav-link" data-toggle="modal" data-target="#nueva_tarifa" title="Nueva Tarifa">
       <i class="fas fa-plus-circle"></i>
      </a>
    ';
    $resp = 
    [
      'botones'=> $boton,
      'tarifas'=> ''
    ];


    if($lista_de_tarifas)
    {
        foreach($lista_de_tarifas as $tarifa)
        {
          $id = $tarifa['Id'];
          $km = $tarifa['KM'];
          $precio = $tarifa['Precio'];
    
          $resp['tarifas'] .=
          "
          <div class='card mb-2'>
            <div class='card-header'>
            Tarifa
            </div>
            <ul class='list-group list-group-flush'>
               <li class='list-group-item'><h6>Cantidad:</h6> $km KM.</li>
               <li class='list-group-item'><h6>Precio:</h6> $$precio</li>
               <li class='list-group-item text-center'>
               <a class='btn' id='editar_tarifa_btn'
               tarifa='$id' km='$km' precio='$precio'  title='Editar' data-toggle='modal' data-target='#editar_tarifa'>
              <i class='fas fa-edit'></i>
              </a>
            
              <a id='eliminar_tarifa_btn' class='btn p-0' title='Eliminar' tarifa='$id'>
              <i class='fas fa-trash'></i>
              </a>
              </li>
            </ul>
           </div>
          ";
        }

        echo json_encode($resp);
    }
    else
    {
        $resp['tarifas'] = EmptyPage('Sin Datos Para Mostrar.');
        echo json_encode($resp);
    }
        
}

function calcular_tarifa($distancia)
{
   include_once '../conexion.php';
   $precio = PrecioTarifa();
   $tarifa = $distancia * $precio;

   echo $tarifa;

}
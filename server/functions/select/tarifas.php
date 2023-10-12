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
          $km = $tarifa['Desde'];
          $hasta = $tarifa['Hasta'];
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

    }
    else
    {
        $resp['tarifas'] = EmptyPage('Sin Datos Para Mostrar.');
      
    }

    echo json_encode($resp);     
}

function calcular_tarifa()
{
   include_once '../conexion.php';

   if(isset($_POST['distancia']) && isset($_POST['servicio']))
   {
     $distancia = $_POST['distancia'];
     $servicio = $_POST['servicio'];

     if($distancia <= 3)
     {
        $precio = PrecioTarifa($distancia, $servicio);
     }
     else
     {
       $categoria = 'Kilometro Adicional';
       $precio = PrecioTarifaEspecial($categoria, $servicio);
       
       //total de la distancia restale los kilometros permitidos y multiplica el resto por el precio
     }

   }
  
   echo $precio;

}
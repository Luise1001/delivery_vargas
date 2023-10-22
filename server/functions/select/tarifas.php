<?php

function lista_de_tarifas()
{
    include_once '../conexion.php';
    $ListaTarifas = ListaTarifas();
    $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
    $respuesta = 
    [
      'titulo'=> $back_btn.'TARIFAS',
      'tarifas'=> '',
    ];

    if($ListaTarifas)
    {
        foreach($ListaTarifas as  $tarifa)
        {
          $id = $tarifa['Id'];
          $desde = $tarifa['Desde'];
          $hasta = $tarifa['Hasta'];
          $precio = $tarifa['Precio'];
    
          $respuesta['tarifas'] .=
          "
          <div class='card-tarifa'>
            <div class='card-tarifa-container'>
               <div class='tarifa-title'>Desde: <input class='input-tarifa' id='desde_$id' type'number' value='$desde'> KM.</div>
               <div class='tarifa-title'>Hasta: <input class='input-tarifa' id='hasta_$id' type'number' value='$hasta'> KM.</div>
               <div class='tarifa-title'>Precio: $.<input class='input-tarifa' id='precio_$id' type'number' value='$precio'></div>
               <div class='buttons-tarifa-parent'>
                 <a class='button-tarifa editar-tarifa' id='tarifa_$id'> Editar</a>
                 <a hidden class='button-tarifa guardar-tarifa' tarifa='$id'> Guardar</a>
                 <a class='button-tarifa eliminar-tarifa' tarifa='$id'> Eliminar</a>
              </div>
            </div>
          </div>
          ";
        }

    }
    else
    {
        $respuesta['tarifas'] = EmptyPage('Sin Datos Para Mostrar.');
    }

    echo json_encode($respuesta);     
}

function calcular_tarifa()
{
   include_once '../conexion.php';

   if(isset($_POST['distancia']) && isset($_POST['servicio']))
   {
     $distancia = $_POST['distancia'];
     $servicio = $_POST['servicio'];

     if($distancia <= 6)
     {
        $precio = PrecioTarifa($distancia, $servicio);
     }
     else
     {
      if($servicio == '1')
      {
        $categoria = 'Kilometro Adicional';
        $precio = PrecioTarifaEspecial($categoria, $servicio);
        $kilometros = $distancia - 6;
        $precio = $precio * $kilometros + 2;
      }
      else
      { 
        $precio = 0;
      }
     }

   }
  
   echo $precio;

}
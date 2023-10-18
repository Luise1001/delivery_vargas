<?php

function mis_direcciones()
{
  include_once '../conexion.php';
  $admin = $_SESSION['DLV']['admin'];
  $UserID = UserID($admin);
  $AdminLevel = AdminLevel($UserID);
  $MyStaticLocations = MyStaticLocations($UserID);
  $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
  $respuesta =
    [
      'titulo' => $back_btn . 'MIS DIRECCIONES',
      'direcciones' => ''
    ];

    if($MyStaticLocations)
    {
      foreach($MyStaticLocations as $location)
      {
        $id = $location['Id'];
        $nombre = $location['Nombre'];
        $ubicacion = $location['Ubicacion'];
        $actualizado = $location['Actualizado'];
        $fecha_actual = CurrentTime();
        $actualizado = TimeDifference($actualizado, $fecha_actual);

        $respuesta['direcciones'] .=
        "
        <div class='card-direction' >
        <div class='card-direction-header'>
          <div class='card-direction-title'>
          <i class='fa-solid fa-map-marker-alt'>
          </i><input class='input-direccion' readonly id='direccion_$id' type='text' value='$nombre'/>
          </div>
          <div class='card-time'>$actualizado</div>
        </div>
        <div class='card-direction-body'>
          $ubicacion
        </div>
        <div class='card-direction-links'>
        <a id='editar_direccion' direccion='$id' class='card-direction-link'>Editar</a>
        <a hidden id='edit_dir_$id' direccion='$id' class='card-direction-link save-direction'>Guardar</a>
        <a id='eliminar_direccion' direccion='$id' class='card-direction-link'>Eliminar</a>
        </div>
      </div>
      ";
      }
    }
    else
    {
       $respuesta['direcciones'] = EmptyPage('Sin Direcciones Guardadas');
    }

    echo json_encode($respuesta);
}


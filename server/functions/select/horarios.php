<?php

function mi_horario()
{
    include_once '../conexion.php';
    $admin = $_SESSION['DLV']['admin'];
    $id_usuario = UserID($admin);
    $rif = ComercioRif($id_usuario);
    $id_comercio = ComercioID($rif);
    $dias = Days();
    $mi_horario = MySchedule($id_comercio);

    $horario =
    "
    <ul>
    <div class='opciones'>
     <a  class='btn menu_opciones list-hor-btn' title='Mi Horario'>
     <i class='fas fa-clock'></i> Horario
     </i> <i id='arrow_hr' class='fas fa-angle-down'></i>
     </a>
     <div class='dropdown-container'>
    ";

    if($mi_horario)
    {
       foreach($mi_horario as $dato)
       {
         $id_dia = $dato['Id_dia'];
         $nombre = $dato['Dia'];
         $abrir = $dato['Abrir'];
         $cerrar = $dato['Cerrar'];
         
        $horario .=
        "
        <li class='form-check form-switch form-check-reverse'>
        <div class='text-switch'>
        $nombre 
        </div>
        <input id='switch_$id_dia' dia='$id_dia' checked class='form-check-input switch-time' type='checkbox' role='switch'>
        <div id='div_hour_$id_dia' class='input-hour'>
        <input dia='$id_dia' id='open_$id_dia' class='input-opcion-2 open-hour' type='time' value='$abrir'>
        <input dia='$id_dia' id='closed_$id_dia' class='input-opcion-2 close-hour' type='time' value='$cerrar'>
        </div>
        </li>
        ";
       }
    }

    if($dias)
    {
       foreach($dias as $dia)
       {
        $id_dia = $dia['Id'];
        $nombre = $dia['Dia'];
        $checked = CheckSchedule($id_dia, $id_comercio);
        if(!$checked)
        {
          $horario .=
          "
          <li class='form-check form-switch form-check-reverse'>
          <div class='text-switch'>
          $nombre 
          </div>
          <input id='switch_$id_dia' dia='$id_dia' class='form-check-input switch-time' type='checkbox' role='switch'>
          <div hidden id='div_hour_$id_dia' class='input-hour'>
          <input id='open_$id_dia' class='input-opcion-2' type='time' value='08:00'>
          <input id='closed_$id_dia' class='input-opcion-2' type='time' value='12:00'>
          </div>
          </li>
          ";
        }

          
       }

       $horario .=
       "
       </div>
       </div>
       <div class='text-center p-2'>
       <a hidden id='guardar_horario' class='btn'> <i class='fas fa-save'></i> Guardar</a>
       </div>
       </ul>
       ";

    }

    echo $horario;
}

function ChequearHorario()
{
   include_once '../conexion.php';

   if(isset($_POST['id_comercio']))
   {
      $id_comercio = $_POST['id_comercio'];
      $comercioSwitch = ComercioDisponible($id_comercio);
      $dia = CurrentDay();
      $id_dia = DayID($dia);
      $hora = CurrentHour();
      $comercioHorario = ComercioDisponiblePorFecha($id_comercio, $id_dia, $hora);

      if($comercioHorario)
      {
         if($comercioSwitch)
         {
            echo true;
         }
         else
         {
             echo false;
         }
      }
      else
      {
          echo false;
      }
   }
}
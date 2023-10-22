<?php

function mi_horario()
{
   include_once '../conexion.php';
   $admin = $_SESSION['DLV']['admin'];
   $UserID = UserID($admin);
   $ComercioData = ComercioData($UserID);
   $id_comercio = $ComercioData[0]['Id'];
   $Days = Days();
   $MySchedule = MySchedule($id_comercio);
   $back_btn = "<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button>";
   $respuesta =
      [
         'titulo' => $back_btn . 'MI HORARIO',
         'horario' => ''
      ];

   if ($MySchedule) {
      foreach ($MySchedule as $schedule) {
         $id_dia = $schedule['Id'];
         $dia = $schedule['Dia'];
         $abrir = $schedule['Abrir'];
         $cerrar = $schedule['Cerrar'];

         $respuesta['horario'] .=
            "
            <div class='form-check form-switch schedule-switch'>
               <div class='text-switch'>
                 $dia
               </div>
               <div id='div_hour_$id_dia' class='input-hour'>
                <input dia='$id_dia' id='open_$id_dia' class='open-hour' type='time' value='$abrir'>
                <input dia='$id_dia' id='closed_$id_dia' class='close-hour' type='time' value='$cerrar'>
              </div>
              <div class='input-switch'>
              <input id='switch_$id_dia' dia='$id_dia' checked class='form-check-input switch-time' type='checkbox' role='switch'>
              </div>
            </div>
            ";
      }


      foreach ($Days as $day) {
         $id_dia = $day['Id'];
         $dia = $day['Dia'];
         $CheckSchedule = checkSchedule($id_dia, $id_comercio);

         if (!$CheckSchedule) {
            $respuesta['horario'] .=
            "
             <div class='form-check form-switch schedule-switch'>
                <div class='text-switch'>
                   $dia
                </div>
                <div hidden id='div_hour_$id_dia' class='input-hour'>
                   <input id='open_$id_dia' class='open-hour' type='time' value='08:00'>
                   <input id='closed_$id_dia' class='close-hour' type='time' value='12:00'>
                </div>
                <div class='input-switch'>
                    <input id='switch_$id_dia' dia='$id_dia' class='form-check-input switch-time' type='checkbox' role='switch'>
                </div>
             </div>
            "; 
         }
      }

         $respuesta['horario'] .=
            "
               <div class='schedule-button-parent'>
                  <a hidden id='guardar_horario' class='schedule-button'> <i class='fas fa-save'></i> Guardar</a>
               </div>
               ";
   }

   echo json_encode($respuesta);
}

function ChequearHorario()
{
   include_once '../conexion.php';

   if (isset($_POST['id_comercio'])) {
      $id_comercio = $_POST['id_comercio'];
      $comercioSwitch = ComercioDisponible($id_comercio);
      $dia = CurrentDay();
      $id_dia = DayID($dia);
      $hora = CurrentHour();
      $comercioHorario = ComercioDisponiblePorFecha($id_comercio, $id_dia, $hora);

      if ($comercioHorario) {
         if ($comercioSwitch) {
            echo true;
         } else {
            echo false;
         }
      } else {
         echo false;
      }
   }
}

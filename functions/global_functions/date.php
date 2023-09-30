<?php

function CurrentDate()
{
    date_default_timezone_set("America/Caracas");
    
    $fecha = date('Y-m-d');

    return $fecha;
}

function CurrentTime()
{
    date_default_timezone_set("America/Caracas");

    $fecha = date('Y-m-d H:i:s');

    return $fecha;
}

function CurrentDay()
{
    date_default_timezone_set("America/Caracas");

    $fecha = date('l');
    $dia = TransformDay($fecha);

    return $dia;
}

function CurrentHour()
{
    date_default_timezone_set("America/Caracas");

    $hora =  date("H:i:s A");

    return $hora;
}

function DateFormat($fecha)
{
   $date =  date("d/m/Y", strtotime($fecha));

   return $date;
}

function DateHour($fecha)
{
   $date =  date("H:i:s A", strtotime($fecha));

   return $date;
}

function DateDay($fecha)
{
   $date =  date("l", strtotime($fecha));
   $day = TransformDay($date);

   return $day;
}

function TransformDay($day)
{
    switch ($day)
    {
    case "Sunday":
           return "domingo";
    break;
    case "Monday":
           return "lunes";
    break;
    case "Tuesday":
           return "martes";
    break;
    case "Wednesday":
           return "miércoles";
    break;
    case "Thursday":
           return "jueves";
    break;
    case "Friday":
           return "viernes";
    break;
    case "Saturday":
           return "sábado";
    break;
}
}

function TimeDifference($fecha_ini, $fecha_final)
{
   $inicial = date_create($fecha_ini);
   $final = date_create($fecha_final);

   $intervalo = date_diff($inicial, $final);
   $horas = $intervalo->h;
   $minutos = $intervalo->i;
   $segundos = $intervalo->s;
   $dias = $intervalo->d;
   $meses = $intervalo->m;
   $years = $intervalo->y;
   
   $respuesta = '';

   if(!$minutos && !$horas && !$dias)
   {
     $respuesta = "Justo Ahora";
   }

   if($minutos)
   {
     if($minutos === 1)
     {
        $respuesta = "Hace $minutos Minuto";
     }
     else
     {
        $respuesta = "Hace $minutos Minutos";
     }

   }

   if($horas)
   {
    if($horas === 1)
    {
        $respuesta = "Hace $horas Hora";
    }
    else
    {
        $respuesta = "Hace $horas Horas";
    }
   }

   if($dias)
   {
     if($dias === 1)
     {
        $respuesta = "Ayer";
     }
     else
     {
         $respuesta = "Hace $dias Dias";
     }
   }

   if($meses)
   {
     if($meses === 1)
     {
        $respuesta = "Hace $meses Mes";
     }
     else
     {
        $respuesta = "Hace $meses Meses";
     }
   }

   if($years)
   {
     if($years === 1)
     {
         $respuesta = "Hace $years Año";
     }
     else
     {
         $respuesta = "Hace $years Años";
     }
   }

   return $respuesta;
}
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
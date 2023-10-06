<?php

function close()
{
  include_once '../conexion.php';

  if(isset($_SESSION['DLV']))
  {
    unset($_SESSION['DLV']);
     
    return true;
  }
  else
  {
    return false;
  }
}
 
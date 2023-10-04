<?php

function close()
{
  include_once '../conexion.php';

  if(isset($_SESSION['DLV']))
  {
    unset($_SESSION['DLV']);

    echo"<script type='text/javascript'>
    window.location.href='../../index';
    </script>";
  }
}
 
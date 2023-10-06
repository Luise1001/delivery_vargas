<?php 
session_start();
if(isset($_SESSION['DLV']))
{
  $usuario = $_SESSION['DLV']['admin'];
}
else
{
  echo'<script type="text/javascript">
  window.location.href="../../index";
  </script>';
}
?>
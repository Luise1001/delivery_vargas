<?php 
session_start();
if(isset($_SESSION['admin']))
{
  $usuario = $_SESSION['admin'];
}
else
{
  echo'<script type="text/javascript">
  window.location.href="../../index";
  </script>';
}
?>
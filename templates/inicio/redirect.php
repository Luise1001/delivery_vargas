<?php
session_start();
if(isset($_SESSION['DLV']))
{
  $usuario = $_SESSION['DLV']['admin'];
}
else
{
    header('location: ../../index');
}
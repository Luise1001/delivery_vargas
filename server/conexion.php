<?php
if (session_status() === PHP_SESSION_NONE) 
{
  session_start();

  $session_id = session_id();

  setcookie('PHPSESSID', $session_id, time() + (3600 * 24 * 15), '/');
}


$link ='mysql:host=localhost;dbname=delivery_vargas';
$user = 'root';
$pass = 'kN^Sp%}vSchZ';
$error = 0;

 try
  {
   $pdo = new PDO($link,$user);
   //echo '<div class="text-light">conectado</div>';
   }
  catch (PDOException $e) 
  {
    $error = $e->getCode();
    echo "!Error!: " . $e ->getMessage() . "<br/>";

 }
 include_once 'global_functions/add/crear_tablas.php';
 ?>


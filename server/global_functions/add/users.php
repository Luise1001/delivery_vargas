<?php

function AddUser($user_name, $email, $password, $nivel, $fecha)
{
   require '../conexion.php';

   $insert_sql = 'INSERT INTO usuarios (User_name, Correo, Pass, Nivel, Fecha) VALUES (?,?,?,?,?)';
   $sent = $pdo->prepare($insert_sql);

   if($sent->execute(array($user_name, $email, $password, $nivel, $fecha)))
   {
      return true;
   }
   else
   {
     return false;
   }
}
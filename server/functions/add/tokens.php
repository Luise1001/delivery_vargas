<?php

function nuevo_token_firebase()
{
  include_once '../conexion.php';
  $fecha = CurrentDate();
  $movimiento = CurrentTime();

  $admin = $_SESSION['DLV']['admin'];
  $id_usuario = UserID($admin);
  $token = $_POST['token'];
  $nivel = AdminLevel($id_usuario);

  if($id_usuario && $token)
  {
    $firebase_id = FirebaseID($id_usuario);

    if($firebase_id)
    {
      $editsql = 'UPDATE firebase_users SET Token =?, U_movimiento=? WHERE Id_usuario=?';
      $editar_sentence = $pdo->prepare($editsql);
      $editar_sentence->execute(array($token,$movimiento, $id_usuario));

      echo 'update';
    }
    else
    {
      $insert_sql = 'INSERT INTO firebase_users (Id_usuario, Token, Nivel, Fecha) VALUES (?,?,?,?)';
      $sent = $pdo->prepare($insert_sql);
      $sent->execute(array($id_usuario, $token, $nivel, $fecha));

      echo 'insert';
    }
    
  }
}

function generar_codigo()
{
  include_once '../conexion.php';

  if(isset($_POST['correo']))
  {
    $correo = $_POST['correo'];
    $codigo = GeneratePassword();
    $fecha = CurrentDate();

    $insert_sql = 'INSERT INTO codigos_enviados (Codigo, Correo, Fecha) VALUES (?,?,?)';
    $sent = $pdo->prepare($insert_sql);
    $sent->execute(array($codigo, $correo, $fecha));

    $asunto = "Código de Verificación";
    $headers = "From: admin@deliveryvargaslg.com" . "\r\n" ."MIME-Version: 1.0" . "\r\n";
    $headers .="Content-type:text/html;charset=UTF-8" . "\r\n";
    $mensaje = EmailTemplate('Codigo De Verificación', $codigo);
    mail($correo, $asunto, $mensaje, $headers);
    
  }

}
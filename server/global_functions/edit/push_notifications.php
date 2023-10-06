<?php
function push_notification($key, $tokens, $title, $message, $url_destino)
{
  $tokens = json_decode($tokens, true);
  define('SERVER_API_KEY', $key);
  $url = 'https://fcm.googleapis.com/fcm/send';

    $header = [
      'Authorization: key='.SERVER_API_KEY, 
       'Content-Type: Application/json'
      ];
      
      $message =  [
      
        'title' => $title,
        'body' => $message,
        'icon' => '../img/arts/icons_01/icons/icon.png',
        'image' => '../img/arts/icons_01/icons/icon.png',
        'data' => $tokens,
        'url'=> $url_destino
      ];
      
      $payload = [
        'registration_ids' => $tokens,
        'data' => $message
      ];
      
      $curl = curl_init();
      
      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($payload),
        CURLOPT_HTTPHEADER => $header
      ));
      
      $reponse = curl_exec($curl);
      $err = curl_error($curl);
      
      curl_close($curl);
      return $reponse;
  
}

function getTokenIndividual($usuario, $nivel)
{
  require '../conexion.php';


  $consulta_sql = "SELECT Token FROM firebase_users WHERE Id_usuario =? AND Nivel=?";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute(array($usuario, $nivel));
  $resultado = $preparar_sql->fetchAll();

  $array = [];
  $i = 0;

  foreach($resultado as $result)
  {
     $array[$i] = $result['Token'];
     $i++;
  }

  return json_encode($array);
}


function getTokens($nivel)
{
  require '../conexion.php';

  $consulta_sql = "SELECT Token FROM firebase_users WHERE Nivel=?";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute(array($nivel));
  $resultado = $preparar_sql->fetchAll();

  $array = [];
  $i = 0;

  foreach($resultado as $result)
  {
     $array[$i] = $result['Token'];
     $i++;
  }

  return json_encode($array);
}

function requestKey()
{
  require '../conexion.php';
  $rif = '200168757';
 
  $consulta_sql = "SELECT * FROM datos_empresa WHERE Rif=?";
  $preparar_sql = $pdo->prepare($consulta_sql);
  $preparar_sql->execute(array($rif));
  $resultado = $preparar_sql->fetchAll();

  $firebase_key = $resultado[0]['Firebase_key'];

  return $firebase_key;
}












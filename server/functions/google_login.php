<?php

 include_once '../conexion.php';
 require '../global_functions/add/scripts.php';
 require '../global_functions/edit/scripts.php';
 require '../global_functions/select/scripts.php';
 include_once 'add/scripts.php';
 include_once 'select/scripts.php';
 require_once '../../vendor/autoload.php';
 require_once 'config.php';

 $client = new Google_Client();
 $client->setClientId($clientID);
 $client->setClientSecret($clientSecret);
 $client->setRedirectUri($redirectUri);
 $client->addScope("email");
 $client->addScope("profile");

 if(isset($_GET['code']))
 {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->SetAccessToken($token['access_token']);

    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();

    $email = $google_account_info-> email;
    $name = $google_account_info-> name;
    $photo = $google_account_info->picture;

    if($email)
    {
       $UserID = UserID($email);
       
       if($UserID)
       {
           $password = '61651651651';
           $login = login($email, $password);

           if($login['accion'] === 'success')
           {
              echo"<script type='text/javascript'>
              window.location.href='../../templates/inicio/inicio';
              </script>";
           }
           else
           {
              var_dump($login);
           }
       }
       else
       {
         $user_explode = explode('@', $email);
         $user_name = $user_explode[0];
         $nivel = 0;
         $fecha = date('Y-m-d');
         $GeneratePassword = GeneratePassword();
         $password = password_hash($GeneratePassword, PASSWORD_DEFAULT);
         $AddUser = AddUser($user_name, $email, $password, $nivel, $fecha);

         if($AddUser)
         {
             $login = login($email, $GeneratePassword);

            if($login['accion'] === 'success')
            {
               echo"<script type='text/javascript'>
               window.location.href='../../templates/inicio/inicio';
               </script>";
            }
         }

       }
    }
 }
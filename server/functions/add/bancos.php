<?php

use function GuzzleHttp\json_encode;

function nuevos_datos_bancarios()
{
    include_once '../conexion.php';
    $admin = $_SESSION['DLV']['admin'];
    $UserID = UserID($admin);
    $AdminLevel = AdminLevel($UserID);
    $ComercioData = ComercioData($UserID);
    $id_comercio = $ComercioData[0]['Id'];
    $respuesta = 
    [
        'titulo' => 'Ups',
        'cuerpo' => 'No Pudimos Procesar Su Solicitud',
        'accion'=> 'warning' 
    ];

    if(isset($_POST['tipo_db']))
    {
         $tabla = $_POST['tipo_db'];
         $titular = '';
         $tipo_cuenta = '';

         if($tabla === 'pago_movil')
         {
          if(isset($_POST['id_banco']) && isset($_POST['tipo_id']) 
          && isset($_POST['documento']) && isset($_POST['telefono']))
          {
              $id_banco = $_POST['id_banco'];
              $tipo_id = $_POST['tipo_id'];
              $documento = $_POST['documento'];
              $tipo_cuenta = 'Telefono';
              $cuenta = $_POST['telefono'];

              if($id_banco && $tipo_id && $documento && $cuenta)
              {
                $AddDataBank = AddDataBank($tabla, $titular, $tipo_id, $documento, $id_banco, $tipo_cuenta, $cuenta, $id_comercio);
              }
              else
              {
                  $respuesta['cuerpo'] = 'No Se Pueden Guardar Campos Vacíos';
                  $AddDataBank = false;
              }
  
              
  
          }
         }
    
         
  
         if($tabla === 'transferencia')
         {
          if(isset($_POST['id_banco']) && isset($_POST['tipo_id']) 
          && isset($_POST['documento']) && isset($_POST['cuenta']))
          {
              $id_banco = $_POST['id_banco'];
              $tipo_id = $_POST['tipo_id'];
              $documento = $_POST['documento'];
              $tipo_cuenta = 'Cuenta';
              $cuenta = $_POST['cuenta'];

              if($id_banco && $tipo_id && $documento && $cuenta)
              {
                $AddDataBank = AddDataBank($tabla, $titular, $tipo_id, $documento, $id_banco, $tipo_cuenta, $cuenta, $id_comercio);
              }
              else
              {
                  $respuesta['cuerpo'] = 'No Se Pueden Guardar Campos Vacíos';
                  $AddDataBank = false;
              }
          }
         }
  
         if($tabla === 'zelle')
         {
          if(isset($_POST['titular']) && isset($_POST['correo']))
          {
              $titular = $_POST['titular'];
              $cuenta = $_POST['correo'];
              $id_banco = '';
              $tipo_id = '';
              $documento = '';
              $tipo_cuenta = 'Correo';

              if($titular && $cuenta)
              {
                $AddDataBank = AddDataBank($tabla, $titular, $tipo_id, $documento, $id_banco, $tipo_cuenta, $cuenta, $id_comercio);
              }
              else
              {
                $respuesta['cuerpo'] = 'No Se Pueden Guardar Campos Vacíos';
                $AddDataBank = false;
              }
  
             
          }
         }

         if($AddDataBank)
         {
            $respuesta = 
            [
                'titulo' => 'Operación Exitosa',
                'cuerpo' => '',
                'accion'=> 'success' 
            ];
         }
    }

    echo json_encode($respuesta);

}

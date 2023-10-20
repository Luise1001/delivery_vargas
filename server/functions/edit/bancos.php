<?php

function editar_datos_banco()
{
    include_once '../conexion.php';
    $admin = $_SESSION['DLV']['admin'];
    $UserID = UserID($admin);
    $AdminLevel = AdminLevel($UserID);
    $respuesta = 
    [
        'titulo' => 'Ups',
        'cuerpo' => 'No Pudimos Procesar Su Solicitud',
        'accion'=> 'warning' 
    ];

    if(isset($_POST['tabla']))
    {
       $tabla = $_POST['tabla'];
       $titular = '';
       $tipo_cuenta = '';

       if($tabla === 'pago_movil')
       {
        if(isset($_POST['id_pago']) && isset($_POST['id_banco']) && isset($_POST['tipo_id']) 
        && isset($_POST['documento']) && isset($_POST['telefono']))
        {
            $id_pago = $_POST['id_pago'];
            $id_banco = $_POST['id_banco'];
            $tipo_id = $_POST['tipo_id'];
            $documento = $_POST['documento'];
            $tipo_cuenta = 'Telefono';
            $cuenta = $_POST['telefono'];

            if($id_banco && $tipo_id && $documento && $cuenta)
            {
                $EditDataBank = EditDataBank($tabla, $titular, $tipo_id, $documento, $id_banco, $tipo_cuenta, $cuenta, $id_pago);
            }
            else
            {
            
                $respuesta['cuerpo'] = 'No Se Pueden Guardar Campos Vacíos';
                $EditDataBank = false;
            }
        }
       }
  
       

       if($tabla === 'transferencia')
       {
        if(isset($_POST['id_pago']) && isset($_POST['id_banco']) && isset($_POST['tipo_id']) 
        && isset($_POST['documento']) && isset($_POST['cuenta']))
        {
            $id_pago = $_POST['id_pago'];
            $id_banco = $_POST['id_banco'];
            $tipo_id = $_POST['tipo_id'];
            $documento = $_POST['documento'];
            $tipo_cuenta = 'Cuenta';
            $cuenta = $_POST['cuenta'];

            if($id_banco && $tipo_id && $documento && $cuenta)
            {
                $EditDataBank = EditDataBank($tabla, $titular, $tipo_id, $documento, $id_banco, $tipo_cuenta, $cuenta, $id_pago);
            }
            else
            {
            
                $respuesta['cuerpo'] = 'No Se Pueden Guardar Campos Vacíos';
                $EditDataBank = false;
            }

            $EditDataBank = EditDataBank($tabla, $titular, $tipo_id, $documento, $id_banco, $tipo_cuenta, $cuenta, $id_pago);
        }
       }

       if($tabla === 'zelle')
       {
        if(isset($_POST['id_pago']) && isset($_POST['titular']) && isset($_POST['correo']))
        {
            $id_pago = $_POST['id_pago'];
            $titular = $_POST['titular'];
            $cuenta = $_POST['correo'];
            $id_banco = '';
            $tipo_id = '';
            $documento = '';
            $tipo_cuenta = 'Correo';

            if($titular && $correo)
            {
                $EditDataBank = EditDataBank($tabla, $titular, $tipo_id, $documento, $id_banco, $tipo_cuenta, $cuenta, $id_pago);
            }
            else
            {
                $respuesta['cuerpo'] = 'No Se Pueden Guardar Campos Vacíos';
                $EditDataBank = false; 
            }

            
        }
       }

       if($EditDataBank)
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

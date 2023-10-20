<?php

function OptionsPaymentMethods($id_comercio)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM metodos_pago_comercios AS mc
    INNER JOIN metodos_pago AS mp ON mc.Id_metodo = mp.Id
    WHERE Id_comercio=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_comercio));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        return $resultado;
    }
    else
    {
        return false;
    }
}

function BankList()
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM bancos";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute();
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        return $resultado;
    }
    else
    {
        return false;
    }

}

function PaymentMethods()
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM metodos_pago";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute();
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        return $resultado;
    }
    else
    {
        return false;
    }
}

function IdentifyMethod($id_metodo, $id_comercio)
{
     $respuesta = '';

    if($id_metodo == 3)
    {
       $PagoMovil = PagoMovil($id_comercio);

       if($PagoMovil)
       {
          foreach($PagoMovil as $datos)
          {
            $banco = $datos['Banco'];
            $identidad = $datos['Tipo_id'].'-'.$datos['Documento'];
            $telefono = $datos['Telefono'];

            $respuesta .=
            "
            <div class='card-db'>
            <ul class='card-db-items'>
            <li class='card-db-item'>Banco: $banco</li>
            <li class='card-db-item'>Rif: $identidad</li>
            <li class='card-db-item'>Telefono: $telefono</li>
            </ul>
            </div>
            ";
          }

          return $respuesta;
       }
    }
    if($id_metodo == 4)
    {
        $Transferencia =  Transferencia($id_comercio);

        if($Transferencia)
        {
             foreach($Transferencia as $datos)
             {
               $banco = $datos['Banco'];
               $identidad = $datos['Tipo_id'].'-'.$datos['Documento'];
               $cuenta = $datos['Cuenta'];
   
               $respuesta .=
               "
               <div class='card-db'>
               <ul class='card-db-items'>
               <li class='card-db-item'>Banco: $banco</li>
               <li class='card-db-item'>Rif: $identidad</li>
               <li class='card-db-item'>Cuenta: $cuenta</li>
               </ul>
               </div>
               ";
             }

             return $respuesta;
        }
    }
    if($id_metodo == 5)
    {
        $Zelle =  Zelle($id_comercio);

        if($Zelle)
        {
            foreach($Zelle as $datos)
            {
              $titular = $datos['Titular'];
              $correo = $datos['Correo'];
  
              $respuesta .=
              "
              <div class='card-db'>
              <ul class='card-db-items'>
              <li class='card-db-item'>Titular: $titular</li>
              <li class='card-db-item'>Correo: $correo</li>
              </ul>
              </div>
              ";
            }

            return $respuesta;
        }
    }

    return false;
}

function MethodForEdit($table, $id_datos)
{
    require '../conexion.php';

    if($table != 'zelle')
    {
        $consulta_sql = "SELECT * FROM bancos INNER JOIN $table ON $table.Id_banco = bancos.Id WHERE $table.Id=?";
        $preparar_sql = $pdo->prepare($consulta_sql);
        $preparar_sql->execute(array($id_datos));
        $resultado = $preparar_sql->fetchAll();
    }
    else
    {
        $consulta_sql = "SELECT * FROM $table WHERE Id=?";
        $preparar_sql = $pdo->prepare($consulta_sql);
        $preparar_sql->execute(array($id_datos));
        $resultado = $preparar_sql->fetchAll();
    }

    if($resultado)
    {
        return $resultado;
    }
    else
    {
        return false;
    }
}

function PagoMovil($id_comercio)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM bancos INNER JOIN pago_movil ON pago_movil.Id_banco = bancos.Id WHERE Id_comercio=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_comercio));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        return $resultado;
    }
    else
    {
        return false;
    }
}

function Transferencia($id_comercio)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM bancos INNER JOIN transferencia ON transferencia.Id_banco = bancos.Id WHERE Id_comercio=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_comercio));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        return $resultado;
    }
    else
    {
        return false;
    }
}

function Zelle($id_comercio)
{
    require '../conexion.php';

    $consulta_sql = "SELECT * FROM zelle WHERE Id_comercio=?";
    $preparar_sql = $pdo->prepare($consulta_sql);
    $preparar_sql->execute(array($id_comercio));
    $resultado = $preparar_sql->fetchAll();

    if($resultado)
    {
        return $resultado;
    }
    else
    {
        return false;
    } 
}
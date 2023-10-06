<?php

function nuevo_pedido()
{
    include_once '../conexion.php';

    if(isset($_POST['id_cliente']) && isset($_POST['id_comercio']))
    {
        $fecha = CurrentDate();
        $id_cliente = $_POST['id_cliente'];
        $id_comercio = $_POST['id_comercio'];
        $nro_pedido = OrderNumber();

        $InsideMyCar = InsideMyCar($id_cliente, $id_comercio);

        $subtotal = SubtotalCar($id_cliente, $id_comercio);
        $iva = IvaCar($id_cliente, $id_comercio);
        $total = TotalCar($id_cliente, $id_comercio);
        $creado = 1;

        if($InsideMyCar)
        {
            foreach($InsideMyCar as $products)
            {
               $id_producto = $products['Id_producto'];
               $cantidad = $products['Cantidad'];

               $insert_sql = 'INSERT INTO pedidos (Nro_pedido, Id_cliente, Id_producto, Id_comercio, Cantidad, Fecha) VALUES (?,?,?,?,?,?)';
               $sent = $pdo->prepare($insert_sql);
               $sent->execute(array($nro_pedido, $id_cliente, $id_producto, $id_comercio, $cantidad, $fecha));
            }

            $insert_sql = 'INSERT INTO pedidos_monto (Id_cliente, Nro_pedido, Subtotal, Iva, Total, Id_comercio, Fecha) VALUES (?,?,?,?,?,?,?)';
            $sent = $pdo->prepare($insert_sql);
            $sent->execute(array($id_cliente, $nro_pedido, $subtotal, $iva, $total, $id_comercio, $fecha));

            $insert_sql = 'INSERT INTO estatus_pedidos (Nro_pedido, Creado, Id_cliente, Id_comercio, Fecha) VALUES (?,?,?,?,?)';
            $sent = $pdo->prepare($insert_sql);
            $sent->execute(array($nro_pedido,$creado, $id_cliente, $id_comercio, $fecha));

            CleanCar($id_cliente, $id_comercio);
        }
    }

}


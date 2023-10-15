<?php

function anular_pedido()
{
    require '../conexion.php';

    $respuesta =
    [
        'titulo'=> 'ups!',
        'cuerpo' => '',
        'accion'=> 'warning'
    ];

    if(isset($_POST['nro_pedido']))
    {
        $nro_pedido = $_POST['nro_pedido'];
        $nro_pedido = filter_var($nro_pedido, FILTER_SANITIZE_NUMBER_INT);
        $actualizado = CurrentTime();
        $anulado = 1;

        $editsql = 'UPDATE estatus_pedidos SET Anulado=?, Actualizado=? WHERE Nro_pedido=?';
        $editar_sentence = $pdo->prepare($editsql);
        if($editar_sentence->execute(array($anulado, $actualizado, $nro_pedido)))
        {
            $respuesta =
            [
                'titulo'=> 'Operación Exitosa',
                'cuerpo' => '',
                'accion'=> 'success'
            ];
        }
        else
        {
            $respuesta['cuerpo'] = 'No se Pudo Procesar Su Solicitud';
        }


        echo json_encode($respuesta);
    }
}
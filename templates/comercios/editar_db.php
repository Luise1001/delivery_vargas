<?php
include_once 'redirect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include_once 'head_html.php'; ?>
    <title>Delivery Vargas</title>
</head>

<body class='hide-content'>
    <?php include_once '../loader.php'; ?>

    <?php include_once '../inicio/menu.php'; ?>

    <div class="principal-layout">

        <div hidden id='pago_movil' class='datos-bank'></div>

        <div hidden id='transferencia' class='datos-bank'></div>

        <div hidden id='zelle' class='datos-bank'></div>


    </div>

    <script src="js/editar/datos_bancarios.js"></script>

    <?php include_once 'scripts.php'; ?>
</body>

</html>
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
        <div class="detalle-envio"></div>

    </div>

    <?php include_once 'modals/consulta/modal_asignar_conductor.php' ?>
    <script src="js/consulta/detalle_envio.js"></script>
    <?php include_once 'scripts.php'; ?>
</body>

</html>
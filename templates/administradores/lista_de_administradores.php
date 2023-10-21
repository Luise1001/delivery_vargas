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
        <div class="lista-de-administradores">
            <div class="wrapper">
                <div class="slider">
                    <div class="type-order-title">Conductores</div>
                    <div id="conductores"></div>
                </div>
                <div class="slider">
                    <div class="type-order-title">Administradores</div>
                    <div id="admins"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/consulta/lista_de_administradores.js"></script>

    <?php include_once 'scripts.php'; ?>
</body>

</html>
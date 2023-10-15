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
        <div class="finalizar-compra">
            <div class="metodos-de-pago"></div>
            <div class="datos-bancarios"></div>
            <div class="direccion-salida"></div>
            <div class="direccion-destino"></div>
            <div style="height: 200px !important; margin-top: 10px; " id="googleMap"></div>
            <div hidden id="output"></div>

            <div class='container'>
                <button id='' class='perfil-button'>Guardar</button>
            </div>
        </div>
    </div>

    <script src="js/consulta/finalizar_compra.js"></script>
    <?php include_once 'scripts.php'; ?>
    <script src="../inicio/js/mapas/google_map.js"></script>
</body>

</html>
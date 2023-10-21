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
            <div class="metodos-de-pago">
                <label class='form-label' for='metodos'>Métodos de Pago</label>
                <select class='form-select perfil-select' id='metodos' name='metodos'></select>
            </div>
            <div class="monto-total"></div>
            <div class="datos-bancarios"></div>
            <div hidden class="container-ref">
                <label class='form-label' for="referencia">Referencia <span class='text-danger'>*</span> </label>
                <input  id='referencia' name='referencia' class='referencia' type="number" placeholder="Últimos Seis (6) Dígitos" max="999" onkeypress="if (this.value.length > 5) return false;">
            </div>
            <div class="direccion-salida">
                <label class='form-label' for='from'>Dirección</label>
                <select class='form-select perfil-select' id='from' name='from'></select>
            </div>
            <div class="direccion-destino">
                <label class='form-label' for='to'>Mis Direcciones</label>
                <select class='form-select perfil-select' id='to' name='to'></select>
            </div>
            <div style="height: 200px !important; margin-top: 40px; " id="googleMap"></div>
            <div hidden id="output"></div>

            <div class='container'>
                <button id='enviar_pedido' name='enviar_pedido' class='perfil-button'>Enviar</button>
            </div>
        </div>
    </div>

    <script src="js/consulta/finalizar_compra.js"></script>
    <?php include_once '../inicio/api_google_map.php'; ?>
    <script src="js/mapas/routes.js"></script>
    <script src="js/mapas/geocoding.js"></script>
    <script src="js/mapas/autocomplete.js"></script>
    <script src="js/mapas/mapa.js"></script>
    <?php include_once 'scripts.php'; ?>
</body>

</html>
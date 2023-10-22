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
        <div class="detalle-moto">
            <div class='personal-data'>
                <label class='form-label' for='marca'>Marca<span class='text-danger'>*</span></label>
                <input class='form-control perfil-input' type='text' id='marca' name='marca' placeholder="Marca">
                <label class='form-label' for='modelo'>Modelo<span class='text-danger'>*</span></label>
                <input class='form-control perfil-input' type='text' id='modelo' name='modelo' placeholder="Modelo">
                <label class='form-label' for='placa'>Placa<span class='text-danger'>*</span></label>
                <input class='form-control perfil-input' type='text' id='placa' name='placa' placeholder="Modelo">
                <label class='form-label' for='year'>Año<span class='text-danger'>*</span></label>
                <input class='form-control perfil-input' type='number' id='year' name='year' placeholder="Año">
                <label class='form-label' for='cedula'>Cédula Del Conductor<span class='text-danger'>*</span></label>
                <input class='form-control perfil-input' type='text' id='cedula' name='cedula' placeholder="123456789">
                <span class='red-alert'></span>

                <div class='container'>
                    <button id='guardar_moto' class='perfil-button'>Guardar</button>
                </div>
            </div>
        </div>

    </div>

    <script src="js/agregar/nueva_moto.js"></script>
    <?php include_once 'scripts.php'; ?>
</body>

</html>
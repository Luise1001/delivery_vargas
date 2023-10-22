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
        <div class="detalle-conductor">
        <div class='personal-data'>
                <label class='form-label' for='nombre'>Nombres<span class='text-danger'>*</span></label>
                <input class='form-control perfil-input' type='text' id='nombre' name='nombre' placeholder="Pedro">
                <label class='form-label' for='apellido'>Apellidos<span class='text-danger'>*</span></label>
                <input class='form-control perfil-input' type='text' id='apellido' name='apellido' placeholder="Perez">
                <label class='form-label' for='cedula'>Cédula de Identidad<span class='text-danger'>*</span></label>
                <div class='input-group'>
                    <select class='form-select perfil-select' id='tipo_id' name='tipo_id'>
                        <option value='V'>V</option>
                        <option value='E'>E</option>
                        <option value='P'>P</option>
                    </select>
                    <input class='form-control perfil-input' type='number' id='cedula' name='cedula' placeholder="123456789">
                </div>
                <label class='form-label' for='correo'>Correo Electrónico<span class='text-danger'>*</span></label>
                <input class='form-control perfil-input' type='email' id='correo' name='correo' placeholder="Ejemplo@ejemplo.com">
                <div><span class='red-alert'></span></div>
                <label class='form-label' for='telefono'>Celular<span class='text-danger'>*</span></label>
                <input class='form-control perfil-input' type='number' id='telefono' name='telefono' placeholder="123456789">
                <label class='form-label' for='direccion'>Dirección<span class='text-danger'>*</span></label>
                <input class='form-control perfil-input' type='text' id='direccion' name='direccion' placeholder="Dirección">

                <div class='container'>
                    <button id='guardar_conductor' class='perfil-button'>Guardar</button>
                </div>
            </div>
        </div>
        </div>

    </div>

    <script src="js/agregar/nuevo_conductor.js"></script>
    <?php include_once 'scripts.php'; ?>
</body>

</html>
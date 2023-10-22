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
        <div class="detalle-administrador">
        <div class='personal-data'>
                <label class='form-label' for='correo'>Correo<span class='text-danger'>*</span></label>
                <input class='form-control perfil-input' type='email' id='correo' name='correo' placeholder="Ejemplo@ejemplo.com">
                <div><span class='red-email'></span></div>
                <label class='form-label' for='pass'>Contraseña<span class='text-danger'>*</span></label>
                <input class='form-control perfil-input' type='password' id='pass' name='pass' placeholder="**********">
                <label class='form-label' for='pass_2'>Repetir Contraseña<span class='text-danger'>*</span></label>
                <input class='form-control perfil-input' type='password' id='pass_2' name='pass_2' placeholder="**********">
                <div><span class='red-alert'></span></div>
                <label class='form-label' for='nivel'>Nivel Administrativo<span class='text-danger'>*</span></label>
                <div class='input-group'>
                    <select class='form-select perfil-select' id='nivel' name='nivel'>
                        <option value='2'>Conductor</option>
                        <option value='1'>Administrador</option>
                    </select>
                </div>
                <div class='container'>
                    <button id='guardar_admin' class='perfil-button'>Guardar</button>
                </div>
            </div>
        </div>
        </div>

    </div>

    <script src="js/agregar/nuevo_administrador.js"></script>
    <?php include_once 'scripts.php'; ?>
</body>

</html>
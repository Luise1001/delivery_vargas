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

        <div class="nuevo-db">

            <label class='form-label' for="tipo_db">Tipo</label>
            <select class="form-select" id="tipo_db" name="tipo_db">
                <option value="pago_movil">Pago Móvil</option>
                <option value="transferencia"> Transferencia</option>
                <option value="zelle">Zelle</option>
            </select>

            <div class="db-bs">
                <label class='form-label' for='bancos'>Bancos<span class='text-danger'>*</span></label>
                <div class='input-group'>
                    <select class='form-select perfil-select' id='bancos' name='bancos'>

                    </select>
                </div>

                <label class='form-label' for='documento'>Documento de Identidad<span class='text-danger'>*</span></label>
                <div class='input-group'>
                    <select class='form-select perfil-select' id='tipo_id' name='tipo_id'>
                        <option value="V">V</option>
                        <option value="J">J</option>
                        <option value="E">E</option>
                        <option value="P">P</option>
                        <option value="G">G</option>
                    </select>
                    <input class='form-control perfil-input' type='number' id='documento' name='documento' placeholder="Ej. 123456789">
                </div>

                <div class="cuenta-tr">
                    <label class='form-label' for='cuenta'>Número de Cuenta<span class='text-danger'>*</span></label>
                    <input class='form-control perfil-input' type='number' id='cuenta' name='cuenta' placeholder="123456789">
                </div>

                <div class="cuenta-pm">
                    <label class='form-label' for='telefono'>Telefono<span class='text-danger'>*</span></label>
                    <input class='form-control perfil-input' type='number' id='telefono' name='telefono' placeholder="123456789">
                </div>
            </div>

            <div class="zelle-div">
                <label class='form-label' for='titular'>Titular<span class='text-danger'>*</span></label>
                <input class='form-control perfil-input' type='text' id='titular' name='titular' placeholder="Ej. Pedro Perez">
                <label class='form-label' for='correo'>Correo<span class='text-danger'>*</span></label>
                <input class='form-control perfil-input' type='email' id='correo' name='correo' placeholder="Example@example.com">
            </div>


            <div class='container'>
                <button id='guardar_db' class='perfil-button'>Guardar</button>
            </div>
        </div>
    </div>

    <script src="js/agregar/datos_bancarios.js"></script>

    <?php include_once 'scripts.php'; ?>
</body>

</html>
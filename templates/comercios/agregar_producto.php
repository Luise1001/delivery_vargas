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
        <div class="nuevo-producto">
        <div class='header-producto'>
            <img id='img_producto' src='../../server/images/products/generico.png' alt='codigo'>
            <input  type='file' accept='image/*' id='foto_producto' class='file-selector'>
            <label for='foto_producto' class='file-selector-label'>
            <span class='file-selector-span'><i class='fas fa-camera'></i></span>
            </label>
            </div>
            <div class='product-detail'>
            <label class='form-label' for='codigo'>Codigo<span class='text-danger'>*</span></label>
            <input class='form-control ' type='text' id='codigo' name='codigo' placeholder="Código Único">
            <div class="alert-code">
            <span id='alert_code' class='text-danger'></span>
            </div>
            <label class='form-label' for='descripcion'>Descripcion<span class='text-danger'>*</span></label>
            <input class='form-control ' type='text' id='descripcion' name='descripcion' placeholder="Describa El Producto">
            <label class='form-label' for='precio'>Precio<span class='text-danger'>*</span></label>
            <input class='form-control ' type='number' id='precio' name='precio' placeholder="Precio Neto">
            <label class='form-label' for='exento'>Exento<span class='text-danger'>*</span></label>
            <div class='exento'>
            <div class='form-check'>
            <input $yes class='form-check-input' value='0' type='radio' id='ex_yes' name='exento'>
            <label class='form-check-label' for='ex_yes'>
              Si
            </label>
          </div>
          <div class='form-check'>
          <input $no class='form-check-input' value='16' type='radio' id='ex_no' name='exento'>
          <label class='form-check-label' for='ex_no'>
            No
          </label>
        </div>
            </div>
            <label class='form-label' for='peso'>Peso Kg.<span class='text-danger'>*</span></label>
            <input class='form-control ' type='text' id='peso' name='peso' placeholder="Ej. 1 para Kilo. o 0,1 Para Gramos">
            <label class='form-label' for='stock'>Existencia<span class='text-danger'>*</span></label>
            <input class='form-control ' type='number' id='stock' name='stock' placeholder="Cantidad Disponible Del Producto">
            <div class='container'>
              <button id='nuevo_producto' class='perfil-button'>Guardar</button>
            </div>
          </div>
        </div>

    </div>

    <script src="js/agregar/nuevo_producto.js"></script>
    <?php include_once 'scripts.php'; ?>
</body>

</html>
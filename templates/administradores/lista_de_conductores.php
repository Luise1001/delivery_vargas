<?php 
include_once '../../functions/verificar_sesion_admin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<?php include_once 'head_html.php';?>
   <title>Delivery Vargas</title>
</head>
<body class='hide-content'>
    <?php include_once 'loader.php';?>
<div id="contenido" >

<?php include_once 'sidebar.php';?>

<div class="lista-de-conductores cuerpo"></div>

<script src="js/consulta/lista_de_conductores.js"></script>

<?php include_once 'scripts.php';?>
<?php include_once 'footer.php';?>
</body>
</html>
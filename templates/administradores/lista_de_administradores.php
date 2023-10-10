<?php 
include_once 'redirect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<?php include_once 'head_html.php';?>
   <title>Delivery Vargas</title>
</head>
<body class='hide-content'>
    <?php include_once '../loader.php';?>
<div id="contenido" >
  
<?php include_once '../inicio/menu.php';?>

    <div class="lista-de-administradores cuerpo">

<div id="admins"></div>
<div id="conductores"></div>
<div id="admin_grua"></div>

    </div>


</div>

<script src="js/consulta/lista_de_administradores.js"></script>

<?php include_once 'scripts.php';?>
</body>
</html>
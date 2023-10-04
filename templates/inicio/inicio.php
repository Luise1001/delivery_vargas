<?php 
session_start();
if(isset($_SESSION['DLV']))
{
  $usuario = $_SESSION['DLV']['admin'];
}
else
{
    header('location: ../../index');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../head_html.php';?>
    <title>Delivery Vargas</title>
</head>
<body class='hide-content'>
    <?php include_once '../loader.php';?>
    <?php include_once '../sidebar.php';?>


    <div class="container container-map">
    <div class="index-map">
    <div class="container-fluid">
      <form class="form-horizontal col-md-6">

        <div class="form-group col-md-12 text-center">
          <label id="label-my-location" for="from" class="form-label"> Mi Ubicación: </label>
          <div>
          <i class="fas fa-map-marker-alt marker-my-location"></i>
            <input id="from" type="text" placeholder="Mi Ubicación " class="input-opcion-7" >
            <br>
          </div>

            <div id="d_name" class="d-none">
            <i class="fas fa-map-marker-alt marker-my-location"></i>
            <input id="direccion_nombre" name="direccion_nombre" type="text" placeholder="Ej. Casa" class="input-opcion-7" >

            </div>
        
            <div class=" form-group col-md-12 text-center m-2">
            <button id="confirm_location" class="card-btn  text-center">
              <i class="fas fa-directions"></i> Guardar
             </button>
           </div>

           <input  class='form-check-input' type='checkbox'  value='' id='save_location' name='save_location'>
           <label id="save_location_label" class='form-check-label' for='save_location'>
            Agregar a Mis Direcciones
            </label> 
          </div>
         </div>
         

      </form>

      <div class="container container-map">
        <div id="googleMap">

        </div>
        <div id="output">

        </div>
      </div>
    </div>
  </div>
  </div>
    </div>


   <?php include_once 'scripts.php';?>

    <?php include_once '../footer.php';?>
    
</body>
</html>
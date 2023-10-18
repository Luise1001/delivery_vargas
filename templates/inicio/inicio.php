<?php include_once 'redirect.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'head_html.php';?>
    <title>Delivery Vargas</title>
</head>
<body class='hide-content'>
    <?php include_once '../loader.php';?>
    <?php include_once 'menu.php';?>


    <div class="container-map">
    <div class="index-map">
    <div class="container-fluid">
      <form class="form-mi-ubicacion">

        <div class="form-group col-md-12 text-center">
          <label id="label-my-location" for="from" class="form-label"> Mi Ubicación: </label>
          <div>
          <i class="fas fa-map-marker-alt marker-my-location"></i>
            <input class='input-from' id="from" type="text" placeholder="Mi Ubicación ">
            <br>
          </div>

            <div id="d_name" class="d-none">
            <i class="fas fa-map-marker-alt marker-my-location"></i>
            <input id="direccion_nombre" name="direccion_nombre" type="text" placeholder="Ej. Casa">

            </div>
        
            <div class="form-group col-md-12 text-center m-2">
            <button id="confirm_location" class="confirmar-location">
              <i class="fas fa-directions"></i> Confirmar
             </button>
           </div>

           <input  class='form-check-input' type='checkbox'  value='' id='save_location' name='save_location'>
           <label id="save_location_label" class='form-label' for='save_location'>
            Guardar Dirección
            </label> 
          </div>
         </div>
         

      </form>

      <div class="container-map">
        <div id="googleMap">

        </div>
        <div hidden id="output">

        </div>
      </div>
    </div>
  </div>
  </div>
    </div>


   <?php include_once 'scripts.php';?>

</body>
</html>
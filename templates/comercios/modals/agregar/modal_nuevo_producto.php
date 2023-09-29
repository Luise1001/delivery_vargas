<div>
<div class="modal fade" id="nuevo_producto" tabindex="-1" role="dialog"   aria-labelledby="nuevo_productoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

    <div class="modal-header d-flex justify-content-center ml-2 mt-2 mr-2 mb-0">
    <button  class="btn back-btn" data-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
        <h5 class="modal-title" id="nuevo_producto_Label"><i class="fas fa-wine-bottle"></i> Nuevo Producto</h5>
      </div>
      <div id="nuevo_producto_form" class="modal-body m-2">
      <form method="post"  enctype="multipart/form-data" class="row g-3">
      <div class="col-md-12">
        <div class="div-foto-producto">
        <label class="card-img label-foto" for="foto_producto"><img id="foto" src="../../img/arts/deliveryvargaslogo.png" class="card-img foto-producto" alt="Subir Imagen"></label>
      <div>
      <input class="file-selector" accept="image/*" type='file' id="foto_producto" name="foto_producto" />
       <label for="foto_producto" class="file-selector-label"></label> 
       <span class='file-selector-span-icon'><i class="fas fa-hand-point-up"></i> Agregar Imagen<span class="text-danger">*</span></span>  
    </div>
        </div>

    </div>

    <div class="col-md-6">
    <label for="codigo_producto" class="form-label">ID Único<span class="text-danger">*</span></label>
    <input type="text" class="input-opcion-4"   id="codigo_producto" name="codigo_producto"  placeholder="ID Único" required>
    <p id="alert_codigo_producto" class="text-danger"></p>
  </div> 


  <div class="col-md-6">
    <label for="peso" class="form-label">Peso KG.<span class="text-danger">*</span></label>
    <input type="number" class="input-opcion-4" id="peso" name="peso"  placeholder="0" required>
  </div>   

  <div class="col-md-12">
    <label for="descripcion_producto" class="form-label">Descripción<span class="text-danger">*</span></label>
    <input type="text" class="input-opcion-4" id="descripcion_producto" name="descripcion_producto" placeholder="Describe el Producto" required>
  </div>

  <div class="col-md-6">
    <label for="p_civa" class="form-label">Precio $<span class="text-danger">*</span></label>
    <input type="number" class="input-opcion-4" id="p_civa" name="p_civa" placeholder="$" required>

    <input  class='form-check-input' type='checkbox'  value='' id='exento' name='exento'>
    <label id="exento_label" class='form-check-label' for='exento'>
           Exento
    </label> 
  </div>

  <div class="col-md-6">
    <label for="cantidad" class="form-label">Stock<span class="text-danger">*</span></label>
    <input type="number" class="input-opcion-4" id="cantidad" name="cantidad"  placeholder="0" required>
  </div>  




</form>

<div class="d-flex justify-content-center m-2 modal-body">
   <button  class="card-btn" id="agregar_producto" data-dismiss="modal">Guardar</button>
   </div>


   
    </div>
  </div>
</div>
</div>


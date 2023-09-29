<div>
<div class="modal fade" id="nueva_tarifa" tabindex="-1" role="dialog"   aria-labelledby="nueva_tarifaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

    <div class="modal-header d-flex justify-content-center ml-2 mt-2 mr-2 mb-0">
    <button  class="btn back-btn" data-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
        <h5 class="modal-title" id="nueva_tarifa_Label"><i class="fas fa-dollar-sign"></i> Nueva Tarifa</h5>
      </div>
      <div id="nueva_tarifa_form" class="modal-body m-2">
      <form class="row g-3">
  <div class="col-md-6">
    <label for="de_km" class="form-label">Cantidad de KM.<span class="text-danger">*</span></label>
    <input type="text" class="input-opcion-4" id="de_km" name="de_km" placeholder="0" required>
  </div>

  <div class="col-md-6">
    <label for="precio" class="form-label">Precio en $<span class="text-danger">*</span></label>
    <input type="number" class="input-opcion-4" id="precio" name="precio"  placeholder="$" required>
  </div>  
</form>

  <div class="d-flex justify-content-center m-2 modal-body">
   <button  class="card-btn" id="agregar_tarifa" data-dismiss="modal">Guardar</button>
   </div>
    </div>
  </div>
</div>
</div>
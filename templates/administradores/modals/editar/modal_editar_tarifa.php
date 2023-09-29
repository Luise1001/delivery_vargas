<div>
<div class="modal fade" id="editar_tarifa" tabindex="-1" role="dialog"   aria-labelledby="editar_tarifaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

    <div class="modal-header d-flex justify-content-center ml-2 mt-2 mr-2 mb-0">
    <button  class="btn back-btn" data-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
        <h5 class="modal-title" id="editar_tarifa_Label"><i class="fas fa-edit"></i> Editar Tarifa</h5>
      </div>
      <div id="editar_tarifa_form" class="modal-body m-2">
      <form class="row g-3">
  <div class="col-md-6">
    <label for="editar_de_km" class="form-label">Cantidad de KM.</label>
    <input type="text" class="input-opcion-4" id="editar_de_km" name="editar_de_km" placeholder="0" required>
  </div>

  <div class="col-md-6">
    <label for="editar_precio" class="form-label">Precio</label>
    <input type="text" class="input-opcion-4" id="editar_precio" name="editar_precio"  placeholder="$" required>
  </div>
  
</form>

  <div class="d-flex justify-content-center m-2 modal-body">
   <button class="card-btn" id="modificar_tarifa" data-dismiss="modal">Guardar Cambios</button>
   </div>
    </div>
  </div>
</div>
</div>
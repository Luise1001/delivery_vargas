<div>
<div class="modal fade" id="editar_moto" tabindex="-1" role="dialog"   aria-labelledby="editar_motoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

    <div class="modal-header d-flex justify-content-center ml-2 mt-2 mr-2 mb-0">
    <button  class="btn back-btn" data-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
        <h5 class="modal-title" id="editar_moto_Label"><i class="fas fa-edit"></i> Datos de la Moto</h5>
      </div>
      <div id="editar_moto_form" class="modal-body m-2">
      <form class="row g-3">
  <div class="col-md-6">
    <label for="editar_marca" class="form-label">Marca</label>
    <input type="text" class="input-opcion-4" id="editar_marca" name="editar_marca" placeholder="Marca" required>
  </div>

  <div class="col-md-6">
    <label for="editar_modelo" class="form-label">Modelo</label>
    <input type="text" class="input-opcion-4" id="editar_modelo" name="editar_modelo" placeholder="Modelo" required>
  </div>

  <div class="col-md-6">
    <label for="editar_placa" class="form-label">Placa</label>
    <input type="text" class="input-opcion-4" id="editar_placa" name="editar_placa"  placeholder="Placa" required>
  </div>

  <div class="col-md-6">
    <label for="editar_year" class="form-label">Año</label>
    <input type="number" class="input-opcion-4" id="editar_year" name="editar_year" placeholder="Año" required>
  </div>

  <div class="col-md-12">
    <label for="editar_cedula" class="form-label">Cedula del Conductor</label>
    <input type="number" class="input-opcion-4" id="editar_cedula" name="editar_cedula" placeholder="Cedula" required>
    <p  class="text-danger aviso"></p>
  </div>
  
</form>

  <div class="d-flex justify-content-center m-2 modal-body">
   <button class="card-btn" id="modificar_moto" data-dismiss="modal">Guardar Cambios</button>
   </div>
    </div>
  </div>
</div>
</div>
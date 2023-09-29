<div>
<div class="modal fade" id="nueva_moto" tabindex="-1" role="dialog"   aria-labelledby="nueva_motoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

    <div class="modal-header d-flex justify-content-center ml-2 mt-2 mr-2 mb-0">
    <button  class="btn back-btn" data-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
        <h5 class="modal-title" id="nueva_moto_Label"><i class="fas fa-motorcycle"></i> Datos de la Moto</h5>
      </div>
      <div id="nueva_moto_form" class="modal-body m-2">
      <form class="row g-3">
  <div class="col-md-6">
    <label for="marca" class="form-label">Marca<span class="text-danger">*</span></label>
    <input type="text" class="input-opcion-4" id="marca" name="marca" placeholder="Marca" required>
  </div>

  <div class="col-md-6">
    <label for="modelo" class="form-label">Modelo<span class="text-danger">*</span></label>
    <input type="text" class="input-opcion-4" id="modelo" name="modelo" placeholder="Modelo" required>
  </div>

  <div class="col-md-6">
    <label for="placa" class="form-label">Placa<span class="text-danger">*</span></label>
    <input type="text" class="input-opcion-4" id="placa" name="placa"  placeholder="Placa" required>
  </div>

  <div class="col-md-6">
    <label for="year" class="form-label">Año<span class="text-danger">*</span></label>
    <input type="number" class="input-opcion-4" id="year" name="year" placeholder="Año" required>
  </div>

  <div class="col-md-12">
    <label for="cedula" class="form-label">Cédula<span class="text-danger">*</span></label>
    <input type="number" class="input-opcion-4" id="cedula" name="cedula" placeholder="Cédula Del Conductor" required>
    <span  class="text-danger aviso"></span>
  </div>
  
</form>

  <div class="d-flex justify-content-center m-2 modal-body">
   <button class="card-btn" id="agregar_moto" data-dismiss="modal">Guardar</button>
   </div>
    </div>
  </div>
</div>
</div>
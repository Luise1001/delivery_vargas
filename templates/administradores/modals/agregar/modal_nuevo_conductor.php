<div>
<div class="modal fade" id="nuevo_conductor" tabindex="-1" role="dialog"   aria-labelledby="nuevo_conductorLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

    <div class="modal-header d-flex justify-content-center ml-2 mt-2 mr-2 mb-0">
    <button  class="btn back-btn" data-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
        <h5 class="modal-title" id="nuevo_conductor_Label"><i class="fas fa-user-plus modal-icon"></i> Datos del Conductor</h5>
      </div>
      <div id="nuevo_conductor_form" class="modal-body m-2">
      <form class="row g-3">
  <div class="col-md-6">
    <label for="nombre" class="form-label">Nombres<span class="text-danger">*</span></label>
    <input type="text" class="input-opcion-4" id="nombre" name="nombre" placeholder="Nombres" required>
  </div>

  <div class="col-md-6">
    <label for="apellido" class="form-label">Apellidos<span class="text-danger">*</span></label>
    <input type="text" class="input-opcion-4" id="apellido" name="apellido" placeholder="Apellidos" required>
  </div>

  <div class="col-md-7">
    <label for="cedula_conductor" class="form-label">Cédula<span class="text-danger">*</span></label>
     <div class="input-group">
     <select class="input-opcion-5"  name="tipo_id" id="tipo_id">
        <option value="V">V</option>
        <option value="E">E</option>
        <option value="P">P</option>
    </select>
    <input type="number" class="input-opcion-5 w-50" id="cedula_conductor" name="cedula_conductor"  placeholder="123456789" required>
     </div>
  </div>

  <div class="col-md-5">
    <label for="telefono" class="form-label">Teléfono<span class="text-danger">*</span></label>
    <input type="number" class="input-opcion-4" id="telefono" name="telefono"  placeholder="58**********" required>
  </div>

  <div class="col-md-12">
    <label for="direccion" class="form-label">Dirección<span class="text-danger">*</span></label>
    <input type="text" class="input-opcion-4" id="direccion" name="direccion"  placeholder="Direccion" required>
  </div>  

  <div class="col-md-12">
    <label for="usuario_conductor" class="form-label">Correo<span class="text-danger">*</span></label>
    <input type="e-mail" class="input-opcion-4" id="usuario_conductor" name="usuario_conductor"  placeholder="example@example.com" required>
     <p id="aviso_2" class="text-danger"></p>
  </div>  
</form>

<div class="d-flex justify-content-center m-2 modal-body">
   <button class="card-btn" id="agregar_conductor" data-dismiss="modal">Guardar</button>
   </div>
   
    </div>
  </div>
</div>
</div>


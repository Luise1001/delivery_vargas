<div>
<div class="modal fade" id="nuevo_admin" tabindex="-1" role="dialog"   aria-labelledby="nuevo_adminLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

    <div class="modal-header d-flex justify-content-center ml-2 mt-2 mr-2 mb-0">
    <button  class="btn back-btn" data-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
        <h5 class="modal-title" id="nuevo_admin_Label"><i class="fas fa-user-plus modal-icon"></i> Nuevo Administrador</h5>
      </div>
      <div id="nuevo_admin_form" class="modal-body m-2">
      <form class="row g-3">
  <div class="col-md-12">
    <label for="correo" class="form-label">Correo</label>
    <input type="email" class="input-opcion-4" id="correo" name="correo" placeholder="example@example.com" required>
  </div>

  <div class="col-md-12">
    <label for="pass" class="form-label">Contraseña</label>
    <input type="password" class="input-opcion-4" id="pass" name="pass" placeholder="Contraseña" required>
  </div>

  <div class="col-md-12">
    <label for="pass_2" class="form-label">Confirmar Contraseña</label>
    <input type="password" class="input-opcion-4" id="pass_2" name="pass_2" placeholder="Contraseña" required>
    <p id="alert_pass" class="text-danger d-none">Las contraseñas no coinciden</p>
  </div>

  <div class="col-md-12">
    <label for="nivel" class="form-label">Nivel Administrativo</label>
     <div class="input-group">
     <select class="input-opcion-4" name="nivel" id="nivel">
        <option value="1">Administrador</option>
        <option value="2">Conductor</option>
    </select>
     </div>
  </div>
</form>

<div class="d-flex justify-content-center m-2 modal-body">
   <button class="card-btn" id="agregar_admin" data-dismiss="modal">Guardar</button>
   </div>
   
    </div>
  </div>
</div>
</div>

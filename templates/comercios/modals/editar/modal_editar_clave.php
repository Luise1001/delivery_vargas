<div>
<div class="modal fade" id="editar_clave" tabindex="-1" role="dialog"   aria-labelledby="editar_claveLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

    <div class="modal-header d-flex justify-content-center ml-2 mt-2 mr-2 mb-0">
    <button  class="btn back-btn" data-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
        <h5 class="modal-title" id="editar_clave_Label"><i class="fas fa-lock"></i> Cambiar Contraseña</h5>
      </div>
      <div id="edit_clave_form" class="modal-body m-2">
      <form class="row g-3">

  <div class="col-md-12">
    <label for="old_pass" class="form-label">Contraseña Actual<span class="text-danger">*</span></label>
     <div class="input-group">
       <input id="old_pass" name="old_pass" type="password" class="input-opcion-4">
     </div>

  </div>

  <div class="col-md-12">
    <label for="new_pass" class="form-label">Nueva Contraseña<span class="text-danger">*</span></label>
     <div class="input-group">
       <input id="new_pass" name="new_pass" type="password" class="input-opcion-4">
     </div>

  </div>

  <div class="col-md-12">
    <label for="repeat_pass" class="form-label">Repetir Contraseña<span class="text-danger">*</span></label>
     <div class="input-group">
       <input id="repeat_pass" name="repeat_pass" type="password" class="input-opcion-4">
       <p id="repeat_pass_alert" class="text-danger"></p>
     </div>

  </div>
</form>

<div class="d-flex justify-content-center m-2 modal-body">
   <button class="card-btn" id="modificar_clave"  data-dismiss="modal">Guardar</button>
   </div>
   
    </div>
  </div>
</div>
</div>

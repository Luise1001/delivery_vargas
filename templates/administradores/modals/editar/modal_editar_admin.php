<div>
<div class="modal fade" id="editar_admin" tabindex="-1" role="dialog"   aria-labelledby="editar_adminLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

    <div class="modal-header d-flex justify-content-center ml-2 mt-2 mr-2 mb-0">
    <button  class="btn back-btn" data-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
        <h5 class="modal-title" id="nuevo_admin_Label"><i class="fas fa-user-edit modal-icon"></i> Editar Administrador</h5>
      </div>
      <div id="edit_admin_form" class="modal-body m-2">
      <form class="row g-3">
      <div class="col-md-12">
    <label for="edit_admin_user_name" class="form-label">Nombre de Usuario<span class="text-danger">*</span> </label>
    <input type="text" class="input-opcion-4" id="edit_admin_user_name" name="" placeholder="Nombre de Usuario" required>
  </div>

  <div class="col-md-12">
    <label for="edit_admin_correo" class="form-label">Correo</label>
    <input type="email" class="input-opcion-4" id="edit_admin_correo" name="edit_admin_correo" placeholder="example@example.com" required>
  </div>


  <div class="col-md-12">
    <label for="edit_nivel" class="form-label">Nivel Administrativo</label>
     <div class="input-group">
     <select class="input-opcion-4" name="edit_nivel" id="edit_nivel">
        <option value="1">Administrador</option>
        <option value="2">Conductor</option>
        <option value="4">Administrador Grúas</option>
    </select>
     </div>
  </div>
</form>

<div class="d-flex justify-content-center m-2 modal-body">
   <button class="card-btn" id="editar_admin"  data-dismiss="modal">Guardar</button>
   </div>
   
    </div>
  </div>
</div>
</div>

<div>
<div class="modal fade" id="editar_usuario" tabindex="-1" role="dialog"   aria-labelledby="editar_usuarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

    <div class="modal-header d-flex justify-content-center ml-2 mt-2 mr-2 mb-0">
    <button  class="btn back-btn" data-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
        <h5 class="modal-title" id="editar_usuario_Label"><i class="fas fa-user-edit modal-icon"></i> Editar Usuario</h5>
      </div>
      <div id="edit_user_form" class="modal-body m-2">
      <form class="row g-3">

  <div class="col-md-12">
    <label for="edit_user_name" class="form-label">Nombre de Usuario<span class="text-danger">*</span></label>
     <div class="input-group">
       <input id="edit_user_name" name="edit_user_name" type="text" class="input-opcion-4">
     </div>
     <p id="user_name_alert" class="text-danger"></p>

  </div>
</form>

<div class="d-flex justify-content-center m-2 modal-body">
   <button class="card-btn" id="modificar_usuario"  data-dismiss="modal">Guardar</button>
   </div>
   
    </div>
  </div>
</div>
</div>

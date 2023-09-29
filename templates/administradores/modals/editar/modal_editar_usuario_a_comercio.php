<div>
<div class="modal fade" id="editar_usuario_a_comercio" tabindex="-1" role="dialog"   aria-labelledby="editar_usuario_a_comercioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

    <div class="modal-header d-flex justify-content-center ml-2 mt-2 mr-2 mb-0">
    <button  class="btn back-btn" data-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
        <h5 class="modal-title" id="nuevo_admin_Label"><i class="fas fa-user-edit modal-icon"></i> Editar Usuario</h5>
      </div>
      <div id="edit_cliente_form" class="modal-body m-2">
      <form class="row g-3">

  <div class="col-md-12">
    <label for="edit_nivel" class="form-label">Nivel Administrativo</label>
     <div class="input-group">
     <select class="input-opcion-4" name="edit_nivel_usuario" id="edit_nivel_usuario">
        <option value="0">Cliente</option>
        <option value="3">Comercio Afiliado</option>
    </select>
     </div>
  </div>
</form>

<div class="d-flex justify-content-center m-2 modal-body">
   <button class="card-btn" id="modificar_usuario_comercio"  data-dismiss="modal">Guardar</button>
   </div>
   
    </div>
  </div>
</div>
</div>

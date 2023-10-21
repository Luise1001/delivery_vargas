<div>
  <div class="modal fade" id="user_convert" tabindex="-1" role="dialog" aria-labelledby="user_convertLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content convertir-content">

        <div class="modal-header convertir-header">
          <h5 class="modal-title convertir-title" id="nuevo_admin_Label"><i class="fas fa-user-edit modal-icon"></i> Editar Usuario</h5>
        </div>
        <div id="edit_cliente_form" class="modal-body m-2">
          <form class="row g-3">

            <div class="col-md-12">
              <label for="edit_nivel" class="form-label">Nivel Administrativo</label>
              <div class="input-group">
                <select class="form-select convertir-select" name="edit_nivel_usuario" id="edit_nivel_usuario">
                  <option value="0">Cliente</option>
                  <option value="3">Comercio Afiliado</option>
                </select>
              </div>
            </div>
          </form>

          <div class="convertir-button-parent">
            <button class="convertir-button" id="convertir_usuario" data-dismiss="modal">Guardar</button>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
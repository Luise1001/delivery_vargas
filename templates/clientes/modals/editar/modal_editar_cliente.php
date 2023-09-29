<div>
<div class="modal fade" id="editar_cliente" name="editar_cliente" tabindex="-1" role="dialog"   aria-labelledby="editar_clienteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

    <div class="modal-header d-flex justify-content-center ml-2 mt-2 mr-2 mb-0">
    <button  class="btn back-btn" data-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
        <h5 class="modal-title" id="editar_cliente_Label"><i class="fas fa-user-edit"></i> Información Personal</h5>
      </div>
      <div id="editar_cliente_form" class="modal-body m-2">
      <form class="row g-3">
  <div class="col-md-6">
    <label for="editar_nombre_cliente" class="form-label">Nombres<span class="text-danger">*</span></label>
    <input type="text" class="input-opcion-4" id="editar_nombre_cliente" name="editar_nombre_cliente" placeholder="Nombres" required>
  </div>

  <div class="col-md-6">
    <label for="editar_apellido_cliente" class="form-label">Apellidos<span class="text-danger">*</span></label>
    <input type="text" class="input-opcion-4" id="editar_apellido_cliente" name="editar_apellido_cliente" placeholder="Apellidos" required>
  </div>

  <div class="col-md-7">
    <label for="editar_cedula_cliente" class="form-label">Cédula<span class="text-danger">*</span></label>
     <div class="input-group">
     <select class="input-opcion-2"  id="editar_tipo_id_cliente" name="editar_tipo_id_cliente">
        <option value="V">V</option>
        <option value="E">E</option>
        <option value="P">P</option>
    </select>
    <input type="number" class="input-opcion-2 w-50" id="editar_cedula_cliente" name="editar_cedula_cliente"  placeholder="123456789" required>
     </div>
  </div>

  <div class="col-md-5">
    <label for="editar_telefono_cliente" class="form-label">Teléfono<span class="text-danger">*</span></label>
    <input type="number" class="input-opcion-4" id="editar_telefono_cliente" name="editar_telefono_cliente" placeholder="123456789" required>
  </div>
 
</form>

<div class="d-flex justify-content-center m-2 modal-body">
   <button class="card-btn" id="modificar_cliente" data-dismiss="modal">Guardar Cambios</button>
   </div>
   
    </div>
  </div>
</div>
</div>
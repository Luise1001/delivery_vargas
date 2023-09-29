<div>
<div class="modal fade" id="editar_comercio" name="editar_comercio" tabindex="-1" role="dialog"   aria-labelledby="editar_comercioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

    <div class="modal-header d-flex justify-content-center ml-2 mt-2 mr-2 mb-0">
    <button  class="btn back-btn" data-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
        <h5 class="modal-title" id="editar_comercio_Label"><i class="fas fa-user-edit"></i> Información Personal</h5>
      </div>
      <div id="editar_comercio_form" class="modal-body m-2">
      <form class="row g-3">
  <div class="col-md-12">
    <label for="editar_nombre_comercio" class="form-label">Razón Social<span class="text-danger">*</span></label>
    <input type="text" class="input-opcion-4" id="editar_nombre_comercio" name="editar_nombre_comercio" placeholder="Nombres" required>
  </div>


  <div class="col-md-7">
    <label for="editar_rif_comercio" class="form-label">Rif<span class="text-danger">*</span></label>
     <div class="input-group">
     <select class="input-opcion-2"  id="editar_tipo_id_comercio" name="editar_tipo_id_comercio">
        <option value="J">J</option>
        <option value="G">G</option>
        <option value="V">V</option>
    </select>
    <input type="number" class="input-opcion-2 w-50" id="editar_rif_comercio" name="editar_rif_comercio"  placeholder="123456789" required>
     </div>
  </div>

  <div class="col-md-5">
    <label for="editar_telefono_comercio" class="form-label">Teléfono<span class="text-danger">*</span></label>
    <input type="number" class="input-opcion-4" id="editar_telefono_comercio" name="editar_telefono_comercio" placeholder="123456789" required>
  </div>
 
</form>

<div class="d-flex justify-content-center m-2 modal-body">
   <button class="card-btn" id="modificar_comercio" data-dismiss="modal">Guardar Cambios</button>
   </div>
   
    </div>
  </div>
</div>
</div>
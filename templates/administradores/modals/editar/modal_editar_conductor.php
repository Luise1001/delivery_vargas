<div>
<div class="modal fade" id="editar_conductor" name="editar_conductor" tabindex="-1" role="dialog"   aria-labelledby="editar_conductorLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

    <div class="modal-header d-flex justify-content-center ml-2 mt-2 mr-2 mb-0">
    <button  class="btn back-btn" data-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
        <h5 class="modal-title" id="editar_conductor_Label"><i class="fas fa-user-edit"></i> Editar Conductor</h5>
      </div>
      <div id="editar_conductor_form" class="modal-body m-2">
      <form class="row g-3">
  <div class="col-md-6">
    <label for="editar_nombre" class="form-label">Nombres</label>
    <input type="text" class="input-opcion-4" id="editar_nombre" name="editar_nombre" placeholder="Nombres" required>
  </div>

  <div class="col-md-6">
    <label for="editar_apellido" class="form-label">Apellidos</label>
    <input type="text" class="input-opcion-4" id="editar_apellido" name="editar_apellido" placeholder="Apellidos" required>
  </div>

  <div class="col-md-7">
    <label for="editar_cedula_conductor" class="form-label">Numero de Cedula</label>
     <div class="input-group">
     <select class="input-opcion-5"  id="editar_tipo_id" name="editar_tipo_id">
        <option value="V">V</option>
        <option value="E">E</option>
        <option value="P">P</option>
    </select>
    <input type="number" class="input-opcion-5 w-50" id="editar_cedula_conductor" name="editar_cedula_conductor"  placeholder="123456789" required>
     </div>
  </div>

  <div class="col-md-5">
    <label for="editar_telefono" class="form-label">Num. Telefono</label>
    <input type="number" class="input-opcion-4" id="editar_telefono" name="editar_telefono" placeholder="123456789" required>
  </div>

  <div class="col-md-12">
    <label for="editar_direccion" class="form-label">Direccion</label>
    <input type="text" class="input-opcion-4" id="editar_direccion" name="editar_direccion" placeholder="Direccion" required>
  </div>  

  <div class="col-md-12">
    <label for="editar_usuario_conductor" class="form-label">Correo</label>
    <input type="text" class="input-opcion-4" id="editar_usuario_conductor" name="editar_usuario_conductor" placeholder="example@example.com" required>
   <p id="aviso_3" class="text-danger"></p>
  </div>  
</form>

<div class="d-flex justify-content-center m-2 modal-body">
   <button class="card-btn" id="modificar_conductor" data-dismiss="modal">Guardar Cambios</button>
   </div>
   
    </div>
  </div>
</div>
</div>
<div>
<div class="modal fade" id="editar_datos_banco" tabindex="-1" role="dialog"   aria-labelledby="editar_datos_bancoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

    <div class="modal-header d-flex justify-content-center ml-2 mt-2 mr-2 mb-0">
    <button  class="btn back-btn" data-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
        <h5 class="modal-title" id="editar_datos_banco_Label">
        <i class="fas fa-money-check-alt"></i> Datos Bancarios</h5>
      </div>
      <div id="editar_datos_banco_form" class="modal-body m-2">
      <form method="post" class="row g-3">
        <input type="hidden" id="position" name="position">

<div hidden id="div_editar_pm">
<div class="col-md-6">
    <label for="edit_lista_banco_pm" class="form-label">Banco<span class="text-danger">*</span></label>
    <select class="input-opcion-4" id="edit_lista_banco_pm" name="edit_lista_banco_pm">
     <option id='main_option_pm' value="0">Seleccionar</option>
    </select>
  </div> 


  <div class="col-md-6">
    <label for="edit_rif_pm" class="form-label">Rif<span class="text-danger">*</span></label>
    <div class="input-group">
    <select class="input-opcion-2" id="edit_tipo_id_pm" name="edit_tipo_id_pm">
      <option value="J">J</option>
      <option value="G">G</option>
      <option value="V">V</option>
      <option value="P">P</option>
      <option value="E">E</option>
    </select>
    <input type="number" class="input-opcion-4 w-50" id="edit_rif_pm" name="edit_rif_pm"  placeholder="0" required>
    </div>

  </div>   

  <div class="col-md-12">
    <label for="edit_telefono_pm" class="form-label">Teléfono<span class="text-danger">*</span></label>
    <input type="text" class="input-opcion-4" id="edit_telefono_pm" name="edit_telefono_pm" placeholder="Teléfono" required>
  </div>

</div>

<div hidden id="div_editar_tr">
<div class="col-md-6">
    <label for="edit_lista_banco_tr" class="form-label">Banco<span class="text-danger">*</span></label>
    <select class="input-opcion-4" id="edit_lista_banco_tr" name="edit_lista_banco_tr">
     <option id="main_option_tr" value="0">Seleccionar</option>
    </select>
  </div> 


  <div class="col-md-6">
    <label for="edit_rif_tr" class="form-label">Rif<span class="text-danger">*</span></label>
    <div class="input-group">
    <select class="input-opcion-2" id="edit_tipo_id_tr" name="edit_tipo_id_tr">
      <option value="J">J</option>
      <option value="G">G</option>
      <option value="V">V</option>
      <option value="P">P</option>
      <option value="E">E</option>
    </select>
    <input type="number" class="input-opcion-4 w-50" id="edit_rif_tr" name="edit_rif_tr"  placeholder="0" required>
    </div>

  </div>   

  <div class="col-md-12">
    <label for="edit_nro_cuenta" class="form-label">Cuenta<span class="text-danger">*</span></label>
    <input type="number" class="input-opcion-4" id="edit_nro_cuenta" name="edit_nro_cuenta" placeholder="Número de Cuenta" required>
  </div> 

</div>

<div hidden id="div_editar_zelle">
<div class="col-md-6">
    <label for="edit_correo_zelle" class="form-label">Correo<span class="text-danger">*</span></label>
    <input type="email" class="input-opcion-4"   id="edit_correo_zelle" name="edit_correo_zelle"  placeholder="Ejemplo@ejemplo.com" required>
    <p id="edit_alert_correo_zelle" class="text-danger"></p>
  </div> 


  <div class="col-md-6">
    <label for="edit_titular_zelle" class="form-label">Titular<span class="text-danger">*</span></label>
    <input type="text" class="input-opcion-4" id="edit_titular_zelle" name="edit_titular_zelle"  placeholder="Nombre y Apellido" required>
  </div>   

</div>

</form>

<div class="d-flex justify-content-center m-2 modal-body">
   <button  class="card-btn" id="modificar_datos_banco" data-dismiss="modal">Guardar</button>
   </div>


   
    </div>
  </div>
</div>
</div>


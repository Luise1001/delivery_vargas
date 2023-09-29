<div>
<div class="modal fade" id="nuevo_datos_banco" tabindex="-1" role="dialog"   aria-labelledby="nuevo_datos_bancoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

    <div class="modal-header d-flex justify-content-center ml-2 mt-2 mr-2 mb-0">
    <button  class="btn back-btn" data-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
        <h5 class="modal-title" id="nuevo_datos_banco_Label">
        <i class="fas fa-money-check-alt"></i> Datos Bancarios</h5>
      </div>
      <div id="nuevo_datos_banco_form" class="modal-body m-2">
      <form method="post" class="row g-3">
        <label for="metodo_de_pago" class="form-label">Método de Pago</label>
        <select class="input-opcion-4" id="metodo_de_pago" name="metodo_de_pago" >
          <option value="1">Pago Movil</option>
          <option value="2">Transferencia</option>
          <option value="3">Zelle</option>
        </select>

<div id="div_pago_movil">
<div class="col-md-6">
    <label for="lista_banco_pm" class="form-label">Banco<span class="text-danger">*</span></label>
    <select class="input-opcion-4" id="lista_banco_pm" name="lista_banco_pm">
     <option value="0">Seleccionar</option>
    </select>
  </div> 


  <div class="col-md-6">
    <label for="rif_pm" class="form-label">Rif<span class="text-danger">*</span></label>
    <div class="input-group">
    <select class="input-opcion-2" id="tipo_id_pm" name="tipo_id_pm">
      <option value="J">J</option>
      <option value="G">G</option>
      <option value="V">V</option>
      <option value="P">P</option>
      <option value="E">E</option>
    </select>
    <input type="number" class="input-opcion-2 w-50" id="rif_pm" name="rif_pm"  placeholder="0" required>
    </div>

  </div>   

  <div class="col-md-12">
    <label for="telefono_pm" class="form-label">Teléfono<span class="text-danger">*</span></label>
    <input type="text" class="input-opcion-4" id="telefono_pm" name="telefono_pm" placeholder="Teléfono" required>
  </div>

</div>

<div hidden id="div_transferencia">
<div class="col-md-6">
    <label for="lista_banco_tr" class="form-label">Banco<span class="text-danger">*</span></label>
    <select class="input-opcion-4" id="lista_banco_tr" name="lista_banco_tr">
     <option value="0">Seleccionar</option>
    </select>
  </div> 


  <div class="col-md-6">
    <label for="rif_tr" class="form-label">Rif<span class="text-danger">*</span></label>
    <div class="input-group">
    <select class="input-opcion-2" id="tipo_id_tr" name="tipo_id_tr">
      <option value="J">J</option>
      <option value="G">G</option>
      <option value="V">V</option>
      <option value="P">P</option>
      <option value="E">E</option>
    </select>
    <input type="number" class="input-opcion-2 w-50" id="rif_tr" name="rif_tr"  placeholder="0" required>
    </div>

  </div>   

  <div class="col-md-12">
    <label for="nro_cuenta" class="form-label">Cuenta<span class="text-danger">*</span></label>
    <input type="number" class="input-opcion-4" id="nro_cuenta" name="nro_cuenta" placeholder="Número de Cuenta" required>
  </div> 

</div>

<div hidden id="div_zelle">
<div class="col-md-6">
    <label for="correo_zelle" class="form-label">Correo<span class="text-danger">*</span></label>
    <input type="email" class="input-opcion-4"   id="correo_zelle" name="correo_zelle"  placeholder="Ejemplo@ejemplo.com" required>
    <p id="alert_correo_zelle" class="text-danger"></p>
  </div> 


  <div class="col-md-6">
    <label for="titular_zelle" class="form-label">Titular<span class="text-danger">*</span></label>
    <input type="text" class="input-opcion-4" id="titular_zelle" name="titular_zelle"  placeholder="Nombre y Apellido" required>
  </div>   

</div>

</form>

<div class="d-flex justify-content-center m-2 modal-body">
   <button  class="card-btn" id="agregar_datos_banco" data-dismiss="modal">Guardar</button>
   </div>


   
    </div>
  </div>
</div>
</div>


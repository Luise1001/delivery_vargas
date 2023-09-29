<div>
<div class='modal fade' id='datos_bancarios' tabindex='-1' role='dialog'   aria-labelledby='datos_bancarios_Label' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content' style="padding: 10px;">

    <div class='modal-header d-flex justify-content-center ml-2 mt-2 mr-2 mb-0'>
    <button  class="btn back-btn" data-dismiss="modal"><i class="fas fa-arrow-left"></i></button>
    <h5 class="modal-title"><i class="fas fa-comment-dollar"></i> Completar Pedido</h5> 
      </div>

      <div id="completar_pedido_form">

        <div id="metodos_de_pago" class='m-2'>
          <label class="form-label" for="metodos_pago">Métodos de Pago<span class="text-danger">*</span> </label>
            <select class="input-opcion-4" id="metodos_pago" name="metodos_pago">
                
            </select>

        </div>

        <div class="datos-bancarios">
  
        </div>

        <div class="direccion-salida">
           <input id="direccion_salida" name="direccion_salida" type="text" class='input-fs' >

        </div>

        <div class="direccion-envio">
          <label class="form-label" for="direccion_envio">Mi Dirección<span class="text-danger">*</span> </label>
          <select class='input-opcion-4' id="direccion_envio" name="direccion_envio">

          </select>

        </div>

        <div style="height: 200px !important; margin-top: 10px; " id="googleMap"></div>
        
        <div id="output"></div>

        <div class='ref_btn'>
          <button id="enviar_pedido" data-dismiss="modal" class='btn card-btn'><i class='fas fa-paper-plane fa-2x'></i></button>
       </div>

      </div>

  </div>
</div>
</div>


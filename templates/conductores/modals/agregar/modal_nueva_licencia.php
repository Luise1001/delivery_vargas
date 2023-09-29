<div>
<div class="modal fade" id="nueva_licencia" tabindex="-1" role="dialog"   aria-labelledby="nueva_licencia_Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

    <div class="modal-header d-flex justify-content-center ml-2 mt-2 mr-2 mb-0">
    <button  class="btn back-btn" data-dismiss="modal"><i class="fas fa-arrow-left fa-2x"></i></button>
        <h5 class="modal-title" id="nueva_licencia_Label"><i class="fas fa-id-card fa-2x"></i> Agregar Licencia</h5>
      </div>
      <div id="nueva_licencia_form" class="modal-body m-2">
      <form class="row g-3" action="../functions/nueva_licencia.php" method="post" enctype="multipart/form-data">
  <div class="col-md-12">
    <input type="file" class="form-control" id="licencia" name="licencia"  required>
  </div>
  
  <div class="d-flex justify-content-center m-2 modal-body">
   <button type="submit" class="btn"  id="agregar_licencia"  >Guardar</button>
   </div>
</form>

    </div>
  </div>
</div>
</div>

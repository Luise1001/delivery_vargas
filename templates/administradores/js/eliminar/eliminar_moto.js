$(document).on('click', '.eliminar-moto', function(e)
{   
    let id_moto = e.currentTarget.attributes.moto.value;
    
    swal('Seguro que desea eliminar','', 'warning',
    {
      buttons: {
        cancel: 'Cancelar',
        Confirmar: true,
      },
    })
    .then((value) => 
    {
      switch (value) {
     
        case "Confirmar":
          eliminar_moto(id_moto);
          break;
          
        default: false;
      }
    });
})

function eliminar_moto(id_moto)
{ 
    let funcion = 'eliminar_moto';

    $.ajax
    ({
       url: '../../server/functions/eliminar.php',
       type: 'POST',
       dataType: 'json',
       data: 
       {
          funcion: funcion,
          id_moto: id_moto
       }
  
    })
    .done(function(res)
    {
      let titulo = res.titulo;
      let cuerpo = res.cuerpo;
      let accion = res.accion;

      if(accion === 'success')
      {
         lista_de_motos();
      }
      else
      {
         swal(titulo, cuerpo, accion);
      } 
    })
    .fail(function(err)
    {
      console.log(err);
    })
}
$(document).on('click', '.eliminar-conductor', function(e)
{   
    let id_conductor = e.currentTarget.attributes.conductor.value;

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
          eliminar_conductor(id_conductor);
          break;
          
        default: false;
      }
    });
})

function eliminar_conductor(id_conductor)
{
    let funcion = 'eliminar_conductor';

    $.ajax
    ({
       url: '../../server/functions/eliminar.php',
       type: 'POST',
       dataType: 'json',
       data: 
       {
          funcion: funcion,
          id_conductor: id_conductor
       }
  
    })
    .done(function(res)
    {
      let titulo = res.titulo;
      let cuerpo = res.cuerpo;
      let accion = res.accion;

      if(accion === 'success')
      {
        lista_de_conductores();
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
$(document).on('click', '#eliminar_direccion', function(data)
{
     let id_direccion = data.currentTarget.attributes.direccion.value;

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
             eliminar_direccion(id_direccion);
           break;
           
         default: false;
       }
     });
})

function eliminar_direccion(id_direccion)
{
    let funcion = 'eliminar_direccion';
    $.ajax
    ({
       url: '../../server/functions/eliminar.php',
       type: 'POST',
       dataType: 'json',
       data: 
       {
         funcion : funcion,
         id_direccion: id_direccion
      }
  
    })
    .done(function(res)
    {
      let titulo = res.titulo;
      let cuerpo = res.cuerpo;
      let accion = res.accion;

      if(accion === 'success')
      {
         mis_direcciones();
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
$(document).on('click', '.eliminar-direccion', function(data)
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
    let page = 'eliminar_direccion';
    $.ajax
    ({
       url: '../../functions/eliminar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         page : page,
         id_direccion: id_direccion
      }
  
    })
    .done(function(res)
    {
     lista_de_direcciones();
  
    })
    .fail(function(err)
    {
      console.log(err);
    })
}
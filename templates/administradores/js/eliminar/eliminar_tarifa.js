$(document).on('click', '#eliminar_tarifa_btn', function(data)
{   
    id_tarifa = data.target.parentNode.attributes.tarifa.value;

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
          eliminar_tarifa();
          break;
          
        default: false;
      }
    });
})

function eliminar_tarifa()
{ 
    let funcion = 'eliminar_tarifa';

    $.ajax
    ({
       url: '../../server/functions/eliminar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
          funcion: funcion,
          id_tarifa: id_tarifa
       }
  
    })
    .done(function(res)
    {
      lista_de_tarifas(); 
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
}
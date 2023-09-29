$(document).on('click', '#eliminar_conductor_btn', function(data)
{   
    id_conductor = data.target.parentNode.attributes.conductor.value;

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
          eliminar_conductor();
          break;
          
        default: false;
      }
    });
})

function eliminar_conductor()
{
    let page = 'eliminar_conductor';

    $.ajax
    ({
       url: '../../functions/eliminar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
          page: page,
          id_conductor: id_conductor
       }
  
    })
    .done(function(res)
    {
      lista_de_conductores(); 
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
}
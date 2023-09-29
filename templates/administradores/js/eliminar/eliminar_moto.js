$(document).on('click', '#eliminar_moto_btn', function(data)
{   
    id_moto = data.target.parentNode.attributes.moto.value;
    
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
          eliminar_moto();
          break;
          
        default: false;
      }
    });
})

function eliminar_moto()
{ 
    let page = 'eliminar_moto';

    $.ajax
    ({
       url: '../../functions/eliminar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
          page: page,
          id_moto: id_moto
       }
  
    })
    .done(function(res)
    {
      lista_de_motos(); 
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
}
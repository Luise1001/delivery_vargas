$(document).on('click', '#eliminar_cliente_btn', function(data)
{   
    id_cliente = data.target.parentNode.attributes.cliente.value;

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
          eliminar_cliente();
          break;
          
        default: false;
      }
    });
})

function eliminar_cliente()
{
    let page = 'eliminar_cliente';

    $.ajax
    ({
       url: '../../functions/eliminar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
          page: page,
          id_cliente: id_cliente
       }
  
    })
    .done(function(res)
    {
      lista_de_clientes(); 
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
}
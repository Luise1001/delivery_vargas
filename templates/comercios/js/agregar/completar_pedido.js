$(document).on('click', '.anular-pedido', function(data)
{ 
  nro_pedido = data.currentTarget.attributes.pedido.value;
  
  swal('Seguro que desea Anular','', 'warning',
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
        anular_pedido(nro_pedido);
        break;
        
      default: false;
    }
  });
})


function anular_pedido(nro_pedido)
{
  page = 'anular_pedido';
 
  $.ajax
  ({
     url: '../../functions/editar.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       page : page,
       nro_pedido: nro_pedido
    }

  })
  .done(function(res)
  { 
    lista_de_pedidos();
  })
  .fail(function()
  {
    console.log("error ejecutando Ajax");
  })
}

$(document).on('click', '.retirar-pedido', function(data)
{
    retirar_pedido(data);
})

function retirar_pedido(data)
{
    let page = 'retirar_pedido';
    let nro_pedido = data.currentTarget.attributes.pedido.value;

    $.ajax
    ({
       url: '../../functions/agregar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         page : page,
         nro_pedido: nro_pedido
      }
  
    })
    .done(function(res)
    {
      lista_de_pedidos();
    })
    .fail(function(err)
    {
      console.log(err);
    })
}
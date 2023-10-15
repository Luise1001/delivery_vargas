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
  funcion = 'anular_pedido';
 
  $.ajax
  ({
     url: '../../server/functions/editar.php',
     type: 'POST',
     dataType: 'json',
     data: 
     {
       funcion : funcion,
       nro_pedido: nro_pedido
    }

  })
  .done(function(res)
  { 
     let titulo = res.titulo;
     let cuerpo = res.cuerpo;
     let accion = res.accion;

     if(accion === 'success')
     {
        mis_pedidos();
     }
     else
     {
        swal(titulo, cuerpo, accion);
     }
  })
  .fail(function()
  {
    console.log("error ejecutando Ajax");
  })
}
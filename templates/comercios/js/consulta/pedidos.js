$(document).ready(mis_pedidos());

function mis_pedidos()
{ 
   funcion = 'mis_pedidos';
 
  $.ajax
  ({
     url: '../../server/functions/consultas.php',
     type: 'POST',
     dataType: 'json',
     data: 
     {
       funcion : funcion
    }

  })
  .done(function(res)
  { 
    $('.titulo-app').html(res.titulo);
    $('#pendientes').html(res.pendientes);
    $('#completados').html(res.completados);
    $('#anulados').html(res.anulados);

  })
  .fail(function(err)
  {
    console.log(err);
  })
}

$(document).on('click', '.retirar-pedido', function(e)
{
   retirar_pedido(e);
})

function retirar_pedido(data)
{
    let funcion = 'retirar_pedido';
    let nro_pedido = data.currentTarget.attributes.pedido.value;

    $.ajax
    ({
       url: '../../server/functions/agregar.php',
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
    .fail(function(err)
    {
      console.log(err);
    })
}

$(document).on('click', '.anular-pedido', function(e)
{ 
  nro_pedido = e.currentTarget.attributes.pedido.value;
  
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
  .fail(function(err)
  {
    console.log(err);
  })
}
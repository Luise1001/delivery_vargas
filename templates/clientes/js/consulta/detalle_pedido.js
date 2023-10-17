$(document).ready(detalle_pedido());

function detalle_pedido()
{ 
  const parametros = window.location.search;
  const variables = new URLSearchParams(parametros);
  let nro_pedido = variables.get('pedido');
   funcion = 'detalle_pedido';
 
  $.ajax
  ({
     url: '../../server/functions/consultas.php',
     type: 'POST',
     dataType: 'json',
     data: 
     {
       funcion : funcion,
       nro_pedido: nro_pedido
    }

  })
  .done(function(res)
  {console.log(res)
    $('.titulo-app').html(res.titulo);
    $('.detalle-pedido').html(res.contenido);

  })
  .fail(function(err)
  {
    console.log(err.responseText);
  })
}


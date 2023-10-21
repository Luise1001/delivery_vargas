$(document).ready(detalle_envio());

function detalle_envio()
{ 
  const parametros = window.location.search;
  const variables = new URLSearchParams(parametros);
  let nro_pedido = variables.get('pedido');
  let id_envio = variables.get('envio');
   funcion = 'detalle_envio';
 
  $.ajax
  ({
     url: '../../server/functions/consultas.php',
     type: 'POST',
     dataType: 'json',
     data: 
     {
       funcion : funcion,
       nro_pedido: nro_pedido,
       id_envio: id_envio
    }

  })
  .done(function(res)
  {
    $('.titulo-app').html(res.titulo);
    $('.detalle-envio').html(res.contenido);

  })
  .fail(function(err)
  {
    console.log(err.responseText);
  })
}


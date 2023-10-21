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

$(document).on('click', '.aceptar-envio', function(data)
{
   aceptar_envio(data);
})

function aceptar_envio(data)
{
  let nro_pedido = data.target.attributes.pedido.value;

  funcion = 'aceptar_envio';
 
  $.ajax
  ({
     url: '../../server/functions/editar.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       funcion : funcion,
       nro_pedido: nro_pedido
    }

  })
  .done(function(res)
  {
     window.location.href="mis_envios";

  })
  .fail(function(err)
  {
    console.log(err);
  })
}

$(document).on('click', '.ruta-completada', function(data)
{
    ruta_completada(data);
});

function ruta_completada(data)
{
    let nro_pedido = data.target.attributes.pedido.value;
    
    let funcion = 'ruta_completada';
 
    $.ajax
    ({
       url: '../../server/functions/editar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         funcion : funcion,
         nro_pedido: nro_pedido
      }
  
    })
    .done(function(res)
    {
      window.location.href = "../inicio/inicio";
    })
    .fail(function(err)
    {
      console.log(err);
    })
}


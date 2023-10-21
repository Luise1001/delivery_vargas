$(document).ready(mis_envios());

function mis_envios()
{ 
   funcion = 'mis_envios';
 
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
    $('#transito').html(res.transito);
    $('#completados').html(res.completados);

  })
  .fail(function(err)
  {
    console.log(err);
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
    mis_envios();

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





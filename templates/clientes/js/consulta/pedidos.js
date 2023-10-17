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
    console.log(err.responseText);
  })
}


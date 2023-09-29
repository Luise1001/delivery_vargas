$(document).ready(lista_de_pedidos());

function lista_de_pedidos()
{ 
   page = 'mis_pedidos';
 
  $.ajax
  ({
     url: '../../functions/consultas.php',
     type: 'POST',
     dataType: 'json',
     data: 
     {
       page : page
    }

  })
  .done(function(res)
  {
    $('#pendientes').html(res.pendientes);
    $('#completados').html(res.completados);
    $('#anulados').html(res.anulados);

  })
  .fail(function(err)
  {
    console.log(err);
  })
}


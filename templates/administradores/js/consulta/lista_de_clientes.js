$(document).ready(lista_de_clientes());

function lista_de_clientes()
{
  funcion = 'lista_de_clientes';
 
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
    $('.lista-de-clientes').html(res.clientes);

  })
  .fail(function(err)
  {
    console.log(err);
  })
}


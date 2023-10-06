$(document).ready(lista_de_clientes());

function lista_de_clientes()
{
  funcion = 'lista_de_clientes';
 
  $.ajax
  ({
     url: '../../server/functions/consultas.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       funcion : funcion
    }

  })
  .done(function(res)
  {
    $('.lista-de-clientes').html(res);

  })
  .fail(function()
  {
    console.log("error ejecutando Ajax");
  })
}


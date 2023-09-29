$(document).ready(lista_de_clientes());

function lista_de_clientes()
{
  page = 'lista_de_clientes';
 
  $.ajax
  ({
     url: '../../functions/consultas.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       page : page
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


$(document).ready(lista_de_comercios());

function lista_de_comercios()
{
  funcion = 'lista_de_comercios';
 
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
    $('.lista-de-comercios').html(res);

  })
  .fail(function()
  {
    console.log("error ejecutando Ajax");
  })
}


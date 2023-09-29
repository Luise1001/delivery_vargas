$(document).ready(lista_de_comercios());

function lista_de_comercios()
{
  page = 'lista_de_comercios';
 
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
    $('.lista-de-comercios').html(res);

  })
  .fail(function()
  {
    console.log("error ejecutando Ajax");
  })
}


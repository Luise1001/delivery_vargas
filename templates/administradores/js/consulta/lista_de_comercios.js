$(document).ready(lista_de_comercios());

function lista_de_comercios()
{
  funcion = 'lista_de_comercios';
 
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
    $('.lista-de-comercios').html(res.comercios);

  })
  .fail(function(err)
  {
    console.log(err);
  })
}


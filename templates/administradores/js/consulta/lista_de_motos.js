$(document).ready(lista_de_motos());

function lista_de_motos()
{
  funcion = 'lista_de_motos';
 
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
    $('.lista-de-motos').html(res.motos);
  })
  .fail(function(err)
  {
    console.log(err);
  })
}

$(document).ready(lista_de_conductores());

function lista_de_conductores()
{
  funcion = 'conductores';
 
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
    $('.header-icons').html(res.botones);
    $('.lista-de-conductores').html(res.conductores);

  })
  .fail(function(err)
  {
    console.log(err);
  })
}

$(document).ready(lista_de_usuarios());

function lista_de_usuarios()
{
  funcion = 'lista_de_usuarios';
 
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
    $('#comercios').html(res.comercios);
    $('#clientes').html(res.clientes);
  })
  .fail(function(err)
  {
    console.log(err);
  })
}


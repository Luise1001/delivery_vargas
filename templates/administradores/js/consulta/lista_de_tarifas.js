$(document).ready(lista_de_tarifas());

function lista_de_tarifas()
{
  let funcion = 'lista_de_tarifas';
 
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
    $('.lista-de-tarifas').html(res.tarifas);

  })
  .fail(function(err)
  {
    console.log(err);
  })
}

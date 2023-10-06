$(document).ready(lista_de_tarifas());

function lista_de_tarifas()
{
  funcion = 'lista_de_tarifas';
 
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
    $('.header-icons').html(res.botones);
    $('.lista-de-tarifas').html(res.tarifas);

  })
  .fail(function()
  {
    console.log("error ejecutando Ajax");
  })
}

$(document).ready(lista_de_tarifas());

function lista_de_tarifas()
{
  page = 'lista_de_tarifas';
 
  $.ajax
  ({
     url: '../../functions/consultas.php',
     type: 'POST',
     dataType: 'json',
     data: 
     {
       page : page
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

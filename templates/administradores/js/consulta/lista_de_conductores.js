$(document).ready(lista_de_conductores());

function lista_de_conductores()
{
  page = 'conductores';
 
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
    $('.lista-de-conductores').html(res.conductores);

  })
  .fail(function(err)
  {
    console.log(err);
  })
}

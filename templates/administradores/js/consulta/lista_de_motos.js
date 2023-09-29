$(document).ready(lista_de_motos());

function lista_de_motos()
{
  page = 'lista_de_motos';
 
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
    $('.lista-de-motos').html(res.motos);

  })
  .fail(function(err)
  {
    console.log(err);
  })
}

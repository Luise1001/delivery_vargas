$(document).ready(lista_de_usuarios());

function lista_de_usuarios()
{
  page = 'lista_de_usuarios';
 
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
    $('#comercios').html(res.comercios);
    $('#clientes').html(res.clientes);

  })
  .fail(function(err)
  {
    console.log(err);
  })
}


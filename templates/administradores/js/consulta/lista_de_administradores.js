$(document).ready(lista_de_administradores());

function lista_de_administradores()
{
  page = 'administradores';
 
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
      $('#admins').html(res.administradores);
      $('#conductores').html(res.conductores);

  })
  .fail(function(err)
  {
    console.log(err);
  })
}

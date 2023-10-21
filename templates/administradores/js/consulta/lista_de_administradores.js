$(document).ready(lista_de_administradores());

function lista_de_administradores()
{
  funcion = 'administradores';
 
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
      $('.titulo-app').html(res.titulo);
      $('#admins').html(res.administradores);
      $('#conductores').html(res.conductores);
  })
  .fail(function(err)
  {
    console.log(err);
  })
}

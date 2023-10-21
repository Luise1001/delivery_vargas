$(document).ready(mis_direcciones());

function mis_direcciones()
{ 
   funcion = 'mis_direcciones';
 
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
    $('.my-directions').html(res.direcciones);

  })
  .fail(function(err)
  {
    console.log(err);
  })
}



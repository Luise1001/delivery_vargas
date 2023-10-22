$(document).ready(mis_productos());

function mis_productos()
{ 
   funcion = 'mis_productos';
 
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
    $('.header-icons').html(res.botones);
    $('.my-products').html(res.productos);

  })
  .fail(function(err)
  {
    console.log(err);
  })
}




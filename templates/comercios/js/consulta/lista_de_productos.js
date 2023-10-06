$(document).ready(lista_de_productos());

function lista_de_productos()
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
    $('.header-icons').html(res.botones);
    $('.catalogo-productos').html(res.productos);

  })
  .fail(function(err)
  {
    console.log(err);
  })
}




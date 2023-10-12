$(document).ready(categorias());

function categorias()
{ 
   funcion = 'categorias';
 
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
    $('.categories').html(res.categorias);
  })
  .fail(function(err)
  {
    console.log(err);
  })
}

$(document).ready(productos_nuevos);

function productos_nuevos()
{
  funcion = 'productos_nuevos';
 
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
    $('.new-products').html(res.productos);
  })
  .fail(function(err)
  {
    console.log(err);
  })
}


$(document).ready(categorias());

function categorias()
{ 
   let funcion = 'categorias';
 
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

$(document).ready(SliderAds());

function SliderAds()
{ 
   funcion = 'ads';
 
  $.ajax
  ({
     url: '../../server/functions/consultas.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       funcion : funcion
    }

  })
  .done(function(res)
  {
    $('#publicidad').html(res);
  })
  .fail(function(err)
  {
    console.log(err);
  })
}

$(document).ready(productos_nuevos);

function productos_nuevos()
{
  let funcion = 'productos_nuevos';
 
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

$(document).on('keyup','#buscador', function()
{
  let buscar = $('#buscador').val();
  
  buscar_producto(buscar);
})

function buscar_producto(buscar)
{
  let funcion = 'buscar_producto';
 
  $.ajax
  ({
     url: '../../server/functions/consultas.php',
     type: 'POST',
     dataType: 'json',
     data: 
     {
       funcion : funcion,
       buscar: buscar
    }

  })
  .done(function(res)
  {
    $('.search-result').html(res.productos);
  })
  .fail(function(err)
  {
    console.log(err);
  })
}


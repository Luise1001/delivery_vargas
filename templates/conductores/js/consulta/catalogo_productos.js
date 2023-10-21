$(document).ready(catalogo_productos());

function catalogo_productos()
{ 
  const parametros = window.location.search;
  const variables = new URLSearchParams(parametros);
  let id_comercio = variables.get('comercio');
  let funcion = 'catalogo_productos';


  $.ajax
  ({
     url: '../../server/functions/consultas.php',
     type: 'POST',
     dataType: 'json',
     data: 
     {
       funcion : funcion,
       id_comercio: id_comercio
    }

  })
  .done(function(res)
  {
    $('.titulo-app').html(res.titulo);
    $('.productos').html(res.productos);

  })
  .fail(function(err)
  {
    console.log(err);
  })
}

$(document).on('keyup','#buscador', function()
{
  let buscar = $('#buscador').val();

  if(buscar != '')
  {
    buscar_producto(buscar);
  }
  else
  {
     catalogo_productos();
  }
})

function buscar_producto(buscar)
{
  const parametros = window.location.search;
  const variables = new URLSearchParams(parametros);
  let id_comercio = variables.get('comercio');

  let funcion = 'buscar_producto';
 
  $.ajax
  ({
     url: '../../server/functions/consultas.php',
     type: 'POST',
     dataType: 'json',
     data: 
     {
       funcion : funcion,
       buscar: buscar,
       id_comercio: id_comercio
    }

  })
  .done(function(res)
  {
    $('.productos').html(res.productos);
  })
  .fail(function(err)
  {
    console.log(err);
  })
}




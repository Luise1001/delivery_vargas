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




$(document).ready(lista_de_categorias());

function lista_de_categorias()
{ 
   funcion = 'comercios_by_categoria';
 
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
    

  })
  .fail(function(err)
  {
    console.log(err);
  })
}

$(document).on('click', '#ver_catalogo', function(data)
{
  let id_categoria = data.currentTarget.attributes.categoria.value;
  let id_comercio = data.currentTarget.attributes.comercio.value;

  window.location.href = "catalogo_productos.php?categoria=" + id_categoria + "&comercio=" + id_comercio;
})




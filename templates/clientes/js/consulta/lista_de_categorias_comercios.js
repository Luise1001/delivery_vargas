$(document).ready(lista_de_categorias());

function lista_de_categorias()
{ 
   page = 'comercios_by_categoria';
 
  $.ajax
  ({
     url: '../../functions/consultas.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       page : page
    }

  })
  .done(function(res)
  {
    $('.categorias-de-comercios').html(res);

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




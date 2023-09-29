$(document).on('click', '.ver_producto', function(data)
{
    
    let id_producto = data.currentTarget.attributes.producto.value;
    let id_usuario_comercio = data.currentTarget.attributes.usuariocomercio.value;
  
    full_descripcion(id_producto, id_usuario_comercio);
})

function full_descripcion(id_producto, id_usuario_comercio)
{ 
   page = 'full_descripcion';
 
  $.ajax
  ({
     url: '../../functions/consultas.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       page : page,
       id_producto : id_producto,
       id_usuario_comercio: id_usuario_comercio
    }

  })
  .done(function(res)
  {
    $('#full_descripcion_form').html(res);

  })
  .fail(function()
  {
    console.log("error ejecutando Ajax");
  })
}




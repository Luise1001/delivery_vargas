function AddToCar(id_comercio, id_producto, cantidad)
{
  let funcion = 'agregar_al_carrito';

  $.ajax
  ({
     url: '../../server/functions/agregar.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       funcion : funcion,
       id_comercio: id_comercio,
       id_producto: id_producto,
       cantidad: cantidad
    }

  })
  .done(function(res)
  {
    cantidad_productos_carrito();
  })
  .fail(function(err)
  {
    console.log(err);
  })
}

function cantidad_productos_carrito()
{
    let funcion = 'cantidad_productos_carrito';
    let id_categoria = $('#categoria').val();
    let id_comercio = $('#comercio').val();

    $.ajax
    ({
       url: '../../server/functions/consultas.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         funcion : funcion,
         id_categoria: id_categoria,
         id_comercio: id_comercio
      }
  
    })
    .done(function(res)
    { 
        if(res > 0)
        {
            $('.car-badge').removeClass('visually-hidden');
            $('.car-badge').html(res);
        }
        else
        {
            $('.car-badge').addClass('visually-hidden');
        }

    })
    .fail(function(err)
    {
      console.log(err);
    })
}
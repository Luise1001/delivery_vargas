function AddToCar(id_comercio, id_producto, cantidad)
{
  let page = 'agregar_al_carrito';

  $.ajax
  ({
     url: '../../functions/agregar.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       page : page,
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
    let page = 'cantidad_productos_carrito';
    let id_categoria = $('#categoria').val();
    let id_comercio = $('#comercio').val();

    $.ajax
    ({
       url: '../../functions/consultas.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         page : page,
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
$(document).ready(cantidad_productos_carrito());

$(document).on('click', '.mi-carrito', function()
{
   ver_mi_carrito();
})

function ver_mi_carrito()
{
    let page = 'ver_mi_carrito';
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
       $('#ver_carrito_form').html(res);
    })
    .fail(function(err)
    {
      console.log(err);
    })
}

$(document).on('click', '#restar_car', function(data)
{
   let id_producto = data.currentTarget.attributes.producto.value;
   let codigo = data.currentTarget.attributes.codigo.value;
   let id_comercio = data.currentTarget.attributes.comercio.value;
   let span = SpanQuantity(codigo);
   let cantidad = LessButtons(codigo, span);
   AddToCar(id_comercio, id_producto, cantidad);
   ver_mi_carrito();
})

$(document).on('click', '#sumar_car', function(data)
{
   let id_producto = data.currentTarget.attributes.producto.value;
   let codigo = data.currentTarget.attributes.codigo.value;
   let id_comercio = data.currentTarget.attributes.comercio.value;
   let span = SpanQuantity(codigo);
   let cantidad = PlusButtons(codigo, span);
   AddToCar(id_comercio, id_producto, cantidad);
   ver_mi_carrito();
})


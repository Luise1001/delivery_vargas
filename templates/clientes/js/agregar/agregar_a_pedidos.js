$(document).on('click', '#agregar_pedido', function(data)
{
    let id_cliente = data.currentTarget.attributes.cliente.value;
    let id_comercio = data.currentTarget.attributes.comercio.value;

    nuevo_pedido(id_cliente, id_comercio);
})

function nuevo_pedido(id_cliente, id_comercio)
{
    let funcion = 'nuevo_pedido';

    $.ajax
    ({
       url: '../../server/functions/agregar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         funcion : funcion,
         id_cliente: id_cliente,
         id_comercio: id_comercio
      }
  
    })
    .done(function(res)
    {
      window.location.href = '../clientes/lista_de_pedidos';
    })
    .fail(function(err)
    {
      console.log(err);
    })
}
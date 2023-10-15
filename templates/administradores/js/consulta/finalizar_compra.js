$(document).ready(finalizar_compra());

function finalizar_compra() {
    const parametros = window.location.search;
    const variables = new URLSearchParams(parametros);
    let id_cliente = variables.get('cliente');
    let id_comercio = variables.get('comercio');
    let nro_pedido = variables.get('pedido');
    let funcion = 'finalizar_compra';
    $.ajax
        ({
            url: '../../server/functions/consultas.php',
            type: 'POST',
            dataType: 'json',
            data:
            {
                funcion: funcion,
                id_cliente: id_cliente,
                id_comercio: id_comercio,
                nro_pedido: nro_pedido
            }

        })
        .done(function (res) {
          console.log(res)
          $('.titulo-app').html(res.titulo);
          $('.metodos-de-pago').html(res.metodos);
          $('.datos-bancarios').html(res.datos);
          $('.direccion-salida').html(res.salida);
          $('.direccion-destino').html(res.destino);
        })
        .fail(function (err) {
            console.log(err);
        })
}
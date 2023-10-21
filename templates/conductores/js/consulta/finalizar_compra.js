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
            $('.titulo-app').html(res.titulo);
            $('#metodos').html(res.metodos);
            $('.monto-total').html(res.montos);
            $('#from').html(res.salida);
            $('#to').html(res.destino);
        })
        .fail(function (err) {
            console.log(err);
        })
}

$(document).ready(datos_bancarios());

$(document).on('change', '#metodos', function () {
    datos_bancarios();
})

function datos_bancarios() {
    const parametros = window.location.search;
    const variables = new URLSearchParams(parametros);
    let id_comercio = variables.get('comercio');
    let metodo = $('#metodos').val();

    let funcion = 'datos_bancarios';
    $.ajax
        ({
            url: '../../server/functions/consultas.php',
            type: 'POST',
            dataType: 'json',
            data:
            {
                funcion: funcion,
                id_comercio: id_comercio,
                metodo: metodo
            }

        })
        .done(function (res) {

            if (res.datos != '') {
                $('.container-ref').attr('hidden', false);
            }
            else {
                $('.container-ref').attr('hidden', true);
            }

            $('.datos-bancarios').html(res.datos);

        })
        .fail(function (err) {
            console.log(err);
        })
}

$(document).on('click', '#enviar_pedido', async function () {
    let metodo = $('#metodos').val();

    if (metodo === '1' || metodo === '2') {

        $('#referencia').val(0);
        confirmar_pedido();
    }
    else {
        let referencia = $('#referencia').val();

        if (!referencia) {
            swal('ATENCIÓN', 'Debe Ingresar El Número de Referencia', 'warning');
        }
        else {
            confirmar_pedido();
        }
    }
})

async function confirmar_pedido() {

    const parametros = window.location.search;
    const variables = new URLSearchParams(parametros);
    let nro_pedido = variables.get('pedido');
    let id_cliente = variables.get('cliente');
    let id_comercio = variables.get('comercio');
    let metodo_pago = $('#metodos').val();
    let referencia = $('#referencia').val();
    let salida = $('#from').val();
    let destino = $('#to').val();
    let detalle_ruta = await Trazar_ruta();
    let ruta = detalle_ruta.ruta;
    let tiempo = detalle_ruta.tiempo;
    let distancia = detalle_ruta.distancia;

    let funcion = 'confirmar_pedido';

    $.ajax
        ({
            url: '../../server/functions/agregar.php',
            type: 'POST',
            dataType: 'json',
            data:
            {
                funcion: funcion,
                nro_pedido: nro_pedido,
                id_cliente: id_cliente,
                id_comercio: id_comercio,
                metodo_pago: metodo_pago,
                referencia: referencia,
                salida: salida,
                destino: destino,
                tiempo: tiempo,
                distancia: distancia,
                ruta: ruta
            }

        })
        .done(function (res) {
            let titulo = res.titulo;
            let cuerpo = res.cuerpo;
            let accion = res.accion;

            if(accion === 'success')
            {
                window.location.href = 'mis_pedidos';
            }
            else
            {
                swal(titulo, cuerpo, accion);
            }
        })
        .fail(function (err) {
            console.log(err);
        })
}
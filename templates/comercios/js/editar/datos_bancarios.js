$(document).ready(IdentifyMethod);

function IdentifyMethod() {
    const parametros = window.location.search;
    const variables = new URLSearchParams(parametros);
    let metodo = variables.get('tipo');
    let id_pago = variables.get('id');

    switch (metodo) {
        case 'pm':
            ver_pm(id_pago);

            break;
        case 'tr':
            ver_tr(id_pago);

            break;
        case 'zl':
            ver_zl(id_pago);

            break;

        default:
            console.log(metodo);
            break;
    }
}

function ver_pm(id) {
    $('#pago_movil').attr('hidden', false);

    let funcion = 'datos_bancarios';
    let tabla = 'pago_movil';

    $.ajax
        ({
            url: '../../server/functions/consultas.php',
            type: 'POST',
            dataType: 'json',
            data:
            {
                funcion: funcion,
                tabla: tabla,
                id: id
            }

        })
        .done(function (res) {
            $('.titulo-app').html(res.titulo);
            $('#pago_movil').html(res.datos);
        })
        .fail(function (err) {
            console.log(err.responseText);
        })
}

function ver_tr(id) {
    $('#transferencia').attr('hidden', false);

    let funcion = 'datos_bancarios';
    let tabla = 'transferencia';

    $.ajax
        ({
            url: '../../server/functions/consultas.php',
            type: 'POST',
            dataType: 'json',
            data:
            {
                funcion: funcion,
                tabla: tabla,
                id: id
            }

        })
        .done(function (res) {
            $('.titulo-app').html(res.titulo);
            $('#transferencia').html(res.datos);
        })
        .fail(function (err) {
            console.log(err.responseText);
        })
}

function ver_zl(id) {
    $('#zelle').attr('hidden', false);

    let funcion = 'datos_bancarios';
    let tabla = 'zelle';

    $.ajax
        ({
            url: '../../server/functions/consultas.php',
            type: 'POST',
            dataType: 'json',
            data:
            {
                funcion: funcion,
                tabla: tabla,
                id: id
            }

        })
        .done(function (res) { console.log(res)
            $('.titulo-app').html(res.titulo);
            $('#zelle').html(res.datos);
        })
        .fail(function (err) {
            console.log(err.responseText);
        })
}


$(document).on('click', '#guardar_pm', function () {
    editar_pm();
})

function editar_pm() {
    const parametros = window.location.search;
    const variables = new URLSearchParams(parametros);
    let id_pago = variables.get('id');

    let id_banco = $('#bancos').val();
    let tipo_id = $('#tipo_id').val();
    let documento = $('#documento').val();
    let telefono = $('#telefono').val();
    let tabla = 'pago_movil';
    let funcion = 'editar_datos_banco';

    $.ajax
        ({
            url: '../../server/functions/editar.php',
            type: 'POST',
            dataType: 'json',
            data:
            {
                funcion: funcion,
                tabla: tabla,
                id_pago: id_pago,
                id_banco: id_banco,
                tipo_id: tipo_id,
                documento: documento,
                telefono: telefono
            }

        })
        .done(function (res) {
            
          let titulo = res.titulo;
          let cuerpo = res.cuerpo;
          let accion = res.accion;

          if(accion === 'success')
          {
             window.location.href='mis_datos_bancarios';
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

$(document).on('click', '#guardar_tr', function () {
    editar_tr();
})

function editar_tr() {
    const parametros = window.location.search;
    const variables = new URLSearchParams(parametros);
    let id_pago = variables.get('id');

    let id_banco = $('#bancos').val();
    let tipo_id = $('#tipo_id').val();
    let documento = $('#documento').val();
    let cuenta = $('#cuenta').val();
    let tabla = 'transferencia';
    let funcion = 'editar_datos_banco';

    $.ajax
        ({
            url: '../../server/functions/editar.php',
            type: 'POST',
            dataType: 'json',
            data:
            {
                funcion: funcion,
                tabla: tabla,
                id_pago: id_pago,
                id_banco: id_banco,
                tipo_id: tipo_id,
                documento: documento,
                cuenta: cuenta
            }

        })
        .done(function (res) {
        
          let titulo = res.titulo;
          let cuerpo = res.cuerpo;
          let accion = res.accion;

          if(accion === 'success')
          {
             window.location.href='mis_datos_bancarios';
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

$(document).on('click', '#guardar_zl', function () {
    editar_zl();
})

function editar_zl() {
    const parametros = window.location.search;
    const variables = new URLSearchParams(parametros);
    let id_pago = variables.get('id');

    let titular = $('#titular').val();
    let correo = $('#correo').val();
    let tabla = 'zelle';
    let funcion = 'editar_datos_banco';

    $.ajax
        ({
            url: '../../server/functions/editar.php',
            type: 'POST',
            dataType: 'json',
            data:
            {
                funcion: funcion,
                tabla: tabla,
                id_pago: id_pago,
                titular: titular,
                correo: correo
            }

        })
        .done(function (res) {
            console.log(res)
          let titulo = res.titulo;
          let cuerpo = res.cuerpo;
          let accion = res.accion;

          if(accion === 'success')
          {
             window.location.href='mis_datos_bancarios';
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
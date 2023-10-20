$(document).ready(forms());

$(document).on('change', '#tipo_db', function () {
  forms();
})

function forms() {
  $('.titulo-app').html("<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button> DATOS BANCARIOS")

  let tipo_db = $('#tipo_db').val();

  switch (tipo_db) {
    case 'pago_movil':
      $('.db-bs').attr('hidden', false);
      $('.cuenta-pm').attr('hidden', false);
      $('.cuenta-tr').attr('hidden', true);
      $('.zelle-div').attr('hidden', true);
      break;

    case 'transferencia':
      $('.db-bs').attr('hidden', false);
      $('.cuenta-tr').attr('hidden', false);
      $('.cuenta-pm').attr('hidden', true);
      $('.zelle-div').attr('hidden', true);
      break;

    case 'zelle':
      $('.zelle-div').attr('hidden', false);
      $('.db-bs').attr('hidden', true);
      break;

    default:
      $('.cuenta-tr').attr('hidden', true);
      $('.zelle-div').attr('hidden', true);
      break;
  }
}

$(document).ready(bancos())

function bancos() {

  let funcion = 'lista_de_bancos';

  $.ajax
    ({
      url: '../../server/functions/consultas.php',
      type: 'POST',
      dataType: 'html',
      async: true,
      data:
      {
        funcion: funcion
      }

    })
    .done(function (res) {

      $('#bancos').html(res);
    })
    .fail(function (err) {
      console.log(err)
    })
}

$(document).on('click', '#guardar_db', function () {
  let tipo_db = $('#tipo_db').val();
  let funcion = 'nuevos_datos_bancarios';
  let array = [];

  switch (tipo_db) {
    case 'pago_movil':
      id_banco = $('#bancos').val();
      tipo_id = $('#tipo_id').val();
      documento = $('#documento').val();
      telefono = $('#telefono').val();

      array =
      {
        funcion: funcion,
        tipo_db: tipo_db,
        id_banco: id_banco,
        tipo_id: tipo_id,
        documento: documento,
        telefono: telefono
      };

      nuevo_db(array);
      break;

    case 'transferencia':
      id_banco = $('#bancos').val();
      tipo_id = $('#tipo_id').val();
      documento = $('#documento').val();
      cuenta = $('cuenta').val();

      array =
      {
        funcion: funcion,
        tipo_db: tipo_db,
        id_banco: id_banco,
        tipo_id: tipo_id,
        documento: documento,
        cuenta: cuenta
      };

      nuevo_db(array);
      break;

    case 'zelle':
      titular = $('#titular').val();
      correo = $('#correo').val();

      array =
      {
        funcion: funcion,
        tipo_db: tipo_db,
        titular: titular,
        correo: correo
      }

      nuevo_db(array);
      break;

  }
})


function nuevo_db(array) {
  $.ajax
  ({
    url: '../../server/functions/agregar.php',
    type: 'POST',
    dataType: 'json',
    async: true,
    data: array

  })
  .done(function (res) {

    let titulo = res.titulo;
    let cuerpo = res.cuerpo;
    let accion = res.accion;

    if(accion === 'success')
    {
      mis_datos_bancarios();
    }
    else
    {
       swal(titulo, cuerpo, accion);
    }
  })
  .fail(function (err) {
    console.log(err)
  })
}
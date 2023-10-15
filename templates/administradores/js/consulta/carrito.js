$(document).ready(mis_carritos());

function mis_carritos() {
  let funcion = 'mis_carritos';

  $.ajax
    ({
      url: '../../server/functions/consultas.php',
      type: 'POST',
      dataType: 'json',
      data:
      {
        funcion: funcion
      }

    })
    .done(function (res) {
      ItemsInCar();
      $('.titulo-app').html(res.titulo);
      $('.mi_carrito').html(res.contenido);
      $('.comprar').html(res.comprar);
    })
    .fail(function (err) {
      console.log(err);
    })
}

const parametros = window.location.search;
const variables = new URLSearchParams(parametros);
let id_comercio = variables.get('comercio');

if (id_comercio != null) {

  $(document).ready(mi_carrito);

  function mi_carrito() {
    let funcion = 'mi_carrito';

    $.ajax
      ({
        url: '../../server/functions/consultas.php',
        type: 'POST',
        dataType: 'json',
        data:
        {
          funcion: funcion,
          id_comercio: id_comercio
        }

      })
      .done(function (res) {
        ItemsInCar();
        $('.titulo-app').html(res.titulo);
        $('.mi_carrito').html(res.contenido);
        $('.comprar').html(res.comprar);
      })
      .fail(function (err) {
        console.log(err);
      })
  }
}




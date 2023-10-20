$(document).ready(ver_producto());

function ver_producto() {
  const parametros = window.location.search;
  const variables = new URLSearchParams(parametros);
  let id_producto = variables.get('producto');
  funcion = 'ver_producto';

  $.ajax
    ({
      url: '../../server/functions/consultas.php',
      type: 'POST',
      dataType: 'json',
      data:
      {
        funcion: funcion,
        id_producto: id_producto
      }

    })
    .done(function (res) {
      $('.titulo-app').html(res.titulo);
      $('.detalle-producto').html(res.producto);

    })
    .fail(function (err) {
      console.log(err.responseText);
    })
}

$(document).on('change', '#foto_producto', function()
{
  let container = '#img_producto';
   readImage(container, this);
})

$(document).on('click', '#guardar_producto', function () {
  editar_producto();
})

function editar_producto() {
  const parametros = window.location.search;
  const variables = new URLSearchParams(parametros);

  let id_producto = variables.get('producto');
  let peso = $('#peso').val();
  let codigo = $('#codigo').val();
  let descripcion = $('#descripcion').val();
  let precio = $('#precio').val();
  let cantidad = $('#stock').val();
  let exento = document.querySelector('input[name="exento"]:checked').value;

  let funcion = 'editar_producto';

  var formData = new FormData();
  var foto = $('#foto_producto')[0].files[0];

  formData.append('file', foto);
  formData.append('funcion', funcion);
  formData.append('id_producto', id_producto);
  formData.append('codigo', codigo);
  formData.append('descripcion', descripcion);
  formData.append('peso', peso);
  formData.append('precio', precio);
  formData.append('exento', exento);
  formData.append('cantidad', cantidad);

    $.ajax
      ({
        url: '../../server/functions/editar.php',
        type: 'POST',
        dataType: 'json',
        async: true,
        data: formData,
        contentType: false,
        processData: false

      })
      .done(function (res) {
      
        let titulo = res.titulo;
        let cuerpo = res.cuerpo;
        let accion = res.accion;

        if(accion === 'success')
        {
           window.location.href ='productos';
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


$(document).ready(titulo())

function titulo()
{
   $('.titulo-app').html("<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button> NUEVO PRODUCTO")
}

$(document).on('change', '#foto_producto', function()
{
  let container = '#img_producto';
   readImage(container, this);
})

$(document).on('click', '#nuevo_producto', function()
{
   nuevo_producto();
})

function nuevo_producto() {

  let peso = $('#peso').val();
  let codigo = $('#codigo').val();
  let descripcion = $('#descripcion').val();
  let precio = $('#precio').val();
  let cantidad = $('#stock').val();
  let exento = document.querySelector('input[name="exento"]:checked').value;

  let funcion = 'nuevo_producto';

  var formData = new FormData();
  var foto = $('#foto_producto')[0].files[0];

  formData.append('file', foto);
  formData.append('funcion', funcion);
  formData.append('codigo', codigo);
  formData.append('descripcion', descripcion);
  formData.append('peso', peso);
  formData.append('precio', precio);
  formData.append('exento', exento);
  formData.append('cantidad', cantidad);

    $.ajax
      ({
        url: '../../server/functions/agregar.php',
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

        swal(titulo, cuerpo, accion);

      })
      .fail(function (err) {
        console.log(err)
      })

}

$(document).on('keyup', '#codigo', function()
{
   CheckCode();
})


function CheckCode()
{
  let codigo = $('#codigo').val();
  let funcion = 'CheckCode';

  $.ajax
  ({
    url: '../../server/functions/consultas.php',
    type: 'POST',
    dataType: 'json',
    async: true,
    data: 
    {
      funcion: funcion,
      codigo: codigo
    }

  })
  .done(function (res) {
    $('#alert_code').html(res.codigo);
  })
  .fail(function (err) {
    console.log(err)
  })
}
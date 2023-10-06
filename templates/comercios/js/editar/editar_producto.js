let id_producto = '';
let codigo = '';

$("#editar_foto_producto").change(function () 
{
   let container = '#editar_foto';
  readImage(container, this);
});

$(document).on('click', '#edit_producto_btn', function(data)
{  
    let producto = JSON.parse(data.currentTarget.attributes.producto.value);
    id_producto = producto.Id;
    codigo = producto.Codigo;
    let stock = data.currentTarget.attributes.existencia.value;
    let comercio = data.currentTarget.attributes.comercio.value;
    let ruta = '../../img/' + comercio + '/productos/'+ producto.Foto + '.jpg';
   
    $('#editar_foto').attr('src', ruta);
    $('#editar_peso').val(producto.Peso);
    $('#editar_descripcion_producto').val(producto.Descripcion);
    $('#editar_p_civa').val(producto.P_civa);
    $('#editar_cantidad').val(stock);

    CheckTax(producto.Alicuota);
})

$(document).on('click', '#modificar_producto', function()
{
    editar_producto();
})

async function editar_producto()
{
    let funcion = 'editar_producto';
    let peso = $('#editar_peso').val();
    let descripcion = $('#editar_descripcion_producto').val();
    let precio_civa = $('#editar_p_civa').val();
    let cantidad = $('#editar_cantidad').val();
    let exento = CheckExento('editar_exento');

    var formData = new FormData();
    var foto = $('#editar_foto_producto')[0].files[0];

    formData.append('file', foto);
    formData.append('funcion', funcion);
    formData.append('id_producto', id_producto);
    formData.append('codigo', codigo);
    formData.append('descripcion', descripcion);
    formData.append('peso', peso);
    formData.append('precio_civa', precio_civa);
    formData.append('exento', exento);
    formData.append('cantidad', cantidad);

  if(peso && descripcion && precio_civa)
  {
    $.ajax
    ({
       url: '../../server/functions/editar.php',
       type: 'POST',
       dataType: 'html',
       async: true,
       data: formData,
       contentType: false,
       processData: false
  
    })
    .done(function(res)
    {  
      lista_de_productos();
    })
    .fail(function(err)
    {
      console.log(err)
    })
  }
  else
  {
    swal('Cuidado', 'No se Pueden Enviar Campos Vacíos.', 'warning');
  }

}

function CheckTax(tax)
{
    if(tax == 0)
    {
        let exento = document.getElementById('editar_exento');
        exento.setAttribute('checked', true);
    }
    else
    {
        let exento = document.getElementById('editar_exento');
        exento.removeAttribute('checked', true);
    }
}




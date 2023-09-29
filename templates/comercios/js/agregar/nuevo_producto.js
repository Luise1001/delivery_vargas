$("#foto_producto").change(function () 
{
   let container = '#foto';
  readImage(container, this);
});

$(document).on('click', '#agregar_producto', async function(e)
{
   let datos = await CheckPersonalData();
   
   if(datos == true)
   { 
    nuevo_producto();
   }
   else
   {
    swal('Alerta','Primero Debe Registrar Sus Datos Personales.', 'warning',
    {
      buttons: {
        cancel: 'Cancelar',
        Redirigir: true,
      },
    })
    .then((value) => 
    {
      switch (value) {
     
        case "Redirigir":
          window.location.href = 'mi_perfil';
          break;
          
        default: false;
      }
    });
      
   }
    
})

$(document).on('keyup', '#codigo_producto', function()
{
    verificar_codigo()
})

function CheckExento(tag)
{
    let exento = document.getElementById(tag);

    if(exento.checked)
    {
        return 1;
    }
    else
    {
        return 0;
    }
}

async function nuevo_producto()
{
    let page = 'nuevo_producto';
    let codigo = $('#codigo_producto').val();
    let peso = $('#peso').val();
    let descripcion = $('#descripcion_producto').val();
    let precio_civa = $('#p_civa').val();
    let cantidad = $('#cantidad').val();
    let exento = CheckExento('exento');

    var formData = new FormData();
    var foto = $('#foto_producto')[0].files[0];

    formData.append('file', foto);
    formData.append('page', page);
    formData.append('codigo', codigo);
    formData.append('descripcion', descripcion);
    formData.append('peso', peso);
    formData.append('precio_civa', precio_civa);
    formData.append('cantidad', cantidad);
    formData.append('exento', exento);

   if(codigo && peso && descripcion && precio_civa && cantidad && foto)
   {
    $.ajax
    ({
       url: '../../functions/agregar.php',
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
     swal('Cuidado', 'No se Pueden Enviar Campos Vacíos', 'warning');
   }

}


function verificar_codigo()
{
    let codigo = $('#codigo_producto').val();
    let page = 'verificar_codigo';
    $.ajax
    ({
       url: '../../functions/verificar.php',
       type: 'POST',
       dataType: 'html',
       async: true,
       data: 
       {
         page: page,
         codigo: codigo
       }
  
    })
    .done(function(res)
    {
        if(res != 0)
        {
            $('#alert_codigo_producto').html(res);
            $('.card-btn').addClass('d-none');
        }
        else
        {
            $('#alert_codigo_producto').html('');
            $('.card-btn').removeClass('d-none');
        }
      
    })
    .fail(function(err)
    {
      console.log(err)
    })
}

async function CheckPersonalData()
{
  let page = 'check_personal_data';
  let tabla = 'comercios';
  const resp = 
  $.ajax
  ({
     url: '../../functions/consultas.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       page : page,
       tabla: tabla
    }

  })
  .done(async function(res)
  {
    return await res;

  })
  .fail(function(err)
  {
    console.log(err);
  })

  return await resp;
}
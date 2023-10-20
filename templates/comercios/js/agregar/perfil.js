$(document).on('click', '#guardar_perfil', function()
{
    nuevo_cliente();
})

function nuevo_cliente()
{
    let nombre = $('#nombre').val();
    let apellido = $('#apellido').val();
    let tipo_id = $('#tipo_id').val();
    let cedula = $('#cedula').val();
    let telefono = $('#telefono').val();
    let genero = document.querySelector('input[name="genero"]:checked').value;
    let funcion = 'nuevo_cliente';
    
   $.ajax
   ({
      url: '../../server/functions/agregar.php',
      type: 'POST',
      dataType: 'json',
      data: 
      {
         funcion: funcion,
         nombre: nombre,
         apellido: apellido,
         tipo_id: tipo_id,
         cedula: cedula,
         telefono: telefono,
         genero: genero
      }
 
   })
   .done(function(res)
   { 
      let titulo = res.titulo;
      let cuerpo = res.cuerpo;
      let accion = res.accion;

      if(accion === 'success')
      {
         mi_perfil();
      }
      else
      {
         swal(titulo, cuerpo, accion);
      }
     
   })
   .fail(function(err)
   {
      console.log(err);
   })

}

$(document).on('click', '#guardar_comercio', function()
{
    nuevo_comercio();
})

function nuevo_comercio()
{
    let razon_social = $('#razon_social').val();
    let tipo_id = $('#tipo_id_juridico').val();
    let rif = $('#rif').val();
    let telefono = $('#telefono_juridico').val();
    let funcion = 'nuevo_comercio';
    
   $.ajax
   ({
      url: '../../server/functions/agregar.php',
      type: 'POST',
      dataType: 'json',
      data: 
      {
         funcion: funcion,
         razon_social: razon_social,
         tipo_id: tipo_id,
         rif: rif,
         telefono: telefono
      }
 
   })
   .done(function(res)
   { 
      let titulo = res.titulo;
      let cuerpo = res.cuerpo;
      let accion = res.accion;

      if(accion === 'success')
      {
         mi_perfil();
      }
      else
      {
         swal(titulo, cuerpo, accion);
      }
     
   })
   .fail(function(err)
   {
      console.log(err);
   })

}

$(document).on('change', '#input_fp', function()
{

  let container = '#foto_perfil';
 readImage(container, this);
 nueva_foto();
});

function nueva_foto()
{
  let funcion = 'nueva_foto_perfil';
  var formData = new FormData();
  var foto = $('#input_fp')[0].files[0];
  let confirmar = false;

  formData.append('file', foto);
  formData.append('funcion', funcion);

  $.ajax
  ({
     url: '../../server/functions/agregar.php',
     type: 'POST',
     dataType: 'html',
     async: true,
     data: formData,
     contentType: false,
     processData: false

  })
  .done(function(res)
  { 
    mi_perfil();
  })
  .fail(function(err)
  {
    console.log(err)
  })

}
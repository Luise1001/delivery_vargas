$(document).on('click', '#agregar_conductor', function()
{
  let funcion = 'nuevo_conductor';

  let nombre = $('#nombre').val();
  let apellido = $('#apellido').val();
  let tipo_id = $('#tipo_id').val();
  let cedula = $('#cedula_conductor').val();
  let telefono = $('#telefono').val();
  let direccion = $('#direccion').val();
  let usuario_conductor = $('#usuario_conductor').val();

    $.ajax
    ({
       url: '../../server/functions/agregar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
          funcion: funcion,
          nombre: nombre,
          apellido: apellido,
          tipo_id: tipo_id,
          cedula: cedula,
          telefono: telefono,
          direccion: direccion,
          usuario_conductor: usuario_conductor
       }
  
    })
    .done(function(res)
    { console.log(res)
      lista_de_conductores();
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })

})

$(document).on('keyup', '#usuario_conductor', function()
{
  let correo = $('#usuario_conductor').val();
   verificar_correo_conductor(correo);
})

function verificar_correo_conductor(correo)
{
  let funcion = 'verificar_correo_conductor';
  let usuario = correo;
  $.ajax
  ({
     url: '../../server/functions/verificar.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
        funcion: funcion,
        usuario: usuario
     }

  })
  .done(function(res)
  {
    if(res != 1)
    {
      $('#aviso_2').html(res);
      $('#aviso_3').html(res);
      $('.card-btn').addClass('d-none');
    }
    else
    {
     $('#aviso_2').html('');
     $('#aviso_3').html('');
     $('.card-btn').removeClass('d-none');
    }
    
  })
  .fail(function()
  {
    console.log("error ejecutando Ajax");
  })
}
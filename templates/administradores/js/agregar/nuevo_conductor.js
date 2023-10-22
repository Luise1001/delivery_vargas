$(document).ready(function()
{
   $('.titulo-app').html("<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button> NUEVO CONDUCTOR");
})

$(document).on('keyup', '#correo', function()
{
   let correo = $('#correo').val();
   let t = 'usuarios';
   let c = 'correo';
   let funcion = 'correo_conductor';

    $.ajax
    ({
       url: '../../server/functions/consultas.php',
       type: 'POST',
       dataType: 'json',
       data: 
       {
          funcion: funcion,
          correo: correo,
          t: t,
          c:c
       }
  
    })
    .done(function(res)
    {
      $('.red-alert').html(res.alert);
      $('#guardar_conductor').attr(res.attr, res.status);
    })
    .fail(function(err)
    {
      console.log(err);
    })
})



$(document).on('click', '#guardar_conductor', function()
{
  nuevo_conductor();
})

function nuevo_conductor()
{
  let funcion = 'nuevo_conductor';

  let nombre = $('#nombre').val();
  let apellido = $('#apellido').val();
  let tipo_id = $('#tipo_id').val();
  let cedula = $('#cedula').val();
  let telefono = $('#telefono').val();
  let direccion = $('#direccion').val();
  let correo = $('#correo').val();

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
          direccion: direccion,
          correo: correo
       }
  
    })
    .done(function(res)
    { console.log(res)

      let titulo = res.titulo;
      let cuerpo = res.cuerpo;
      let accion = res.accion;

      if(accion === 'success')
      {
        window.location.href="lista_de_conductores";
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

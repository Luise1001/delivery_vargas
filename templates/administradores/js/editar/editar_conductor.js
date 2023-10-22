$(document).ready(detalle_conductor());

function detalle_conductor()
{
   const parametros = window.location.search;
   const variables = new URLSearchParams(parametros);
   let id_conductor = variables.get('conductor');
   let id_usuario = variables.get('usuario');
   let funcion = 'detalle_conductor';

   $.ajax
   ({
      url: '../../server/functions/consultas.php',
      type: 'POST',
      dataType: 'json',
      data: 
      {
         funcion: funcion,
         id_conductor: id_conductor,
         id_usuario: id_usuario
      }
 
   })
   .done(function(res)
   {
      $('.titulo-app').html(res.titulo);
      $('.detalle-conductor').html(res.conductor);
   })
   .fail(function(err)
   {
     console.log(err);
   })
}

$(document).on('click', '#guardar_conductor', function()
{
    editar_conductor();
})

function editar_conductor()
{
   const parametros = window.location.search;
   const variables = new URLSearchParams(parametros);

   let id_conductor = variables.get('conductor');
   let nombre = $('#nombre').val();
   let apellido =  $('#apellido').val();
   let tipo_id = $('#tipo_id').val();
   let cedula = $('#cedula').val();
   let telefono =  $('#telefono').val();
   let direccion = $('#direccion').val();


   let funcion = 'editar_conductor';
    
    $.ajax
    ({
       url: '../../server/functions/editar.php',
       type: 'POST',
       dataType: 'json',
       data: 
       {
          funcion: funcion,
          id_conductor : id_conductor,
          nombre: nombre,
          apellido: apellido,
          tipo_id: tipo_id,
          cedula: cedula,
          telefono: telefono,
          direccion: direccion
       }
  
    })
    .done(function(res)
    {
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

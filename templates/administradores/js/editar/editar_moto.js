$(document).ready(detalle_moto());

function detalle_moto()
{
   const parametros = window.location.search;
   const variables = new URLSearchParams(parametros);
   let id_conductor = variables.get('conductor');
   let id_moto = variables.get('moto');
   let funcion = 'detalle_moto';

   $.ajax
   ({
      url: '../../server/functions/consultas.php',
      type: 'POST',
      dataType: 'json',
      data: 
      {
         funcion: funcion,
         id_conductor: id_conductor,
         id_moto: id_moto
      }
 
   })
   .done(function(res)
   {
      $('.titulo-app').html(res.titulo);
      $('.detalle-moto').html(res.moto);
   })
   .fail(function(err)
   {
     console.log(err);
   })
}

$(document).on('keyup', '#cedula', function()
{
   let cedula = $('#cedula').val();
   let t = 'conductores';
   let c = 'cedula';
   let funcion = 'cedula_conductor';

    $.ajax
    ({
       url: '../../server/functions/consultas.php',
       type: 'POST',
       dataType: 'json',
       data: 
       {
          funcion: funcion,
          cedula: cedula,
          t: t,
          c:c
       }
  
    })
    .done(function(res)
    {
      $('.red-alert').html(res.alert);
      $('#guardar_moto').attr(res.attr, res.status);
    })
    .fail(function(err)
    {
      console.log(err);
    })
})


$(document).on('click', '#guardar_moto', function()
{

   editar_moto();
})

function editar_moto()
{
   const parametros = window.location.search;
   const variables = new URLSearchParams(parametros);

   let id_moto = variables.get('moto');
   let marca =  $('#marca').val();
   let modelo = $('#modelo').val();
   let placa = $('#placa').val();
   let year =  $('#year').val();
   let cedula = $('#cedula').val();
   let funcion = 'editar_moto';

    $.ajax
    ({
       url: '../../server/functions/editar.php',
       type: 'POST',
       dataType: 'json',
       data: 
       {
          id_moto: id_moto,
          funcion: funcion,
          marca: marca,
          modelo: modelo,
          placa: placa,
          year: year,
          cedula: cedula
       }
  
    })
    .done(function(res)
    {
      let titulo = res.titulo;
      let cuerpo = res.cuerpo;
      let accion = res.accion;

      if(accion === 'success')
      {
         window.location.href = "lista_de_motos";
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
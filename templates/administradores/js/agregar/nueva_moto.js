$(document).ready(function()
{
   $('.titulo-app').html("<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button> NUEVA MOTO");
})

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
   nueva_moto();
})


function nueva_moto()
{
   let marca =  $('#marca').val();
   let modelo = $('#modelo').val();
   let placa = $('#placa').val();
   let year =  $('#year').val();
   let cedula = $('#cedula').val();
   let funcion = 'nueva_moto';

    $.ajax
    ({
       url: '../../server/functions/agregar.php',
       type: 'POST',
       dataType: 'json',
       data: 
       {
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
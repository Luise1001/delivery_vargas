let id_moto = '';
$(document).on('keyup', '#editar_cedula', function()
{
   let cedula = $('#editar_cedula').val();
   let funcion = 'verificar_cedula';

    $.ajax
    ({
       url: '../../server/functions/verificar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
          funcion: funcion,
          cedula: cedula
       }
  
    })
    .done(function(res)
    {
      if(res != 1)
      {
        $('.aviso').html(res);
        $('.card-btn').addClass('d-none');
      }
      else
      {
       $('.aviso').html('');
       $('.card-btn').removeClass('d-none');
      }
       
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
})

$(document).on('click', '#editar_moto_btn', function(data)
{
    $('#editar_marca').val(data.target.parentNode.attributes.marca.value);
    $('#editar_modelo').val(data.target.parentNode.attributes.modelo.value);
    $('#editar_placa').val(data.target.parentNode.attributes.placa.value);
    $('#editar_year').val(data.target.parentNode.attributes.year.value);
    $('#editar_cedula').val(data.target.parentNode.attributes.cedula.value);
    id_moto = data.target.parentNode.attributes.moto.value;

})

$(document).on('click', '#modificar_moto', function()
{
   let marca =  $('#editar_marca').val();
   let modelo = $('#editar_modelo').val();
   let placa = $('#editar_placa').val();
   let year =  $('#editar_year').val();
   let cedula = $('#editar_cedula').val();

   let funcion = 'editar_moto';

    $.ajax
    ({
       url: '../../server/functions/editar.php',
       type: 'POST',
       dataType: 'html',
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
        lista_de_motos() 
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
})
$(document).on('keyup', '#cedula', function()
{
   let num_cedula = $('#cedula').val();
   verificar_cedula(num_cedula);
})

$(document).on('click', '#agregar_moto', function()
{  
    let page = 'nueva_moto';
    
    let marca = $('#marca').val();
    let modelo = $('#modelo').val();
    let placa = $('#placa').val();
    let year = $('#year').val();
    let cedula = $('#cedula').val();

    $.ajax
    ({
       url: '../../functions/agregar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
          page: page,
          marca: marca,
          modelo: modelo,
          placa: placa,
          year: year,
          cedula: cedula
       }
  
    })
    .done(function(res)
    {
      console.log(res)
        lista_de_motos() 
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
})

function verificar_cedula(cedula)
{
   let page = 'verificar_cedula';
   $.ajax
   ({
      url: '../../functions/verificar.php',
      type: 'POST',
      dataType: 'html',
      data: 
      {
         page: page,
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
}
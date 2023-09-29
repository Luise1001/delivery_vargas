$(document).on('keyup', '#pass_2', function()
{
   let pass = $('#pass').val();
   let pass_2 = $('#pass_2').val();

   if(pass != pass_2)
   {
      $('#alert_pass').removeClass('d-none');
   }
   else
   {
     $('#alert_pass').addClass('d-none');
   }

})

$(document).on('click', '#agregar_admin', function()
{
    let correo = $('#correo').val();
    let pass = $('#pass').val();
    let pass_2 = $('#pass_2').val();
    let nivel = $('#nivel').val();
    let page = 'nuevo_admin';

      if(pass === pass_2)
      {
        $.ajax
        ({
           url: '../../functions/agregar.php',
           type: 'POST',
           dataType: 'json',
           async: true,
           data: 
           {
              page: page,
              correo: correo,
              pass: pass,
              pass_2: pass_2,
              nivel: nivel
           }
      
        })
        .done(function(res)
        {
          let data = res[0];

             swal(data, '', 'success' );  
             lista_de_administradores();   

        })
        .fail(function()
        {
          swal('Error','No se Pudo Realizar la Operación', 'error');
        })
      }
      else
      {
        swal('Error','No se Pudo Realizar la Operación', 'error');
      }
})

$(document).on('click', '#nivel', function()
{
   let nivel = $('#nivel').val();

   if(nivel === '2')
   {
     $('#cedula_conductor_div').removeClass('d-none');
   }
   else
   {
    $('#cedula_conductor_div').addClass('d-none');
   }

})

$(document).on('keyup', '#cedula_usuario_conductor', function()
{
   let cedula = $('#cedula_usuario_conductor').val();
  verificar_cedula(cedula);
})
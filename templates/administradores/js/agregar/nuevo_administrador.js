$(document).ready(function()
{
   $('.titulo-app').html("<button class='back-button' onclick=history.back()><i class='fa-solid fa-arrow-left'></i></button> NUEVO ADMINISTRADOR");
})

$(document).on('keyup', '#pass_2', function()
{
   let pass = $('#pass').val();
   let pass_2 = $('#pass_2').val();

   if(pass != pass_2)
   {
      $('.red-alert').html('Las Contraseñas No Coinciden');
      $('#guardar_admin').attr('hidden', true);
   }
   else
   {
    $('.red-alert').html('');
    $('#guardar_admin').attr('hidden', false);
   }

})

$(document).on('keyup', '#correo', function()
{
   let correo = $('#correo').val();
   let t = 'usuarios';
   let c = 'correo';
   let funcion = 'correo_usuario';

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
      $('.red-email').html(res.alert);
      $('#guardar_admin').attr(res.attr, res.status);
    })
    .fail(function(err)
    {
      console.log(err);
    })
})

$(document).on('click', '#guardar_admin', function()
{
   nuevo_administrador();
})

function nuevo_administrador()
{
  let correo = $('#correo').val();
  let pass = $('#pass').val();
  let pass_2 = $('#pass_2').val();
  let nivel = $('#nivel').val();
  let funcion = 'nuevo_admin';

      $.ajax
      ({
         url: '../../server/functions/agregar.php',
         type: 'POST',
         dataType: 'json',
         async: true,
         data: 
         {
            funcion: funcion,
            correo: correo,
            pass: pass,
            pass_2: pass_2,
            nivel: nivel
         }
    
      })
      .done(function(res)
      {
        let titulo = res.titulo;
        let cuerpo = res.cuerpo;
        let accion = res.accion;

        if(accion === 'success')
        {
           window.location.href="lista_de_administradores";
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
$(document).ready(menu());

function menu()
{
    let url = window.location.pathname;
    let funcion = 'menu';
  
    $.ajax
    ({
       url: '../../server/functions/consultas.php',
       type: 'POST',
       dataType: 'json',
       data: 
       {
         funcion: funcion,
         url: url
      }
  
    })
    .done(function(res)
    {
      $('.options-menu').html(res.header);
      $('.user-title').html(res.user);
      $('.user-photo').attr('src', res.foto);
      $('.titulo-app').html(res.titulo);
      $('.header-icons').html(res.icons);
      $('.footer-menu').html(res.footer);
    })
    .fail(function(err)
    {
      console.log(err);
    })
}

$(document).on('click', '#cerrar_sesion', function()
{
    cerrar_sesion();
})

function cerrar_sesion()
{
    let funcion = 'cerrar_sesion';
  
    $.ajax
    ({
       url: '../../server/functions/eliminar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         funcion: funcion
      }
  
    })
    .done(function(res)
    {
        window.location.href = '../../index';
    })
    .fail(function(err)
    {
      console.log(err);
    })
}


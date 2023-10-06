$(document).ready(menu());

function menu()
{
    let funcion = 'menu';
  
    $.ajax
    ({
       url: '../../server/functions/consultas.php',
       type: 'POST',
       dataType: 'json',
       data: 
       {
         funcion: funcion
      }
  
    })
    .done(function(res)
    {
      $('.options-menu').html(res.header);
      $('.titulo-app').html(res.titulo);
      $('.header-icons').html(res.icons);
      $('.footer-menu').html(res.footer);
    })
    .fail(function(err)
    {
      console.log(err);
    })
}

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
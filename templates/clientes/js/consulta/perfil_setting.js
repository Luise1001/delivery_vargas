$(document).ready(perfil_setting());

function perfil_setting()
{
    let funcion = 'menu_configuracion';

    $.ajax
    ({
       url: '../../server/functions/consultas.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
          funcion: funcion
       }
  
    })
    .done(function(res)
    { 
      $('.user-setting').html(res);
    })
    .fail(function(err)
    {
       console.log(err);
    })
}

$(document).on('click', '.configuracion-btn', function()
{ 
   ArrowChange_Setting();
})

function ArrowChange_Setting()
{  
   let arrow = document.getElementById('arrow_setting');

   if(arrow.classList.contains('fa-angle-down'))
   { 
      $('#arrow_setting').removeClass('fa-angle-down');
      $('#arrow_setting').addClass('fa-angle-up');
   }
   else
   {
      $('#arrow_setting').removeClass('fa-angle-up');
      $('#arrow_setting').addClass('fa-angle-down');
   }
}
$(document).ready(mi_horario())

function mi_horario()
{
    let funcion = 'mi_horario';

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
      $('.mi-horario').html(res);
    })
    .fail(function(err)
    {
       console.log(err);
    })
}

$(document).on('click', '#guardar_horario', function()
{
    swal('Operación Exitosa', '', 'success');
     mi_horario();
})


$(document).on('click', '.list-hor-btn', function()
{ 
   ArrowHOR();
})

function ArrowHOR()
{  
   let arrow = document.getElementById('arrow_hr');

   if(arrow.classList.contains('fa-angle-down'))
   { 
      $('#arrow_hr').removeClass('fa-angle-down');
      $('#arrow_hr').addClass('fa-angle-up');
   }
   else
   {
      $('#arrow_hr').removeClass('fa-angle-up');
      $('#arrow_hr').addClass('fa-angle-down');
   }
}
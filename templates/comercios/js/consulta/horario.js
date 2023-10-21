$(document).ready(mi_horario())

function mi_horario()
{
    let funcion = 'mi_horario';

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
      $('.titulo-app').html(res.titulo);
      $('.schedule').html(res.horario);
    })
    .fail(function(err)
    {
       console.log(err);
    })
}




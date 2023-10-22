$(document).ready(mis_datos_bancarios());

function mis_datos_bancarios()
{
    let funcion = 'mis_datos_bancarios';
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
      $('.header-icons').html(res.botones);
      $('.pm').html(res.pm);
      $('.tr').html(res.tr);
      $('.zl').html(res.zl);

    })
    .fail(function(err)
    {
       console.log(err);
    })
}


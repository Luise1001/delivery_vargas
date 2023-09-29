$(document).on('click', '#modificar_clave', function()
{
    cambiar_clave();
})

function cambiar_clave()
{
    let page = 'cambiar_mi_clave';
    let vieja_clave = $('#old_pass').val();
    let clave = $('#new_pass').val();

    $.ajax
    ({
       url: '../../functions/editar.php',
       type: 'POST',
       dataType: 'json',
       data: 
       {
          page: page,
          vieja_clave: vieja_clave,
          clave: clave
       }
  
    })
    .done(function(res)
    { 
      let titulo = res.titulo;
      let cuerpo = res.cuerpo;
      let accion = res.accion;

      swal(titulo, cuerpo, accion);
    })
    .fail(function(err)
    {
       console.log(err);
    })
}

$(document).on('keyup', '#repeat_pass', function()
{
    verificar_claves();
})

function verificar_claves()
{
    let clave = $('#new_pass').val();
    let repeat = $('#repeat_pass').val();
    let button = document.getElementById('modificar_clave');

    if(clave === repeat)
    {
        $('#repeat_pass_alert').html('');
        button.removeAttribute('hidden');
    }
    else
    {
        
        button.setAttribute('hidden', true);
        $('#repeat_pass_alert').html('Las Contraseñas No Coinciden.');
    }
}